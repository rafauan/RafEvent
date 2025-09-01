<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Registration;
use App\Http\Requests\RegistrationRequest;

class RegistrationController extends Controller
{
    public function register(RegistrationRequest $request)
    {
        $data = $request->validated();
        $event = Event::findOrFail($data['event_id']);

        if ($event->capacity <= 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'This event is fully booked.',
                'errors' => [
                    'event_id' => 'This event is fully booked.',
                ],
            ], 409);
        }

        $existingRegistration = Registration::where('event_id', $data['event_id'])
            ->where('email', $data['email'])
            ->first();

        if ($existingRegistration) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are already registered for this event.',
                'errors' => [
                    'email' => 'You are already registered for this event.',
                ],
            ], 409);
        }

        Registration::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Registration successful.',
        ], 201);
    }

    public function confirm(Request $request)
    {
        $data = $request->validate([
            'token' => 'required|string',
        ]);

        $registration = Registration::where('confirmation_token', $data['token'])->first();

        if (!$registration) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid or expired confirmation token.',
            ], 404);
        }

        if ($registration->status === 'confirmed') {
            return response()->json([
                'status' => 'error',
                'message' => 'This registration has already been confirmed.',
            ], 409);
        }

        // Mark the registration as confirmed
        $registration->update(['status' => 'confirmed']);

        return response()->json([
            'status' => 'success',
            'message' => 'Registration confirmed successfully.',
        ]);
    }
}
