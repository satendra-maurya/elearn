<?php

namespace App\Services\Contracts;

Interface YodleeContract {

	public function cobrandLogin();

	public function userRegister($request);

	public function getAccessToken($request);

	public function saveYodleeUser($data);
}