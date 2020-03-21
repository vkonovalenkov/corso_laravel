<?php

namespace LaraCourse\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
        return \Auth::user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //dd($this->id);
        return    [
            'name' => 'required|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users','email')->ignore($this->id,'id')
            ]
            ,
            'password' => 'nullable|min:6|confirmed',
            'role' =>  [
                'required',
                Rule::in(['user','admin'])
            ]
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Il campo email è obbligatorio',
            'role.required' => 'Il campo role è obbligatorio',
            'email.unique' => 'La mail deve essere  univoca',
            'name.required' => 'Il campo nome è obbligatorio',
        ];
    }
}
