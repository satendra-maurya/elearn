<?php

namespace App\Services\Contracts;

Interface UserContract {

    public function login($request);
    
    public function socialLogin($request);
    
    public function signup($request,$flag);
    
    public function update($user_id,array $request);

    public function showUser($user_id);
    
    public function updatePassword($password,$user_id);
    
    public function verifyEmail($request);

    public function getUserProfile($user_id);

    public function updateProfile($request);
}
