<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateHubRequest extends FormRequest
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
            'hubModel' => 'required|string|max:100',
            'hole' => 'required|numeric|min:4|max:200',
            'pcdR' => 'required|numeric|min:0|max:100',
            'pcdL' => 'required|numeric|min:0|max:100',
            'centerFlangeR' => 'required|numeric|min:0|max:100',
            'centerFlangeL' => 'required|numeric|min:0|max:100',
            'hubMemo' => 'nullable|string|max:100',
        ];
    }

    public function attributes()
    {
        return [
            'hole' => 'スポークの本数',
            'pcdR' => 'PCD(ドライブサイド)',
            'pcdL' => 'PCD(ノンドライブサイド)',
            'centerFlangeR' => 'センターフランジ間距離(ドライブサイド)',
            'centerFlangeL' => 'センターフランジ間距離(ノンドライブサイド)',
            'hubModel' => 'ハブの名称',
            'hubMemo' => 'メモ欄',
        ];
    }
}
