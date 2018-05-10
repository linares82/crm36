<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class PredefinedTasksFormRequest extends FormRequest
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
            'task_id' => 'required',
            'detail' => 'required|string|min:1|max:255',
            'activo' => 'boolean',
            'dias' => 'required',
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
        $data = $this->only(['task_id','detail','activo', 'dias','usu_alta_id','usu_mod_id']);

        $data['activo'] = $this->has('activo');


        return $data;
    }

}