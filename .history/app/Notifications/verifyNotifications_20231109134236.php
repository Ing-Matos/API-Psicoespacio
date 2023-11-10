<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class verifyNotifications extends Notification
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
        $this->message = "Gracias por registrarte con nosotros, para completar tu secion por favor da click en este boton";
        $this->subject = "Verified email PsicoEspacio";
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

        return (new MailMessage)
                    ->subject($this->subject)
                    ->greeting('Hola '.$notifiable->full_name)
                    ->line($this->message)
                    ->line('verifica tu correo',$url="http://127.0.0.1:5501/Front-End%20PsicoEspacio/forget_password/recover.html")
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
