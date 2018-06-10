<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class newSharedArticleNotification extends Notification
{
    use Queueable;

    private $articleObj;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($articleObj)
    {
        $this->articleObj = $articleObj;
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
                    ->line('Do skupiny, ktorej si clenom bol zdielany novy clanok!')
                    ->action('Zobrazit clanok', url(action('Assignments\AssignmentContoller@show', [$this->articleObj->code])));
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
