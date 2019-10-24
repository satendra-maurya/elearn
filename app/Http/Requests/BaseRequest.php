<?php

namespace App\Http\Requests;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Str;

/**
 * This class is base class for all API request
 * @author Appster
 */
class BaseRequest extends Request {
    
    
    protected $response = null;
    
    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator) {
        $errors = $validator->errors();
        if (!$this->wantsJson() && (!Str::contains(\Request::getRequestUri(), 'api'))) {
            return parent::failedValidation($validator);
        }

        $this->response['result'] = [];
        $this->response['message'] = $errors->first();
        throw new HttpResponseException(response()->json($this->response, Response::HTTP_BAD_REQUEST));
    }

}
