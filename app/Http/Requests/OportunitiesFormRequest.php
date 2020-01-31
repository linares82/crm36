<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class OportunitiesFormRequest extends FormRequest
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
            //'oportunity_label_id' => 'required',
            'descripcion' => 'required|string|min:1|max:255',
            'oportunity_st_id' => 'required',
            //'usu_alta_id' => 'required',
            //'usu_mod_id' => 'required',
    
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
        $data = $this->only(['oportunity_label_id','descripcion','oportunity_st_id','usu_alta_id','usu_mod_id']);



        return $data;
    }

}