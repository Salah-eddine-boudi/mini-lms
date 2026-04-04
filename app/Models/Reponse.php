<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    use HasFactory;

    protected $fillable = ['texte', 'is_correct', 'question_id'];

    protected function casts(): array
    {
        return [
            'is_correct' => 'boolean',
        ];
    }

    
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}