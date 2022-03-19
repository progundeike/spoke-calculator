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
            'erd' => 'required|numeric|min:100|max:1000',
            'hole' => 'required|numeric|min:4|max:200',
            'rimOffset' => 'required|numeric|min:0|max:100',
            'pcdR' => 'required|numeric|min:0|max:100',
            'pcdL' => 'required|numeric|min:0|max:100',
            'centerFlangeR' => 'required|numeric|min:0|max:100',
            'centerFlangeL' => 'required|numeric|min:0|max:100',
            'hubModel' => 'nullable|string|max:30',
            'rimModel' => 'nullable|string|max:30',
        ];
    }

    public function attributes()
    {
        return [
            'erd' => 'ERD',
            'hole' => 'スポークの本数',
            'rimOffset' => 'リムオフセット',
            'pcdR' => 'PCD(ドライブサイド)',
            'pcdL' => 'PCD(ノンドライブサイド)',
            'centerFlangeR' => 'センターフランジ間距離(ドライブサイド)',
            'centerFlangeL' => 'センターフランジ間距離(ノンドライブサイド)',
            'hubModel' => 'ハブの名称',
            'rimModel' => 'リムの名称',
        ];
    }
}
