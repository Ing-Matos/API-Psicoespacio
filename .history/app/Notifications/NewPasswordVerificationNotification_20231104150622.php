<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewPasswordVerificationNotification extends Notification
{
    use Queueable;
    
    
    public $message;
    public $subject;
    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
        $this->message = "Su nueva contraseña esta lista, por favor siga disfrutando de nuestros servicios";
        $this->subject = "New Password Verification PsicoEspacio";
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
            ->greeting('En hora buena '.$notifiable->full_name)
            ->line($this->message);
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
