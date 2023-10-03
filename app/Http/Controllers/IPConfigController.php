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
        // $newIP = $request->input('ip');
        // config(['absensi.ip_internet' => $newIP]);
        // $path = config_path('absensi.php');
        // file_put_contents($path, '<?php return ' . var_export(config('absensi'), true) . ';');    
        $newIP = $request->input('ip');

        // Menggunakan env() untuk mengambil nilai IP_ADDRESS dari variabel lingkungan
        $currentIP = env('IP_ADDRESS');
    
        // Mengganti nilai IP_ADDRESS dengan nilai baru jika nilai baru tersedia
        if (!empty($newIP)) {
            $currentIP = $newIP;
    
            // Menyimpan nilai IP_ADDRESS dalam variabel lingkungan
            // Ini akan memperbarui nilai IP_ADDRESS yang digunakan dalam aplikasi
            // Catatan: Nilai ini akan efektif hanya dalam konteks permintaan saat ini,
            // dan akan kembali ke nilai aslinya setelah permintaan selesai.
            config(['app.ip_address' => $currentIP]);
        }
    
        return redirect('/home')->with('success', 'Alamat IP berhasil diubah.');
    }
}
