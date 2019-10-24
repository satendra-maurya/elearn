<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Models\User;

class NotificationRequest  extends BaseRequest {

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
            'title' => $required,
            'message' => $required.'|max:500',
            'user_id' => $required
        ];
    }

    public function messages() {
        return [
            'user_id' => 'username field is required',
        ];
    }

}
