<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AdviserCateRequest extends Request
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
        return [
            'name' => 'required',
            'pid' => 'required|numeric',

            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'numeric' => trans('validation.numeric'),
            'required' => trans('validation.required'),
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans('labels.menu.name'),
            'pid' => trans('labels.menu.pid'),

            'status' => trans('labels.menu.status'),
        ];
    }
}
