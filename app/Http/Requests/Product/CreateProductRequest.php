<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\ApiFormRequest;

class CreateProductRequest extends ApiFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // TODO: バリデーションは別途検討（文字数上限など）
        return [
            'name' => 'required',
            'summary' => 'required',
            'description' => 'required',
            'url' => 'required',
        ];
    }
}
