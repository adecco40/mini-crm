<?php

namespace App\Models;

use App\Enums\LeadStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'phone',
        'status',
        'note',
    ];

    protected $casts = [
        'status' => LeadStatus::class,
    ];

    protected static function booted()
    {
        static::creating(function ($lead) {
            if (auth()->check()) {
                $lead->assigned_to = auth()->id();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}