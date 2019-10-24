@component('mail::message')

**Hello**,

You are receiving this email because we have received a password reset request for your CommonCents account.
Please click the button below to reset your password. This link is only valid for 24 hours.

@component('mail::button', ['url' => url($url)])
Reset Password
@endcomponent

If you did not request a password reset, there is no further action required by you at this time.


@component('mail::subcopy')
If you’re having trouble clicking the "Reset Password" button, copy and paste the URL below
into your web browser: [{{ url($url) }}]({{ url($url) }})
@endcomponent

@endcomponent

