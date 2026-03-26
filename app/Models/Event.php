<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'event_title',
        'description',
        'event_date',
        'event_time',
        'location',
        'max_participants',
        'status',
    ];

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function registeredUsers()
    {
        return $this->belongsToMany(User::class, 'event_registrations')
            ->wherePivot('status', 'registered');
    }
}
