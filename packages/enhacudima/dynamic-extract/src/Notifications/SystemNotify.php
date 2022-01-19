<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Auth;

class SystemNotify extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $data;
    public $autor;

    public function __construct($data, $autor)
    {
        $this->data=$data;
        $this->autor=$autor;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','mail'];
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
                    ->from($this->data['from_email'],$this->data['from_name'])
                    ->replyTo($this->data['replyTo_email'], $this->data['replyTo_name'])
                    ->subject($this->data['subject'])
                    ->greeting($this->data['greeting'])
                    ->line($this->data['line_notification'])
                    ->action($this->data['action_name'], $this->data['action_url'])
                    ->line($this->data['line_farewell'])
                    ->markdown('vendor.notifications.email');
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
            'title'=>$this->data['subject'],
            'data'=>$this->data['line_notification'],
            'userNotification'=>$this->autor,
        ];
    }
}
