<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\AbsensiNotification;

class WAController extends Controller
{
    public function index()
    {
        // Mendapatkan pengguna. Misalnya, mengambil pengguna pertama dalam database.
        $user = User::where('no_hp','085880631562')->first();

        // Memastikan pengguna ada sebelum mengirim notifikasi.
        if ($user) {
            $user->notify(new AbsensiNotification($user));
            return response()->json(['message' => 'Notifikasi telah dikirim ke ' . $user->name]);
        } else {
            return response()->json(['message' => 'Tidak ada pengguna yang ditemukan.']);
        }
    }
}
