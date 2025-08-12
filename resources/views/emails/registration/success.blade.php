<x-mail::message>
# 🎉 New Registration Successful!

Hello there,

We're excited to share that your registration for **{{ $event->name }}** was successful on {{ config('app.name') }}!

## 📖 {{ $event->excerpt }}

<x-mail::button :url="url('/register-confirmation')">
Confirm Your Registration
</x-mail::button>

---

Thank you for joining us! Your participation is important, and we look forward to seeing you at the event.

Best regards,<br>
{{ config('app.name') }} Team
</x-mail::message>
