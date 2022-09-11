<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;

class Window extends Model
{
    protected $fillable = [
        'name',
        'transaction_id',
        'description',
        'is_occupied',
        'is_active',
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    use HasFactory;
}
