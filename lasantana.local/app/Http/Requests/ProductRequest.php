<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{

    public function authorize()
    {
        return \Auth::user();
    }

    public function rules()
    {
        if (isset($this->img)) {
            $this->input('img', $this->img);
        }
        return [
            'title' => 'required|max:255',
            'content' => 'required',
            'price' => 'integer',
            'new' => 'integer',
            'category_id' => 'integer',
            'img' => 'required',
        ];
    }
    
    public function messages() {
        return [
            'required' => 'Поле :attribute обязательно к заполнению',
            'max' => 'Поле :attribute содержать слишком много символов',
            'integer' => 'Поле :attribute должно содержить цифры'
        ];
    }
    

}
