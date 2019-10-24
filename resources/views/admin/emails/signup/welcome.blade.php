@component('mail::message') 

# Welcome to the CommonCents App

Thank you for joining us!
@if(!empty($url))
Just click on the link below to verify your email address. 


@component('mail::button', ['url' => url($url)])
Verify Your Email
@endcomponent


@component('mail::subcopy')
If you’re having trouble clicking the "Verify Your Email" button, copy and paste the URL below
into your web browser: [{{ url($url) }}]({{ url($url) }})
@endcomponent

@endif

@endcomponent



