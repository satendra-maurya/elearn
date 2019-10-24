<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword as ResetPasswordNotification;

class User extends Authenticatable {

    use Notifiable;

    // constants for attribute length
    const ATTRIBUTE = [
        'EMAIL.MAX' => 45,
        'PWD.MIN' => 8,
        'PWD.MAX' => 20,
        'IMG.MAX' => 2048
    ];
    const AUTHPROVIDER = [
        'email' => 1,
        'facebook' => 2
    ];
    // constants
    const ROLE_ADMIN = 1;
    const ROLE_USER = 1;
    const APPROVE = 1;
    const DEACTIVE = 0;

    /**
     * The attributes that are mass assignable except id.
     *
     * @var array
     */
    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token', 'created_at', 'updated_at'
    ];

    /** function used to set has many eloquent relation
     * @param none
     * @return realtion
     */
    public function token() {
        return $this->hasMany(UserToken::class);
    }
    
    /** function used to set has one eloquent relation
     * @param none
     * @return realtion
     */
    public function event() {
        return $this->hasMany(Event::class);
    }

    /** function used to set has one eloquent relation with yodlee_users
     * @param none
     * @return realtion
     */
    public function yodleeUser() {
        return $this->hasOne('App\Models\YodleeUser','user_id');
    }

    /**
     * Send the password reset notification.
     * @param  string  $token
     * @return void
     */
    public function passwordResetNotification($token, $email) {
        $this->notify(new ResetPasswordNotification($token, $email));
    }

    /**
     * 
     * @param type $data
     * @param type $provider
     */
    public static function saveuser($data, $provider = null) {
        $user = User::whereEmail($data->email)->first();
        if (is_null($user)) {
            $user = new User();
        }
        $user->role = static::ROLE_USER;
        $user->email = $data->email;
        if ($provider) {
            $user->auth_provider = static::AUTHPROVIDER[$provider];
            $user->social_id = $data->id;
            $user->is_email_verified = static::APPROVE;
            $user->name = $data->name;
            $user->profile_image = $data->profileImage;
            $user->is_profile_complete = static::APPROVE;
            $user->is_active = true;
        } else {
            $user->password = bcrypt($data['password']);
            $user->is_profile_complete = static::DEACTIVE;
        }

        $user->save();

        return $user;
    }

    /**
     * reset user password
     * @param type $request
     */
    public static function resetPassword($request) {

        $user = User::whereEmail($request->email)->first();
        $user->password = bcrypt($request->password);
        $user->save();

        //delete pending resets
        PasswordReset::whereEmail($request->email)->delete();

        return true;
    }

    /**
     * 
     * @param type $request
     * @param type $role
     * @return type
     */
    public static function userList($request) {
        $search = $request->search;

        $query = User::whereRole(static::ROLE_USER);
        if (!empty($search)) {
            $query->where('email', 'LIKE', "%$search%")
                    ->orWhere('name', 'LIKE', "%$search%");
        }
        return $query;
    }

    /**
     * 
     * @param type $request
     * @param type $id
     */
    public static function updateStatus($request, $id) {
        $user = User::find($id);

        if ($request['status'] == 'true') {
            $user->is_active = static::APPROVE;
        } else {
            $user->is_active = static::DEACTIVE;
        }
        $user->save();
        UserToken::whereUserId($id)->delete();
    }

    /** to update any field of User
     * 
     * @param array $data
     * @param type $id
     */
    public static function updateData($id, $data){
        $user = User::find($id);
        $user->update($data);
        return $user;
    }

    public static function getYodleeUsers(){
       return User::whereRole(2)->whereIsActive(1)->whereIsYodleeAccount(1)->get();
    }

    /** function used to get user by id
     * @param $id
     * @return user instance
     */
    public static function getUser($id) {
        return User::find($id);
    }

}
