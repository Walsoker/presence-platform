<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Un département a un chef (un seul utilisateur avec role='chef')
    public function chef()
    {
        return $this->hasOne(User::class)->where('role', 'chef');
    }

    // Un département a plusieurs utilisateurs (membres)
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Un département a plusieurs rapports de soumission
    public function reports()
    {
        return $this->hasMany(DepartmentReport::class);
    }
}