<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreSousChapitreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => 'required|string|max:255',
            'contenu' => 'nullable|string',
            'ordre' => 'nullable|integer|min:0',
            'chapitre_id' => 'required|exists:chapitres,id',
        ];
    }

    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre du sous-chapitre est obligatoire.',
            'titre.max' => 'Le titre ne peut pas dépasser 255 caractères.',
            'chapitre_id.required' => 'Le chapitre est obligatoire.',
            'chapitre_id.exists' => 'Le chapitre sélectionné n\'existe pas.',
        ];
    }
}