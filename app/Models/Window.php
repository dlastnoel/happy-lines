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
        'has_doctor',
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
            ->withPivot('number')
            ->withPivot('id');
    }

    public function pending_patients()
    {
        // return patients of today
        return $this->belongsToMany(Patient::class, 'patient_user_window')
            ->withTimestamps()
            ->wherePivot('updated_at', '>=', Carbon::today()->toDateString())
            ->wherePivot('status', 'pending')
            ->withPivot('number')
            ->withPivot('id');
    }

    public function pending_patient($patient_id)
    {
        // return active pending patient
        return $this->belongsToMany(Patient::class, 'patient_user_window')
            ->withTimestamps()
            ->wherePivot('updated_at', '>=', Carbon::today()->toDateString())
            ->wherePivot('patient_id', $patient_id)
            ->wherePivot('status', 'pending')
            ->withPivot('status');
    }

    public function serving_patient()
    {
        // return patient with serving status
        return $this->belongsToMany(Patient::class, 'patient_user_window')
            ->withTimestamps()
            ->wherePivot('status', 'serving')
            ->withPivot('number')
            ->withPivot('status');
    }

    use HasFactory;
}
