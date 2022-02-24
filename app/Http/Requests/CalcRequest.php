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
            'erd' => 'required|numeric|max:700',
            'numberOfSpoke' => 'required|numeric|max:100',
            'rimOffset' => 'required|numeric|max:100',
            'pcdRight' => 'required|numeric|max:100',
            'pcdLeft' => 'required|numeric|max:100',
            'centerFlangeRight' => 'required|numeric|max:100',
            'centerFlangeLeft' => 'required|numeric|max:100',
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
