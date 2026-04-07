<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'nom', 'prenom', 'email', 'password', 'role','avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isApprenant(): bool
    {
        return $this->role === 'apprenant';
    }

    public function formations()
    {
        return $this->belongsToMany(Formation::class)->withPivot('enrolled_at');
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function quizResults()
    {
        return $this->hasMany(QuizResult::class);
    }




    public function getAvatarUrlAttribute(): string
{
    if ($this->avatar) {
        return asset('storage/' . $this->avatar);
    }

    return asset('images/default-avatar.png');
}
}