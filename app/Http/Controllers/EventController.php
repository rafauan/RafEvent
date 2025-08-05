<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Inertia\Inertia;
use App\Http\Resources\EventResource;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use App\Models\Registration;
use App\Http\Requests\RegistrationRequest;

class EventController extends Controller
{
    public function index()
    {
        return Inertia::render('Welcome', [
            'events' => EventResource::collection(Event::where('is_active', true)->get()),
            'categories' => CategoryResource::collection(Category::all()),
        ]);
    }

    public function show(Event $event)
    {
        return Inertia::render('Events/Show', [
            'event' => new EventResource($event),
            'flash' => [
                'success' => session('success'),
                'error' => session('error'),
                'message' => session('message'),
            ],
        ]);
    }

    public function register(RegistrationRequest $request)
    {
        $data = $request->validated();

        $event = Event::findOrFail($data['event_id']);

        if ($event->capacity <= 0) {
            return back()->withErrors([
                'capacity' => 'This event is fully booked.'
            ]);
        }

        $existingRegistration = Registration::where('event_id', $data['event_id'])
            ->where('email', $data['email'])
            ->first();

        if ($existingRegistration) {
            return back()->withErrors([
                'email' => 'You are already registered for this event.'
            ]);
        }

        Registration::create($data);

        return redirect()->route('events.show', $event->id)
            ->with('success', 'Successfully signed up!');
    }
}
