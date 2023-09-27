<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class IPConfigController extends Controller
{
    public function index()
    {
        return view ('backend.admin.ip.index');
    }
    public function update(Request $request)
    {
        $newIP = $request->input('ip');
        config(['absensi.ip_internet' => $newIP]);

        return redirect()->back()->with('success', 'Alamat IP berhasil diubah.');
    }
}
