<?php

/**
 * Social Login Class
 * This class handles common function  for the application
 *
 * @class      SocialLogin
 * @author     Appster
 * @version    Release: v1
 * 
 */

namespace App\Utility;

class SocialLogin {

    /**
     * This method is used to validate facebook access token
     * @param type $param
     */
    public static function isFacebookTokenValid($facebook_access_token, $facebook_id = null, $image = false) {
        $fbUrl = env("FB_URL", "https://graph.facebook.com/me") . "?access_token=" . $facebook_access_token;
        $json = static::httpCurlGet($fbUrl, $image);
        $response = json_decode($json);
        if ($image) {
            if (isset($response->profile_image->data->url)) {
                $result = $response->profile_image->data->url;
            } else {
                $result = null;
            }
            return $result;
        }
        if (empty($response->id) || ($response->id != $facebook_id)) {
            return false;
        }
        return true;
    }

    /**
     * This method is used to make GET request using curl
     * @param type $url
     * @return type
     */
    public static function httpCurlGet($url,$image = false) {
        $ch = curl_init();
        $fields = 'fields=id,name,picture.width(720).height(720).as(profile_image)';
        $fb_url = ($image) ? $url . '&' . $fields : $url;
        curl_setopt($ch, CURLOPT_URL, $fb_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);

        curl_close($ch);
        return $output;
    }

}
