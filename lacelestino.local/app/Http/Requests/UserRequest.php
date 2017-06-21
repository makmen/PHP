<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = (isset($this->route()->parameters['user']->id)) ? 
                $this->route()->parameters['user']->id : '';
        return [
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'login' => 'required|max:255|unique:users,login,' . $id,
            'role_id' => 'required|integer',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ];
    }
}
