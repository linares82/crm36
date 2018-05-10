<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CustomersFormRequest extends FormRequest
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
            //'razon' => 'required|string|min:1|max:255',
            'nombre1' => 'required|string|min:1|max:255',
            'nombre2' => 'nullable|string|min:0|max:255',
            'ape_paterno' => 'required|string|min:1|max:255',
            'ape_materno' => 'nullable|string|min:0|max:255',
            'calle' => 'required|string|min:1|max:255',
            //'numero_int' => 'required|string|min:1|max:255',
            'numero_ext' => 'nullable|string|min:0|max:255',
            'colonia' => 'required|string|min:1|max:255',
            'ciudad' => 'nullable|string|min:0|max:255',
            'estado_id' => 'required',
            'municipio_id' => 'required',
            'cp' => 'required|string|min:1|max:255',
            'celular' => 'nullable|string|min:0|max:255',
            'celular_confirmar' => 'boolean',
            //'cuenta_sms' => 'required|numeric|min:-2147483648|max:2147483647',
            'fijo' => 'nullable|string|min:0|max:255',
            'email' => 'nullable|string|min:0|max:255',
            //'cuenta_email' => 'required|numeric|min:-2147483648|max:2147483647',
            'email_confirmar' => 'boolean',
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
        $data = $this->only(['oportunity_id','razon','nombre1','nombre2','ape_paterno','ape_materno','calle','numero_int','numero_ext','colonia','ciudad','estado_id','municipio_id','cp','celular','celular_confirmar','cuenta_sms','fijo','email','cuenta_email','email_confirmar','usu_alta_id','usu_mod_id']);

        $data['celular_confirmar'] = $this->has('celular_confirmar');
        $data['email_confirmar'] = $this->has('email_confirmar');


        return $data;
    }

}