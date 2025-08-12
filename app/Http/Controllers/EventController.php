<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Resources\EventListResource;
use App\Http\Resources\EventResource;
use App\Http\Requests\PaginationRequest;

class EventController extends Controller
{
    public function index(PaginationRequest $request)
    {
        $validated = $request->validated();

        $query = Event::where('is_active', true);

        // Search
        if (!empty($validated['search'])) {
            $query->where('name', 'like', '%' . $validated['search'] . '%');
        }

        // Sorting
        $sortBy = $validated['sort_by'] ?? 'created_at';
        $sortOrder = $validated['sort_order'] ?? 'desc';
        $query->orderBy($sortBy, $sortOrder);

        // Pagination
        $perPage = $validated['per_page'] ?? 15;
        $events = $query->paginate($perPage);

        return EventListResource::collection($events);
    }

    public function show(Event $event)
    {
        return response()->json(new EventResource($event));
    }
}
