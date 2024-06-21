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
    
        return redirect('/kehadiran')->with('success', 'Alamat IP berhasil diubah.');

    }
}
