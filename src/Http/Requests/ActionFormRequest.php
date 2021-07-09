<?php

namespace Clipsmm\Workflow\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActionFormRequest extends FormRequest
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
            'name' => "required",
            'stage_id' => "required",
            'next_stage_id' => "nullable",
            'button' => "required",
            'active' => "required",
        ];
    }
}
