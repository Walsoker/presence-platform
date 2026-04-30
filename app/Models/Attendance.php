<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'status',
        'chef_id',
    ];

    // Un pointage appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Un pointage a été créé par un chef (le chef qui a pointé)
    public function chef()
    {
        return $this->belongsTo(User::class, 'chef_id');
    }
}