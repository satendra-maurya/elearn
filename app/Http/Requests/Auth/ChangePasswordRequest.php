<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;
use App\Models\User;

class ChangePasswordRequest extends BaseRequest {

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
        $required = 'required';
        return [
            'old_password' => $required,
            'password' => $required.'|min:'.User::ATTRIBUTE['PWD.MIN'].'|max:'.User::ATTRIBUTE['PWD.MAX'].'|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
            'password_confirmation' => $required.'|same:password'
        ];
    }

    public function messages() {
        return [
            'password_confirmation.same' => trans('passwords.same'),
            'password.regex' => trans('passwords.password_regex'),
            'password.min' => trans('passwords.password_regex')
        ];
    }

}
