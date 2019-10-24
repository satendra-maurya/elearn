<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification implements ShouldQueue {

    use Queueable;

    /**
     * The password reset token.
     * @var string
     */
    public $token;

    /**
     * The email.
     * @var string
     */
    public $email;

    /**
     * Create a notification instance.
     * @param  string  $token
     * @param  string  $email
     * @return void
     */
    public function __construct($token, $email) {
        $this->token = $token;
        $this->email = $email;
    }

    /**
     * Get the notification's delivery channels.
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable) {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable) {
        $url = url('/password/reset') . '/' . $this->token . '/' . $this->email;
        return (new MailMessage)
                        ->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))
                        ->subject(trans('mail.forgot_email_subject'))
                        ->markdown('emails.password.reset', ['url' => $url]);
    }

}
