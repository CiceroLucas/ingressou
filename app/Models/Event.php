<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'description',
        'event_date',
        'location',
        'banner_path',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'event_date' => 'datetime',
        ];
    }

    /**
     * Get the registrations for the event.
     */
    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    /**
     * Get the users registered for the event.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'registrations')
                    ->withPivot('ticket_code', 'status')
                    ->withTimestamps();
    }
}
