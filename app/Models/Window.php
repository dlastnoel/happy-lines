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
        'is_active',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    use HasFactory;
}
