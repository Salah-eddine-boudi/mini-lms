<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuizRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sous_chapitre_id' => 'required|exists:sous_chapitres,id',
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre du quiz est obligatoire.',
            'sous_chapitre_id.required' => 'Le sous-chapitre est obligatoire.',
            'sous_chapitre_id.exists' => 'Le sous-chapitre sélectionné n\'existe pas.',
        ];
    }
}