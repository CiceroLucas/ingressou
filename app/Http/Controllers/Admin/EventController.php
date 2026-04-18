<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class EventController extends Controller
{
    /**
     * Display a listing of events for the admin.
     */
    public function index()
    {
        $events = Event::latest('event_date')->paginate(10);

        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new event.
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created event in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'event_date'  => 'required|date|after:now',
            'location'    => 'required|string|max:255',
            'banner'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        if ($request->hasFile('banner')) {
            $imageName = time() . '-' . uniqid() . '.' . $request->file('banner')->getClientOriginalExtension();
            $request->file('banner')->move(public_path('banner'), $imageName);
            $validated['banner_path'] = 'banner/' . $imageName;
        }

        unset($validated['banner']);

        Event::create($validated);

        return redirect()->route('admin.events.index')
                         ->with('success', 'Evento criado com sucesso!');
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified event in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'event_date'  => 'required|date',
            'location'    => 'required|string|max:255',
            'banner'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        if ($request->hasFile('banner')) {
            // Delete old banner if exists
            if ($event->banner_path && File::exists(public_path($event->banner_path))) {
                File::delete(public_path($event->banner_path));
            }
            $imageName = time() . '-' . uniqid() . '.' . $request->file('banner')->getClientOriginalExtension();
            $request->file('banner')->move(public_path('banner'), $imageName);
            $validated['banner_path'] = 'banner/' . $imageName;
        }

        unset($validated['banner']);

        $event->update($validated);

        return redirect()->route('admin.events.index')
                         ->with('success', 'Evento atualizado com sucesso!');
    }

    /**
     * Remove the specified event from storage.
     */
    public function destroy(Event $event)
    {
        // Delete banner file if exists
        if ($event->banner_path && File::exists(public_path($event->banner_path))) {
            File::delete(public_path($event->banner_path));
        }

        $event->delete();

        return redirect()->route('admin.events.index')
                         ->with('success', 'Evento excluído com sucesso!');
    }

    /**
     * Show the list of registrations for a specific event.
     */
    public function registrations(Event $event)
    {
        $registrations = $event->registrations()->with('user')->paginate(20);

        return view('admin.events.registrations', compact('event', 'registrations'));
    }

    /**
     * Show the QR code scanner view.
     */
    public function scanner()
    {
        return view('admin.scanner');
    }

    /**
     * Validate the ticket parsed from QR Code.
     */
    public function validateTicket($ticket_code)
    {
        $registration = \App\Models\Registration::with('user', 'event')->where('ticket_code', $ticket_code)->first();

        // 1. Doesn't exist
        if (!$registration) {
            return redirect()->route('admin.scanner')
                             ->with('error', 'Ingresso Inválido. Nenhum registro encontrado para este código.');
        }

        // 2. Already used
        if ($registration->status === 'used') {
            return redirect()->route('admin.scanner')
                             ->with('error', "Atenção: Ingresso já utilizado por {$registration->user->name} para o evento {$registration->event->title}.");
        }

        // 3. Pending
        $registration->markAsUsed();

        return redirect()->route('admin.scanner')
                         ->with('success', "Entrada Liberada! Participante: {$registration->user->name} - Evento: {$registration->event->title}");
    }
}
