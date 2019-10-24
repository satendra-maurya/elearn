<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\BaseRequest;
use App\Models\User;

class CompleteProfileRequest extends BaseRequest {

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
            'name' => $required,
            'zipCode' => $required.'|5or9digit|numeric'
        ];
    }

}
