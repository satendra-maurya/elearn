<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;
use App\Models\User;

class ResetPasswordRequest extends Request {

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
            'token' => $required,
            'email' => $required . '|exists:users,email',
            'password' => $required . '|confirmed|min:' . User::ATTRIBUTE['PWD.MIN'] . '|max:' . User::ATTRIBUTE['PWD.MAX'].'|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
            'password_confirmation' => $required
        ];
    }

    public function messages() {
        return [
            'password.confirmed' => trans('passwords.same'),
            'password.regex' => trans('passwords.password_regex'),
            'password.min' => trans('passwords.password_regex')
        ];
    }

}
