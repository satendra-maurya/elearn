<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Utility\Utility;

class UserToken extends Model {
    
    const IPHONE = 1;
    const ANDROID = 2;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_tokens';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'token','device_token','device_type'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at','updated_at'];

    /** function used to set inverse has one (belongs to) eloquent relation
     * @param none
     * @return realtion
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /** function is used to get user object
     *
     * @param session id (string)
     * @return user object with data
     */
    public static function getUserByToken($token) {
        return User::join((new UserToken)->getTable(), (new UserToken)->getTable() . '.user_id', '=', 'users.id')
                        ->select('user_id','is_profile_complete')
                        ->where((new UserToken)->getTable() . '.token', $token)
                        ->first();
    }
    
    /**
     * 
     * @param type $user_id
     * @param type $request
     * @return type
     */
    public static function saveToken($user_id,$request) {
        ## delete old token
        UserToken::whereUserId($user_id)->delete();
        
        $token = Utility::generateToken();
        $device = ($request['deviceType'] == 'IPHONE') ? static::IPHONE : static::ANDROID;
        $data = [
            'user_id' => $user_id,
            'device_token' => $request['deviceToken'] ?? '1234567',
            'token' => $token,
            'device_type' => $device
        ];
        $session = new UserToken();
        $session->insert($data);
        
        return $token;
    }

}
