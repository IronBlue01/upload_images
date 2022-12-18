<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'description' => ['required', 'string', 'min:10'],
            'image' => ['required', 'image', 'max:1024']
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'O campo :attribute deve ser prenchido',
            '*.string' => 'O campo :attribute deve ser do tipo string',
            "*.min" => 'O campo :attribute deve ter no minimo :min caracteres'
        ];
    }

    public function bodyParameters()
    {
        return [
            'name' => [
                'description' => 'Nome do produto a ser cadastrado.',
                'example' => 'Cadeira',
            ],
            'description' => [
                'description' => 'Descrição do produto a ser cadastrado.',
                'example' => 'Cadeira de balanço para p vovo',
            ],
            'iamge' => [
                'description' => 'Imagem do produto a ser cadastraro.'
            ],
            
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->name),
        ]);
    }
}
