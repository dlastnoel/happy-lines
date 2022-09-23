<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;

use App\Models\User;
use App\Models\Patient;
use Carbon\Carbon;

class Window extends Model
{
    protected $fillable = [
        'name',
        'description',
        'user_id',
        'is_active',
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class)->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'patient_user_window');
    }

    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'patient_user_window');
    }

    public function latest_patients()
    {
        // return patients of today
        return $this->belongsToMany(Patient::class, 'patient_user_window')
            ->withTimestamps()
            ->wherePivot('updated_at', '>=', Carbon::today()->toDateString())
            ->withPivot('number');
    }

    public function window_patient($patient_id)
    {
        // return patients of today
        return $this->belongsToMany(Patient::class, 'patient_user_window')
            ->withTimestamps()
            ->wherePivot('patient_id', $patient_id)
            ->wherePivot('status', 'pending')
            ->withPivot('status');
    }

    use HasFactory;
}
