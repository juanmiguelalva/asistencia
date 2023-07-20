<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('clases_create');
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
                'date_format:H:i',
                "required"
            ],
            "hora_fin" => [
                'date_format:H:i',
                "required",
                'after:hora_inicio'
            ],
            'curso_id' => [
                'required', 'int',
                // Rule::unique('clases')->where(function ($query) {
                //     $query->where('user_id', $this->user_id);
                // })
            ],
            'user_id' => ['required', 'int'],
        ];
    }
}
