<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'formation_id', 'note', 'commentaire'];

    protected function casts(): array
    {
        return [
            'note' => 'decimal:2',
        ];
    }

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }
}