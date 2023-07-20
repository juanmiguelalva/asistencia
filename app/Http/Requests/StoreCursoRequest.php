<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreCursoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('cursos_create');
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
            'ciclo_id' => ['required', 'string', 'max:255'],
            'escuela' => ['required', 'string', 'max:255'],
        ];
    }
}
