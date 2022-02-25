<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalcRequest extends FormRequest
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
            'erd' => 'required|numeric|min:100|max:900',
            'numberOfSpoke' => 'required|numeric|min:4|max:100',
            'rimOffset' => 'required|numeric|min:0|max:100',
            'pcdRight' => 'required|numeric|min:0|max:100',
            'pcdLeft' => 'required|numeric|min:0|max:100',
            'centerFlangeRight' => 'required|numeric|min:0|max:100',
            'centerFlangeLeft' => 'required|numeric|min:0|max:100',
        ];
    }

    public function attributes()
    {
        return [
            'erd' => 'ERD',
            'numberOfSpoke' => 'スポークの本数',
            'rimOffset' => 'リムオフセット',
            'pcdRight' => 'PCD(ドライブサイド)',
            'pcdLeft' => 'PCD(ノンドライブサイド)',
            'centerFlangeRight' => 'センターフランジ間距離(ドライブサイド)',
            'centerFlangeLeft' => 'センターフランジ間距離(ノンドライブサイド)',
        ];
    }
}
