<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\AbsensiNotification;
use App\Services\WhacenterService;
use App\Notifications\ChatBotNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\ChatingApp;
use Auth;
use GuzzleHttp\Client;

class WAController extends Controller
{
    public function index()
    {
        $user = User::where('no_hp','085880631562')->first();

        if ($user) {
            $user->notify(new AbsensiNotification($user));
            return response()->json(['message' => 'Notifikasi telah dikirim ke ' . $user->name]);
        } else {
            return response()->json(['message' => 'Tidak ada pengguna yang ditemukan.']);
        }
    }

    public function sendMessage(Request $request)
    {
        $user = Auth::user();
    
        $chat = ChatingApp::create([
            'user_id' => $user->id, 
            'body' => $request->input('body')
        ]);
        $user->notify(new ChatBotNotification($user, $chat));
        return response()->json(['status' => 'sipp']);
    }

}
