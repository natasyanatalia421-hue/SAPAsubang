<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPassword extends ResetPassword
{
    /**
     * Override email template reset password dengan Bahasa Indonesia
     */
    public function toMail($notifiable): MailMessage
    {
        $resetUrl = $this->resetUrl($notifiable);

        return (new MailMessage)
            ->subject('Reset Password — SAPAsubang')
            ->greeting('Halo, ' . $notifiable->name . '!')
            ->line('Kami menerima permintaan reset password untuk akun SAPAsubang Anda.')
            ->action('Reset Password Sekarang', $resetUrl)
            ->line('Link ini akan kadaluarsa dalam **60 menit**.')
            ->line('Jika Anda tidak meminta reset password, abaikan email ini — akun Anda tetap aman.')
            ->salutation('Salam,  
Tim SAPAsubang — Kabupaten Subang');
    }
}
