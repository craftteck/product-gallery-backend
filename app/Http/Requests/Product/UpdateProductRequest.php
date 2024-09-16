<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        // TODO: バリデーションのテスト
        return [
            'name' => 'required|string|max:100',
            'summary' => 'required|string|max:300',
            'description' => 'required|string|max:2000',
            'url' => 'required|url',
            'version' => 'required|integer'
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
            'version' => 'バージョン'
        ];
    }
}