<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['texte', 'ordre', 'quiz_id'];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function reponses()
    {
        return $this->hasMany(Reponse::class);
    }

    public function bonneReponse()
    {
        return $this->hasOne(Reponse::class)->where('is_correct', true);
    }
}