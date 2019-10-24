<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResetPasswordLimit extends Model {

    const ACTIVE = 1;
    const LIMIT = 5;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reset_password_limits';
    public $timestamps = false;

    /**
     * function is used to fetch and save reset password limit
     * @param type $user_id
     * @return boolean
     */
    public static function resetLimit($user_id) {
        $limit = ResetPasswordLimit::where('user_id', $user_id)->whereDate('reset_date', '=', date('Y-m-d'))->first();
        if (is_null($limit)) {
            ResetPasswordLimit::where('user_id', $user_id)->delete();
            $reset = new ResetPasswordLimit();
            $reset->user_id = $user_id;
            $reset->reset_date = date('Y-m-d');
            $reset->reset_count = static::ACTIVE;
            $reset->save();
            return $reset->reset_count;
        } else if ($limit->reset_count == env('RESET_LIMIT', static::LIMIT)) {
            return false;
        } else {
            ResetPasswordLimit::where('id', $limit->id)->update(['reset_count' => $limit->reset_count + static::ACTIVE]);
            return $limit->reset_count;
        }
    }

}
