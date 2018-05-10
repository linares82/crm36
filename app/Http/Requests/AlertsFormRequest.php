<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class AlertsFormRequest extends FormRequest
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
            'oportunity_id' => 'required',
            'message' => 'required|string|min:1|max:255',
            'detail' => 'string|min:1|max:255',
            'date_send' => 'required|string|min:1',
            'mail_bnd' => 'boolean',
            'day_before_sent' => 'required|numeric|min:-2147483648|max:2147483647',
            
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
        $data = $this->only(['oportunity_id','message','detail','date_send','mail_bnd','day_before_sent','usu_alta_id','usu_mod_id']);

        $data['mail_bnd'] = $this->has('mail_bnd');


        return $data;
    }

}