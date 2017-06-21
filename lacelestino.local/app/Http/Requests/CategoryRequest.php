<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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

    protected function getValidatorInstance() {
        $validator = parent::getValidatorInstance();
    	$validator->sometimes('title', 'unique:categories|max:255', function($input) {
            if ($this->route()->hasParameter('categories')) {
                $model = $this->route()->parameter('categories');

                return ($model->title !== $input->title) && !empty($input->title);
            }

            return !empty($input->title);
        });

        return $validator;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
        ];
    }
}
