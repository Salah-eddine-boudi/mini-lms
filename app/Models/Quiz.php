<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $table = 'quiz';

    protected $fillable = ['titre', 'description', 'sous_chapitre_id'];

    public function sousChapitre()
    {
        return $this->belongsTo(SousChapitre::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('ordre');
    }

    public function results()
    {
        return $this->hasMany(QuizResult::class);
    }
}