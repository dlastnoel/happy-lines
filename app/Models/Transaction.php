<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'type',
        'description',
    ];

    public function window()
    {
        return $this->hasOne(Window::class);
    }

    use HasFactory;
}
