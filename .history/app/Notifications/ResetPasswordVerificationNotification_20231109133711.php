<?php

namespace App\Notifications;

use Ichtrojan\Otp\Otp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordVerificationNotification extends Notification
{
    use Queueable;

    public $message;
    public $subject;
    private $otp;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
        $this->message = "El siguente codigo, esta destinado para la verificacion que se encuentra en proceso, destinada a la actualizacion de su contraseña.";
        $this->subject = "Reset Password PsicoEspacio";
        $this->otp = new Otp;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $otp=$this->otp->generate($notifiable->email,6,60);
        return (new MailMessage)
                    ->subject($this->subject)
                    ->greeting('Hola '.$notifiable->full_name)
                    ->line($this->message)
                    ->line('code: '.$otp->token)
                    ->line('')
                    ->line('Utilice este codigo para validar el campo correspondiente.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
