<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCursoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('cursos_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'codigo' => ['required', 'int'],
            'nombre' => ['required', 'string', 'max:255'],
            'ciclo_id' => ['required', 'exists:ciclos,id'],
            'escuela' => ['required', 'string', 'max:255'],
        ];
    }
}
