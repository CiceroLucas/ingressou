<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class PublicEventController extends Controller
{
    /**
     * Display the public listing of upcoming events.
     */
    public function index()
    {
        $events = Event::where('event_date', '>=', now())
                       ->orderBy('event_date', 'asc')
                       ->paginate(9);

        return view('events.index', compact('events'));
    }

    /**
     * Display the details of a specific event.
     */
    public function show(Event $event)
    {
        $registrationCount = $event->registrations()->count();

        // Check if the current user is already registered
        $isRegistered = false;
        $registration = null;

        if (auth()->check()) {
            $registration = $event->registrations()
                                  ->where('user_id', auth()->id())
                                  ->first();
            $isRegistered = (bool) $registration;
        }

        return view('events.show', compact('event', 'registrationCount', 'isRegistered', 'registration'));
    }
}
