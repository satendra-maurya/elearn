<?php

/**
 * Utility Class
 * This class handles common function  for the application
 *
 * @class      Utility
 * @author     Jitender Yadav <jitender.yadav1@appster.in>
 * @version    Release: v1
 * 
 */

namespace App\Utility;

use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class Utility {

    const LIMIT = 7;

    /**
     * Generate session token
     *
     * Generate unique md5 hashed string
     * @param null
     * @return string
     */
    public static function generateToken() {
        $time = time();
        $str = 'abcdefghijklmnopqrstuvwxyz0123456789' . "$time";
        $shuffled = str_shuffle($str);
        return md5($shuffled);
    }

    /**
     * Generate random string
     * Generate random string
     * @param limit integer
     * @return string
     */
    public static function randomString($limit = Utility::LIMIT) {
        $alphabet = 'abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789';
        for ($i = 0; $i < $limit; $i++) {
            $n = rand(0, strlen($alphabet) - 1);
            $pass[$i] = $alphabet[$n];
        }
        return implode($pass);
    }

    /**
     * Create Request on the fly
     * Generate random string
     * @param data array
     * @return object
     */
    public static function createRequest($data, $method = 'POST') {
        $request = new \Illuminate\Http\Request();
        $request->setMethod($method);
        $request->request->add($data);
        return $request;
    }

    /**
     * this function is used to check token expride after specific time
     * Generate random string
     * @param dataTime yyyy-mm-dd h:i:s
     * @param minute
     * @return boolian
     */
    public static function isExpire($datetime, $minute){
        $dt = new Carbon($datetime);
        return $dt->addMinutes($minute)->isPast();
    }

}
