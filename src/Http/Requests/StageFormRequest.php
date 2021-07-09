<?php

namespace Clipsmm\Workflow\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StageFormRequest extends FormRequest
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
            'workflow_id' => "required",
            'max_duration' => "required|numeric|min:0",
            'type' => "required",
            'notify' => "required",
            'active' => "required",
            'entity_editable' => "required",
            'expired_stage_id' => "nullable",
            'order_no' => "nullable",
        ];
    }
}
