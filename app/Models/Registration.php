<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Registration extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'event_id',
        'ticket_code',
        'status',
    ];

    /**
     * Bootstrap the model and auto-generate ticket_code on creation.
     */
    protected static function booted(): void
    {
        static::creating(function (Registration $registration) {
            if (empty($registration->ticket_code)) {
                $registration->ticket_code = (string) Str::uuid();
            }
        });
    }

    /**
     * Get the user that owns the registration.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the event that this registration belongs to.
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Check if the ticket has been used.
     */
    public function isUsed(): bool
    {
        return $this->status === 'used';
    }

    /**
     * Check if the ticket is pending (not yet used).
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Mark the ticket as used.
     */
    public function markAsUsed(): bool
    {
        return $this->update(['status' => 'used']);
    }
}
