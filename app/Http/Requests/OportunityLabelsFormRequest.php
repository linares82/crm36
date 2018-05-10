<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class OportunityLabelsFormRequest extends FormRequest
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
        $rules = [
            'etiqueta' => 'required|string|min:1|max:255',
            'descripcion' => 'required|string|min:1|max:255'
    
        ];

        return $rules;
    }
    
    /**
     * Get the request's data from the request.
     *
     * 
     * @return array
     */
    public function getData()
    {
        $data = $this->only(['etiqueta','descripcion','usu_alta_id','usu_mod_id']);



        return $data;
    }

}