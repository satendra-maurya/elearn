<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Utility\Utility;

class PasswordReset extends Model {

    protected $fillable = ['email', 'token', 'role'];

    // to disable updated_at in database
    public function setUpdatedAtAttribute($value) {
        
    }

    /**
     * 
     * @param int $email
     * @return type
     */
    public static function generateVerificationCode($email) {
        
        PasswordReset::whereEmail($email)->delete();
        
        $model = new PasswordReset();
        $model->email = $email;
        $model->token = Utility::randomString();
        $model->save();
        return $model->token;
    }

}
