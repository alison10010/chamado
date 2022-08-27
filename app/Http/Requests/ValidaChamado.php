<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidaChamado extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        $id = $this->id ?? ''; // PEGA O ID QUE ESTÁ SENDO EDITADO

        $rules = [
            'nome' => 'required|string|max:100|min:2', 
            'setor' => ['required', 'min:2']
        ];
        
        return $rules;
    }
}
