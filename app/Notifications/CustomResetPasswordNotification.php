<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class CustomResetPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Token reset password.
     *
     * @var string
     */
    protected $token;

    /**
     * Buat instance baru dari notifikasi.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Tentukan channel notifikasi.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Bangun representasi email dari notifikasi.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $expire = config('auth.passwords.' . config('auth.defaults.passwords') . '.expire');
        $resetUrl = $this->resetUrl($notifiable);

        return (new MailMessage)
            ->subject(Lang::get('messages.password.email_subject'))
            ->markdown('email.reset-password', [
                'notifiable' => $notifiable,
                'resetUrl' => $resetUrl,
                'expire' => $expire,
            ]);
    }



    /**
     * Dapatkan URL reset password.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function resetUrl($notifiable)
    {
        return url(config('app.url') . route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));
    }
}
