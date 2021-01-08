@component('mail::message')
# Password reset

@component('mail::button', ['url' => route('resetpassword.token', $token)])
Follow this link to reset your password
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
