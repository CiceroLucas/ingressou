<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    /**
     * Register the authenticated user in an event.
     */
    public function store(Event $event)
    {
        $user = auth()->user();

        // Check if already registered
        $exists = Registration::where('user_id', $user->id)
                              ->where('event_id', $event->id)
                              ->exists();

        if ($exists) {
            return redirect()->route('events.show', $event)
                             ->with('info', 'Você já está inscrito neste evento!');
        }

        // Check if event date has passed
        if ($event->event_date->isPast()) {
            return redirect()->route('events.show', $event)
                             ->with('error', 'Este evento já aconteceu.');
        }

        // Create registration (ticket_code is auto-generated in the model)
        Registration::create([
            'user_id'  => $user->id,
            'event_id' => $event->id,
        ]);

        return redirect()->route('events.show', $event)
                         ->with('success', 'Inscrição realizada com sucesso! Seu ingresso foi gerado.');
    }

    /**
     * Cancel registration (unregister from event).
     */
    public function destroy(Event $event)
    {
        $registration = Registration::where('user_id', auth()->id())
                                    ->where('event_id', $event->id)
                                    ->where('status', 'pending')
                                    ->first();

        if (!$registration) {
            return redirect()->route('events.show', $event)
                             ->with('error', 'Não foi possível cancelar a inscrição.');
        }

        $registration->delete();

        return redirect()->route('events.show', $event)
                         ->with('success', 'Inscrição cancelada com sucesso.');
    }
}
