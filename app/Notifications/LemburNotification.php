<?php

namespace App\Notifications;

use App\Models\rubahjadwal;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LemburNotification extends Notification
{
    use Queueable;

    protected $lembur;

    public function __construct(rubahjadwal $lembur)
    {
        $this->lembur = $lembur;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Request Lembur Anda Berhasil.',
            'lembur_id' => $this->lembur->id,
            'tanggal' => $this->lembur->tanggal,
            'alasan' => $this->lembur->alasan,
        ];
    }
}