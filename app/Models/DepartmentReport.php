<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'date',
        'chef_id',
        'submitted_at',
    ];

    // Indique à Laravel que submitted_at est une date/heure
    protected $casts = [
        'submitted_at' => 'datetime',
    ];

    // Un rapport appartient à un département
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // Un rapport a été soumis par un chef
    public function chef()
    {
        return $this->belongsTo(User::class, 'chef_id');
    }
}