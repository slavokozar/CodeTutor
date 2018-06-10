<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class newSharedAssignmentNotification extends Notification
{
    use Queueable;

    private $assignmentObj;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($assignmentObj)
    {
        $this->assignmentObj = $assignmentObj;
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
            ->line('Do skupiny, ktorej si clenom bolo zdielane nove zadanie!')
            ->action('Zobrazit clanok', url(action('Assignments\AssignmentController@show', [$this->assignmentObj->code])));
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
