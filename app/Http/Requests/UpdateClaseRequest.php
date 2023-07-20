<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('clases_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'dia' => ['required', 'int'],
            "hora_inicio" => [
                // 'date_format:H:i',
                "required"
            ],
            "hora_fin" => [
                "required",
                'after:hora_inicio'
            ],
            'curso_id' => [
                'required',
                // Rule::unique('clases')->where(function ($query) {
                //     $query->where('id', '!=', $this->route('clase')->id);
                // })
            ],
            'user_id' => ['required', 'exists:users,id'],
        ];
    }
}
