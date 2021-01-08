@component('mail::message')
# Password reset


@component('mail::button', ['url' => ''])
Follow this link to reset your password
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
