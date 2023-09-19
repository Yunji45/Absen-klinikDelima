<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\presensi;
use App\Models\rubahjadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::paginate(5);
        $users = User::all();
        // $rank = $users->firstItem();
        return view('frontend.users.index', compact('users'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('frontend.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {
            return redirect('/users')->with('error', 'Email sudah terdaftar.');
        }

        $user = $request->validate([
            'name'  => ['required', 'max:32', 'string'],
            'email' => ['required'],
            'no_hp' => ['required'],
            'nik'   => ['required'],
            'role'  => ['required'],
            'foto'  => ['image', 'mimes:jpeg,png,gif', 'max:2048']
        ]);
        $user['role'] = $request->role;
        $user['saldo_cuti'] = 12;
        $user['password'] = Hash::make('pegawaibaru');
        if ($request->file('foto')) {
            $user['foto'] = $request->file('foto')->store('foto-profil');
        } else {
            $user['foto'] = 'default.jpeg';
        }

        User::create($user);
        return redirect('/users')->with('success', 'User berhasil ditambahkan, password = pegawaibaru ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $bulanIni = date('m');
        $tahunIni = date('Y');

        $presents = presensi::whereUserId($user->id)->whereMonth('tanggal',date('m'))->whereYear('tanggal',date('Y'))->orderBy('tanggal','desc')->paginate(5);
        $masuk = presensi::whereUserId($user->id)->whereMonth('tanggal',date('m'))->whereYear('tanggal',date('Y'))->whereKeterangan('masuk')->count();
        $telat = presensi::whereUserId($user->id)->whereMonth('tanggal',date('m'))->whereYear('tanggal',date('Y'))->whereKeterangan('telat')->count();
        $cuti = presensi::whereUserId($user->id)->whereMonth('tanggal',date('m'))->whereYear('tanggal',date('Y'))->whereKeterangan('cuti')->count();
        $alpha = presensi::whereUserId($user->id)->whereMonth('tanggal',date('m'))->whereYear('tanggal',date('Y'))->whereKeterangan('alpha')->count();
        $kehadiran = presensi::whereUserId($user->id)->whereMonth('tanggal',date('m'))->whereYear('tanggal',date('Y'))->whereKeterangan('telat')->get();
        $gantijaga = rubahjadwal::whereUserId($user->id)
                                ->whereMonth('tanggal', $bulanIni)
                                ->whereYear('tanggal', $tahunIni)
                                ->where('permohonan', 'ganti_jaga')
                                ->where('status', 'approve')
                                ->count();
        $tukarjaga = rubahjadwal::whereUserId($user->id)
                                ->whereMonth('tanggal', $bulanIni)
                                ->whereYear('tanggal', $tahunIni)
                                ->where('permohonan', 'tukar_jaga')
                                ->where('status', 'approve')
                                ->count();

        $totalJamTelat = 0;
        foreach ($kehadiran as $present) {
            $totalJamTelat = $totalJamTelat + (\Carbon\Carbon::parse($present->jam_masuk)->diffInHours(\Carbon\Carbon::parse(config('absensi.jam_masuk'))));
        }
        $url = 'https://kalenderindonesia.com/api/YZ35u6a7sFWN/libur/masehi/'.date('Y/m');
        $kalender = file_get_contents($url);
        $kalender = json_decode($kalender, true);
        $libur = false;
        $holiday = null;
        if ($kalender['data'] != false) {
            if ($kalender['data']['holiday']['data']) {
                foreach ($kalender['data']['holiday']['data'] as $key => $value) {
                    if ($value['date'] == date('Y-m-d')) {
                        $holiday = $value['name'];
                        $libur = true;
                        break;
                    }
                }
            }
        }
        // dd($tukarjaga);
        return view('frontend.users.show',compact('user','presents','libur','masuk','telat','cuti','alpha','totalJamTelat','gantijaga','tukarjaga','bulanIni','tahunIni'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view ('frontend.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => ['required', 'max:32', 'string'],
            'nik' => ['required'],
            'role' => ['required'],
            'saldo_cuti' => ['required'],
            'foto' => ['image', 'mimes:jpeg,png,gif', 'max:2048']
        ]);
        
        // Menggunakan model Eloquent untuk menemukan pengguna berdasarkan ID
        $user = User::find($id); // Ganti 'User' dengan model Anda
        
        if ($user) {
            // Menghapus gambar lama jika ada file gambar yang diunggah
            if ($request->hasFile('foto')) {
                // Menghapus gambar yang lama jika bukan 'default.jpeg'
                if ($user->foto != 'default.jpeg') {
                    File::delete(storage_path('app/public/' . $user->foto));
                }
                $user->foto = $request->file('foto')->storeAs('foto-profil', $user->id . '.' . $request->file('foto')->getClientOriginalExtension(), 'public');
            }
        
            // Memperbarui data pengguna
            $user->update($data);
        
            return redirect()->back()->with('success', 'User berhasil diperbarui');
        } else {
            return redirect()->back()->with('error', 'User tidak ditemukan');
        }
        
        // return redirect()->back()->with('success', 'User berhasil diperbarui');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $name = $user->name;
        if ($user->foto != 'default.jpeg') {
            File::delete(public_path('storage'.'/'.$user->foto));
        }
        User::destroy($user->id);
        return redirect('/users')->with('success','User "'.$user->name.'" berhasil dihapus');
    }

    public function profil()
    {
        return view ('frontend.users.profil');
    }

    public function updateProfil(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'max:32'],
            'foto' => ['image', 'mimes:jpeg,png,gif', 'max:2048']
        ]);
        $user->name = $request->name;
        if ($request->file('foto')) {
            if ($user->foto != 'default.jpeg') {
                File::delete(storage_path('app/public/' . $user->foto));
            }
            $user->foto = $request->file('foto')->store('foto-profil', 'public');
        }
        $user->save();
        return redirect()->back()->with('success','Profil berhasil di perbarui');
    }

    public function gantiPassword()
    {
        return view('frontend.users.ganti-password');
    }

    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password'                => 'required|min:5',
            'password_baru'           => 'required|min:6|required_with:konfirmasi_password|same:konfirmasi_password',
            'konfirmasi_password'     => 'required|min:6'
        ]);

        if (Hash::check($request->password, $user->password)) {
            if ($request->password == $request->konfirmasi_password) {
                return redirect()->back()->with('error','Password gagal diperbarui, tidak ada yang berubah pada kata sandi');
            } else {
                $user->password = Hash::make($request->konfirmasi_password);
                $user->save();
                return redirect()->back()->with('success','Password berhasil diperbarui');
            }
        } else {
            return redirect()->back()->with('error','Password tidak cocok dengan kata sandi lama');
        }
    }

    public function search(Request $request)
    {
        $request->validate([
            'cari' => ['required']
        ]);
        $cari = $request->input('cari'); // Mengambil nilai pencarian dari inputan
        $users = User::where('name','like','%'.$request->cari.'%')
                    ->orWhere('nik','like','%'.$request->cari.'%')
                    ->paginate(6);
        $rank = $users->firstItem();

        // return view('users.index', compact('users','rank'));
        return redirect()->back();
    }

    public function password(Request $request, User $user)
    {
        $user->password = Hash::make('pegawaibaru');
        $user->save();

        return redirect()->back()->with('success','Password berhasil direset, Password = pegawaibaru');
    }

}
