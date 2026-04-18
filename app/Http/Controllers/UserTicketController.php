<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class UserTicketController extends Controller
{
    /**
     * Display a listing of the user's tickets.
     */
    public function index()
    {
        $registrations = auth()->user()->registrations()
            ->with('event')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('profile.tickets', compact('registrations'));
    }

    /**
     * Show a specific ticket with QR code.
     */
    public function show(Registration $registration)
    {
        // Ensure user owns this ticket
        if ($registration->user_id !== auth()->id()) {
            abort(403, 'Acesso não autorizado ao ingresso.');
        }

        $registration->load('event');

        return view('profile.ticket-show', compact('registration'));
    }
}
