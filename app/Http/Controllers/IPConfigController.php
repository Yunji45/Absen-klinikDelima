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
        //hampir
        $newIP = $request->input('ip');
        config(['absensi.ip_internet' => $newIP]);
        $path = config_path('absensi.php');
        file_put_contents($path, '<?php return ' . var_export(config('absensi'), true) . ';');    
    
        return redirect('/home')->with('success', 'Alamat IP berhasil diubah.');
        // Menggabungkan konfigurasi ke dalam sebuah array
// $configArray = [
//     'ip_internet'    => env('IP_ADDRESS', '36.78.245.150'),

//     'jam_masuk'     => env('JAM_MASUK', '00:00'),
//     'jam_keluar'    => env('JAM_KELUAR', '24:00'),

//     'jam_masuk_PS'  => env('JAM_MASUK_PS', '07:00'),
//     'jam_keluar_PS'  => env('JAM_KELUAR_PS', '16:00'),

//     'jam_masuk_SM'  => env('JAM_MASUK_SM', '16:00'),
//     'jam_keluar_SM'  => env('JAM_KELUAR_SM', '07:00'),

//     'jam_masuk_PM'  => env('JAM_MASUK_PM', '07:00'),
//     'jam_keluar_PM'  => env('JAM_KELUAR_PM', '22:00'),
// ];

// // Mengonversi array konfigurasi ke dalam format teks yang sesuai
// $configText = '<?php return ' . var_export($configArray, true) . ';';

// // Menyimpan hasil konversi ke dalam file konfigurasi
// file_put_contents($path, $configText);

    }
}
