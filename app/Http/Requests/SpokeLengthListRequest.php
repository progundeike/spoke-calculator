<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpokeLengthListRequest extends FormRequest
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
            'hubModel' => 'string|max:30',
            'rimModel' => 'string|max:30',
            'crossR' => 'string|max:5',
            'crossL' => 'string|max:5',
            'wheelMemo' => 'nullable|string|max:200',
            'radialR' => 'numeric|min:0|max:600',
            'radialL' => 'numeric|min:0|max:600',
            'twoCrossR' => 'numeric|min:0|max:600',
            'twoCrossL' => 'numeric|min:0|max:600',
            'threeCrossR' => 'numeric|min:0|max:600',
            'threeCrossL' => 'numeric|min:0|max:600',
            'fourCrossR' => 'numeric|min:0|max:600',
            'fourCrossL' => 'numeric|min:0|max:600',

            'hole' => 'required|numeric|min:4|max:200',
            'pcdR' => 'required|numeric|min:0|max:100',
            'pcdL' => 'required|numeric|min:0|max:100',
            'centerFlangeR' => 'required|numeric|min:0|max:100',
            'centerFlangeL' => 'required|numeric|min:0|max:100',
        ];
    }
}
