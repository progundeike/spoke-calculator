<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RimsRequest extends FormRequest
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
            'rimModel' => [Rule::unique('rims')->where(function ($query) {
                return $query->where('user_id', $this->user()->id);
            }), 'required', 'string', 'max:100'],
            'erd' => 'required|numeric|min:100|max:1000',
            'hole' => 'required|numeric|min:4|max:200',
            'rimOffset' => 'required|numeric|min:0|max:100',
            'rimMemo' => 'nullable|string|max:100',
        ];
    }

    public function attributes()
    {
        return [
            'rimModel' => 'リムの名称',
            'erd' => 'ERD',
            'hole' => 'スポークの本数',
            'rimOffset' => 'リムオフセット',
            'rimMemo' => 'メモ欄',
        ];
    }
}
