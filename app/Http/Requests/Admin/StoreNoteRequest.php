<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreNoteRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'formation_id' => 'required|exists:formations,id',
            'note' => 'required|numeric|min:0|max:20',
            'commentaire' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'L\'apprenant est obligatoire.',
            'formation_id.required' => 'La formation est obligatoire.',
            'note.required' => 'La note est obligatoire.',
            'note.min' => 'La note doit être entre 0 et 20.',
            'note.max' => 'La note doit être entre 0 et 20.',
        ];
    }
}