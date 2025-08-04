<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Inertia\Inertia;
use App\Http\Resources\EventResource;
use App\Http\Resources\CategoryResource;

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
        ]);
    }
}
