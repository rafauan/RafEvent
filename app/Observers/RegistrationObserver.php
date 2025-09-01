<?php

namespace App\Observers;

use App\Models\Registration;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationSuccessMail;

class RegistrationObserver
{
    public function creating(Registration $registration)
    {
        // Generate a unique confirmation token
        $registration->confirmation_token = bin2hex(random_bytes(16));
    }

    public function created(Registration $registration)
    {
        $email = $registration->email;
        // Lock the event for update if two or more registrations are made simultaneously
        $event = $registration->event()->lockForUpdate()->first();

        // Decrement the event capacity
        if ($event->capacity > 0) {
            $event->decrement('capacity');
        }

        // Notify the user about successful registration
        Mail::to($email)->queue(new RegistrationSuccessMail($event, $registration));
    }
}
