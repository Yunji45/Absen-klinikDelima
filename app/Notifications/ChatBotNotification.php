<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Channels\WhacenterChannel;
use App\Services\WhacenterService;


class ChatBotNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $user;
    private $chat;
    public function __construct($user,$chat)
    {
        $this->user = $user;
        $this->chat = $chat;
    }

    public function via($notifiable)
    {
        return [WhacenterChannel::class];
    }

    public function toArray($notifiable)
    {
        return [
            'name' => $this->user->name,
            'email' => $this->user->email,
            'messages' => 'Registration Successful'
        ];
    }

    public function toWhacenter($notifiable)
    {
        $waService1 = (new WhacenterService())
                    ->to('085880631562')
                    ->line('========= Notifikasi Chat =========')
                    ->line('')
                    ->line('From: ' . $this->user->name .' / '. $this->user->id)
                    ->line('Message: ' . $this->chat->body);
        return [$waService1];
    }
}
