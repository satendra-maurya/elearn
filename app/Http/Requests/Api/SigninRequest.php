<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\BaseRequest;
use App\Models\User;

class SigninRequest extends BaseRequest {

    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules() {
        $required = 'required';
        return [
            'email' => $required.'|email|max:'.User::ATTRIBUTE['EMAIL.MAX'].'|exists:users,email,role,'.User::ROLE_USER,
            'password' => $required.'|string',
            'deviceType' => $required.'|in:IPHONE,ANDROID',
            'deviceToken' => 'sometimes|string'
        ];
    }

    public function messages() {
        return [
            'email.exists' => trans('api.not_registered')
        ];
    }

}
