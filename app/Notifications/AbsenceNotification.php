<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AbsenceNotification extends Notification
{
    use Queueable;
    protected $person;
    protected $email;
    /**
     * Create a new notification instance.
     */
    public function __construct($person)
    {
        $this->person = $person;
    }

    /**
     * Get the notification's delivery channels.
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
                    ->subject("Inasistencia Prolongada")
                    ->greeting("Hola, {$this->person->name}")
                    ->line("Hemos detectado que no has registrado asistencia en los últimos dos días hábiles.")
                    ->action('Justificar Inasistencia', url(route('entrance.absence.answer',$this->person->id)))
                    ->line('Por favor completa el formulario para evitar sanciones.');
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
