<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Window;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_id',
        'fullname',
        'sex',
        'birthdate',
        'address',
        'contact_no',
    ];

    public function windows()
    {
        return $this->belongsToMany(Window::class, 'patient_user_window')->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'patient_user_window')->withTimestamps();
    }
}
