<?php

namespace App\Notifications;

use App\Objects\Competition;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BanUserFromTyperNotification extends Notification
{
    use Queueable;
    protected $competition;
    protected $reason;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Competition $competition, $reason)
    {
        $this->competition = $competition;
        $this->reason = $reason;
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
                    ->view('mail.ban', [
                        'competition' => $this->competition, 
                        'name' => $notifiable->name,
                        'reason' => $this->reason,
                    ])
                    ->subject('Ban do Typera - '.$this->competition->getName());
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
