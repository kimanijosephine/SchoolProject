<?php
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class FirstLoginResetPassword extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        // You can point this to your Vue frontend URL
        $url = url(config('app.url').'/reset-password/'.$this->token.'?email='.$notifiable->getEmailForPasswordReset());

        return (new MailMessage)
            ->subject(Lang::get('Welcome! Please Set Your Password'))
            ->line(Lang::get('Your account has been created by the administrator.'))
            ->line(Lang::get('For security reasons, you must set a new password for your first login.'))
            ->action(Lang::get('Set New Password'), $url)
            ->line(Lang::get('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.users.expire')]));
    }
}
