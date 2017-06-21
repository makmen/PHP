<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Auth;

class ArticleRequest extends FormRequest
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
    	$validator->sometimes('alias', 'unique:articles|max:255', function($input) {
            if ($this->route()->hasParameter('articles')) {
                $model = $this->route()->parameter('articles');

                return ($model->alias !== $input->alias) && !empty($input->alias);
            }

            return !empty($input->alias);
        });

        return $validator;
    }
    
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'text' => 'required',
            'category_id' => 'required|integer'
        ];
    }
}
