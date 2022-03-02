<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HubsRequest extends FormRequest
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
            'hubModel' => 'unique|required|string|max:100',
            'hole' => 'required|numeric|min:4|max:200',
            'pcdRight' => 'required|numeric|min:0|max:100',
            'pcdLeft' => 'required|numeric|min:0|max:100',
            'centerFlangeRight' => 'required|numeric|min:0|max:100',
            'centerFlangeLeft' => 'required|numeric|min:0|max:100',
            'hubMemo' => 'string|max:100',
        ];
    }

    public function attributes()
    {
        return [
            //
        ];
    }
}
