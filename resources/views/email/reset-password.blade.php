@component('mail::message')
# {{ __('messages.password.email_greeting', ['name' => $notifiable->name]) }}

{{ __('messages.password.email_line1') }}

@component('mail::button', ['url' => $resetUrl])
{{ __('messages.password.email_action') }}
@endcomponent

{{ __('messages.password.email_line2', ['count' => $expire]) }}

{{ __('messages.password.email_line3') }}

{{-- Fallback manual --}}
{{ __('messages.password.email_trouble', ['action' => __('messages.password.email_action')]) }}  
{{ $resetUrl }}

@lang('messages.regards', ['name' => config('app.name')])
@endcomponent
