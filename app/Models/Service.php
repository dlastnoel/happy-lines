<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Window;

class Service extends Model
{
    use HasFactory;


    protected $fillable = [
        'type',
        'description'
    ];

    public function windows()
    {
        return $this->belongsToMany(Window::class)->withTimestamps();
    }
}
