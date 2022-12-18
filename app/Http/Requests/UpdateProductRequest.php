<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => ['required', 'string'],
            'description' => ['required', 'string', 'min:10'],
            'image' => ['required', 'image', 'max:1024']
        ];

        if ($this->method() == 'PUT') {
            $rules['image'] = ['nullable', 'image', ''];
        }

        return $rules;
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
                'description' => 'Nome do produto a ser atualizado.',
                'example' => 'Cadeira',
            ],
            'description' => [
                'description' => 'Descrição do produto a ser atualizado.',
                'example' => 'Cadeira de balanço para p vovo',
            ],
            'iamge' => [
                'description' => 'Imagem do produto a ser atualizado.'
            ],
            
        ];
    }
}
