<?php

namespace App\Http\Requests\Painel;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'        => 'required|min:3|max:1000',
            'number'      => 'required|numeric',
            'category'    => 'required',
            'description' => 'min:3|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é de preenchimento obrigatório!',
            'name.min' => 'O campo nome deve conter no minimo 3 caracteres!',
            'name.max' => 'O campo nome deve conter no máximo 1000 caracteres!',
            'number.numeric' => 'Precisa ser apenas numeros!',
            'number.required' => 'O campo numero é de preenchimento obrigatório!',
            'category.required' => 'O campo categoria é de preenchimento obrigatório!',

        ];
    }
}
