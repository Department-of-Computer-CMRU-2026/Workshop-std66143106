<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'speaker',
        'location',
        'total_seats',
    ];

    protected $appends = ['remaining_seats'];

    /**
     * Get the users registered for this event.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'registrations')->withTimestamps();
    }

    /**
     * Calculate remaining seats.
     */
    public function getRemainingSeatsAttribute()
    {
        // remaining seats = total seats - number of registrations
        return max(0, $this->total_seats - $this->users()->count());
    }
}
