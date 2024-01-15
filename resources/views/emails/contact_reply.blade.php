@component('mail::message')
# Reply to Your Contact Form Submission

{{ $replyMessage }}

Thank you,<br>
{{ config('app.name') }}
@endcomponent