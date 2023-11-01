<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUpdateUpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'Valor_Doc' => [
                'required'
            ],
            'Loc_Box_Eti' => [
                'required'
            ]

        ];
    }

    public function messages()
    {
        return [
            'Valor_Doc.required' => 'O campo Valor é obrigatório ',
            'Loc_Box_Eti.required' => 'O campo Caixa é obrigatório '
        ];
    }
}
