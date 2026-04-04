<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SousChapitre extends Model
{
    use HasFactory;

    protected $table = 'sous_chapitres';

    protected $fillable = ['titre', 'contenu', 'ordre', 'chapitre_id'];

    
    public function chapitre()
    {
        return $this->belongsTo(Chapitre::class);
    }

    public function quiz()
    {
        return $this->hasOne(Quiz::class);
    }
}