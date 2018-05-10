<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class EventosFormRequest extends FormRequest
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
            'short_name' => 'required|string|min:1|max:255',
            'detail' => 'required|string|min:1|max:255',
            'date' => 'required|string|min:1',
            'mail_bnd' => 'boolean',
            'day_before_sent' => 'required|numeric|min:-2147483648|max:2147483647',
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
        $data = $this->only(['short_name','detail','date','mail_bnd','day_before_sent','usu_alta_id','usu_mod_id']);

        $data['mail_bnd'] = $this->has('mail_bnd');


        return $data;
    }

}