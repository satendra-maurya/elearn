<?php

namespace App\Services;

use App\Services\Contracts\UserContract;
use App\Models\UserToken;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Jobs\SignupVerify;
use App\Models\PasswordReset;
use Socialite;
use GuzzleHttp\Exception\ClientException;

class UserService implements UserContract {

    private $authProvider = 'facebook';

    /**
     * Create a new UserRepository instance.
     * @param  \App\Models\User $user
     * @return void
     */
    public function __construct($user) {
        $this->model = $user;
    }

    /**
     * function is used for sign up
     * @param type $data
     * @return type
     */
    public function signup($data, $complete = false) {

        if ($complete) {
            /*$user_data = [
                'name' => $data->name,
                'profile_image' => $data->profileImage,
                'is_profile_complete' => true,
                'zip_code' => $data->zipCode
            ];*/
            if (isset($data->name)) {
                $user_data['name'] = $data->name;
            }

            if (isset($data->profileImage)) {
                $user_data['profile_image'] = $data->profileImage;
            }

            if (isset($data->zipCode)) {
                $user_data['zip_code'] = $data->zipCode;
            }

            $user_data['is_profile_complete'] = 1;
            
            $this->update($data->userId, $user_data);
            $user = User::find($data->userId);
            return $user;
        }

        $user = User::saveUser($data);
        $this->resendEmail($user->email);

        return $user;
    }

    /**
     * 
     * @param type $request
     * @return type
     */
    public function login($request) {
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            if (Auth::user()->is_email_verified === 0) {

                ## send verifictaion mail
                $this->resendEmail($request['email']);
                return trans('api.verification_mail_sent');
            }

            return $this->generateToken(Auth::user(), $request);
        } else {
            return trans('api.invalid_password');
        }
    }

    /**
     * Updates a user.
     * @param int
     * @param array
     */
    public function update($user_id, array $user_data) {
        $this->model->find($user_id)->update($user_data);
    }

    /**
     * Update user password.
     * @param  $password
     * @param  $user_id
     * @return void
     */
    public function updatePassword($password, $user_id) {
        $user = User::find($user_id);
        $user->password = bcrypt(strip_tags($password));
        $user->save();
    }

    /**
     * Verify user email.
     * @param string
     * @param void
     */
    public function verifyEmail($code) {
        $user = User::join((new PasswordReset)->getTable(), (new PasswordReset)->getTable() . '.email', '=', 'users.email')
                        ->where('token', $code)->select('users.*')->first();

        $column = 'is_email_verified';
        $msg = false;
        if (is_null($user)) {
            $msg = trans('api.invalid_link');
        } else if ($user->$column) {
            $msg = trans('api.already_verified');
        } else {
            $user->$column = true;
            $msg = trans('api.email_verified');
            $user->save();

            PasswordReset::whereToken($code)->delete();
        }
        return $msg;
    }

    /**
     * 
     * @param type $request
     * @return type
     */
    public function socialLogin($request) {
        try {
            $socialUser = Socialite::driver($this->authProvider)->userFromToken($request['accessToken']);
        } catch (ClientException $e) {
            return json_decode($e->getResponse()->getBody())->error->message;
        }
        if(empty($socialUser->email)) {
            return trans('api.not_valid_email');
        }
        $user = $this->fetchSocialUser($request['socialId']);

        if (null === $user) {

            $socialUser->name = $request['name'];
            $socialUser->profileImage = $request['profileImage'];
            $user = User::saveUser($socialUser, $this->authProvider);

            // send welcome email
            dispatch((new SignupVerify($socialUser->email, null)));
        }
        return $this->generateToken($user, $request);
    }

    /**
     * 
     * @param type $user
     * @param type $request
     * @return type
     */
    private function generateToken($user, $request) {
        $token = UserToken::saveToken($user->id, $request);
        $result['user'] = $user;
        $result['user']['token'] = $token;

        return $result;
    }

    /**
     * 
     * @param type $email
     */
    public function resendEmail($email) {
        $token = PasswordReset::generateVerificationCode($email);

        ## send verifictaion mail
        $url = url('verify-email') . '/' . $token;
        dispatch((new SignupVerify($email, $url)));
    }
    
    /**
     * 
     * @param type $social_id
     * @return type
     */
    private function fetchSocialUser($social_id) {
        return User::where([
                    ['auth_provider', '=', User::AUTHPROVIDER[$this->authProvider]],
                    ['social_id', '=', $social_id],
                ])->first();
    }

    public function getUserProfile($user_id) {
        return User::where('id',$user_id)->select('name','email','zip_code','profile_image')->first()->toArray();

    }
    /**
     * get user's details info
     * @param type $user_id
     * @return type
     */
    public function showUser($user_id){
        return User::find($user_id);
    }

    public function updateProfile($data) {
            if (isset($data->name)) {
                $user_data['name'] = $data->name;
            }

            if (isset($data->profileImage)) {
                $user_data['profile_image'] = $data->profileImage;
            }

            if (isset($data->zipCode)) {
                $user_data['zip_code'] = $data->zipCode;
            }
            
            $this->update($data->userId, $user_data);
            $user = User::find($data->userId);
            return $user;

    }

    public function setMonthlyLimit($req) {
        $data = ['monthly_limit' => $req->monthly_limit];
        $user = User::updateData($req->user->user_id, $data);
        return $user;
    }

}
