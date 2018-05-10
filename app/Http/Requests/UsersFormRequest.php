<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class UsersFormRequest extends FormRequest
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
            'name' => 'required|string|min:1|max:255',
            'email' => 'required|string|min:1|max:255|email',
            'password' => 'confirmed',
            'remember_token' => 'nullable|string|min:0|max:100',
    
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
        $data = $this->only(['name','email','password','password-confirm','remember_token']);



        return $data;
    }
    
    public function messages(){
        return [
        'password.confirmed'=>'Confirmacion del password no coincide',
        'email.email'=>'Formato de correo es incorrecto',
        ];
    }

}