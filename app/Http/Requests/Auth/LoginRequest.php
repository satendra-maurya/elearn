<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;
use App\Models\User;

class LoginRequest extends BaseRequest {

     /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'email' => 'required|email|exists:users,email,role,'.User::ROLE_ADMIN,
            'password' => 'required',
        ];
    }

    public function messages() {
        return [
            'email.exists' => trans('api.not_registered')
        ];
    } 

}
