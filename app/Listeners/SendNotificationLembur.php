<?php

namespace App\Listeners;

use App\Events\LemburApproved;
use App\Models\User;
use App\Notifications\LemburNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNotificationLembur implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    use InteractsWithQueue;

    public function handle(LemburApproved $event)
    {
        $user = User::find($event->lembur->user_id);  // Pastikan Anda mendapatkan pengguna yang tepat
        $user->notify(new LemburNotification($event->lembur));
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    // public function handle($event)
    // {
    //     //
    // }
}
