<?php

namespace App\Notifications;

use App\Objects\Competition;
use App\Typer;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserTyperApplicationNotification extends Notification
{
    use Queueable;
    protected $user;
    protected $competition;
    protected $typer;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Competition $competition, Typer $typer)
    {
        $this->user = $user;
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
                    ->view('mail.application', ['competition' => $this->competition, 'user' => $this->user, 'typer' => $this->typer])
                    ->subject('Zgłoszenie do Typera - '.$this->competition->getName());
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
