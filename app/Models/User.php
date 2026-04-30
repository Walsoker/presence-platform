<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'department_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relation : un utilisateur appartient à un département
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // Relation : un utilisateur a plusieurs pointages
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    // Relation : un chef a plusieurs rapports de soumission
    public function submittedReports()
    {
        return $this->hasMany(DepartmentReport::class, 'chef_id');
    }

    // Méthodes pour vérifier le rôle facilement
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isChef()
    {
        return $this->role === 'chef';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }
}