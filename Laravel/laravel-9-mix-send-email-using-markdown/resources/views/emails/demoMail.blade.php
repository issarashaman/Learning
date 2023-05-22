@component('mail::message')
# {{ $mailData['title'] }}
  
{{ $mailData['body'] }}
  
@component('mail::button', ['url' => $mailData['url']])
Visit Our Website
@endcomponent
  
Thanks,

{{ config('app.name') }}
@endcomponent