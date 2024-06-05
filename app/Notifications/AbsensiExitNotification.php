<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Channels\WhacenterChannel;
use App\Services\WhacenterService;
use App\Models\presensi;


class AbsensiExitNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $user;
    private $presensi;
    public function __construct($user,$presensi)
    {
        $this->user = $user;
        $this->presensi = $presensi;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [WhacenterChannel::class];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            'name' => $this->user->name,
            'email' => $this->user->email,
            'messages' => 'Registration Successful'
        ];
    }

    public function toWhacenter($notifiable)
    {
        $waService1 = (new WhacenterService())
                    ->to($this->user->no_hp)
                    ->line("Halo, " . $this->user->name)
                    ->line('Presensi Masuk: ' . $this->presensi->jam_masuk . ' WIB')
                    ->line('Presensi Keluar: ' . $this->presensi->jam_keluar . ' WIB')
                    ->line('Location: Klinik Mitra Delima')
                    ->line('Status Hari Ini : ' . $this->presensi->keterangan);

        $waService2 = (new WhacenterService())
                    // ->to('085880631562')
                    ->to('085225559504')
                    ->line("Laporan Realtime Presensi")
                    ->line('Nama: ' . $this->user->name)
                    ->line('Presensi Masuk: ' . $this->presensi->jam_masuk . ' WIB')
                    ->line('Presensi Keluar: ' . $this->presensi->jam_keluar . ' WIB')
                    ->line('Location: Klinik Mitra Delima')
                    ->line('Status Hari Ini : ' . $this->presensi->keterangan);
        return [$waService1, $waService2];
    }
}
