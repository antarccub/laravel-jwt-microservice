<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Storage;

class MailNotification extends Notification
{
    use Queueable;
    /**
     * @var string
     */
    private $header;
    private $top_line;
    private $bottom_line;
    private $action_button;
    private $action_button_link;
    /**
     * @var null
     */
    private $attach;

    /**
     * Create a new notification instance.
     *
     * @param string $header
     * @param $top_line
     * @param $bottom_line
     * @param $action_button
     * @param $action_button_link
     * @param null $attach
     */
    public function __construct($header = "Hello!", $top_line, $bottom_line, $action_button, $action_button_link, $attach = null)
    {
        //
        $this->header = $header;
        $this->top_line = $top_line;
        $this->bottom_line = $bottom_line;
        $this->action_button = $action_button;
        $this->action_button_link = $action_button_link;
        $this->attach = $attach;
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
                    ->greeting($this->header)
                    ->attach($this->attach)
                    ->line($this->top_line)
                    ->action($this->action_button, $this->action_button_link)
                    ->line($this->bottom_line);
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
