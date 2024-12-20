<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Packages\Domain\Product\ProductName;

class CreateProductRequest extends FormRequest
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
        $productNameMaxLength = ProductName::MAX_LENGTH;

        return [
            'name' => "required|string|max:$productNameMaxLength",
            'summary' => 'required|string|max:300',
            'description' => 'required|string|max:2000',
            'url' => 'required|url',
        ];
    }

    /**
     * @return array<string,string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'プロダクト名',
            'summary' => '概要',
            'description' => '説明',
            'url' => 'URL',
        ];
    }
}
