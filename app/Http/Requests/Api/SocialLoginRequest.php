<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\BaseRequest;

class SocialLoginRequest extends BaseRequest {

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
            'deviceType' => $required . '|in:IPHONE,ANDROID',
            'deviceToken' => 'sometimes|string',
            'accessToken' => $required,
            'socialId' => $required,
            'profileImage' => $required . '|url',
            'name' => 'nullable|sometimes'
        ];
    }

}
