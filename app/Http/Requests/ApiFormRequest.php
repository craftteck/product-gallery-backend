<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * API用のFormRequest
 * 個別APIのFormRequestはこのクラスを継承する
 */
class ApiFormRequest extends FormRequest
{
    /**
     * バリデーションエラー時のレスポンスをJSONで返す
     */
    protected function failedValidation(Validator $validator)
    {
        $response['errors']  = $validator->errors()->toArray();
    
        throw new HttpResponseException(response()->json($response, 400));        
    }
}
