<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class FilesCustomersFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'oportunity_id' => 'required',
            'archivo' => 'required|string|min:1|max:255',
            'nota' => 'required|string|min:1|max:255',
            'usu_alta_id' => 'required',
            'usu_mod_id' => 'required',
    
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
        $data = $this->only(['oportunity_id','archivo','nota','usu_alta_id','usu_mod_id']);



        return $data;
    }

}