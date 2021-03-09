<?php

namespace App\Notifications;

use App\Objects\Competition;
use App\Typer;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserTyperConfirmNotification extends Notification
{
    use Queueable;
    protected $competition;
    protected $typer;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Competition $competition, Typer $typer)
    {
        $this->competition = $competition;
        $this->typer = $typer;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->view('mail.confirmation', ['competition' => $this->competition, 'name' => $notifiable->name, 'typer' => $this->typer])
                    ->subject('Potwierdzenie przyjęcia do Typera - '.$this->competition->getName());
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
