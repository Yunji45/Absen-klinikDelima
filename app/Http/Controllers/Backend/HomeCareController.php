<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HomeCare;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class HomeCareController extends Controller
{
    public function index()
    {
        $title = 'Data Home Care';
        $type = 'jasamedis';
        $users = User::all();
        return view ('template.backend.admin.jasamedis.care.index',compact('title','type','users'));

    }


    public function upload(Request $request)
    {
        $request->validate([
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'user_id' => 'required|exists:users,id',
            'No_HC' => 'required|string',
            'nama_pasien' => 'required|string',
            'jenis_layanan' => 'required|string',
            'jenis_jasa' => 'required|string',
            'tarif_jasa' => 'required|numeric',
        ]);
    
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $image = $request->file('foto');
            $nama = time() . "_" . $image->getClientOriginalName();
    
            // Use Laravel's Storage system to store the image
            $path = $image->storeAs('public/homecare', $nama);
    
            $care = new HomeCare;
            $care->bulan = $request->bulan;
            $care->user_id = $request->user_id;
            $care->No_HC = $request->No_HC;
            $care->foto = $path;
            $care->nama_pasien = $request->nama_pasien;
            $care->jenis_layanan = $request->jenis_layanan;
            $care->jenis_jasa = $request->jenis_jasa;
            $care->tarif_jasa = $request->tarif_jasa;
            $care->ceklis = 'Tidak';
            $care->save();
    
            session()->flash('success', 'Data Slide Berhasil ditambah!');
            return redirect('/home-care');
        } else {
            return "Upload file harus berupa gambar (jpeg, png, jpg, gif) dan tidak boleh melebihi 2048 KB.";
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'No_HC' => 'required|string',
            'nama_pasien' => 'required|string',
            'jenis_layanan' => 'required|string',
            'jenis_jasa' => 'required|string',
            'tarif_jasa' => 'required|numeric',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|nullable|max:2048',
        ], [
            'user_id.required' => 'Nama Petugas Tidak Boleh Kosong',
            'No_HC.required' => 'Nomor HC Tidak Boleh Kosong',
            'nama_pasien.required' => 'Nama Pasien Tidak Boleh Kosong',
            'jenis_layanan.required' => 'Jenis Layanan Tidak Boleh Kosong',
            'jenis_jasa.required' => 'Jenis Jasa Tidak Boleh Kosong',
            'tarif_jasa.required' => 'Tarif Jasa Tidak Boleh Kosong',
            'tarif_jasa.numeric' => 'Tarif Jasa harus berupa angka',
            // 'foto.image' => 'Berkas harus berupa gambar',
            // 'foto.mimes' => 'Format gambar tidak valid. Pilih format JPEG, PNG, JPG, atau GIF',
            // 'foto.max' => 'Ukuran gambar tidak boleh melebihi 2048 kilobita (2 MB)',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        $care = new HomeCare;
        $care->bulan = $request->bulan;
        $care->user_id = $request->user_id;
        $care->No_HC = $request->No_HC;
        $care->nama_pasien = $request->nama_pasien;
        $care->jenis_layanan = $request->jenis_layanan;
        $care->jenis_jasa = $request->jenis_jasa;
        $care->tarif_jasa = $request->tarif_jasa;
        $care->ceklis = 'Tidak';

        if ($request->file('foto')) {
            $care->foto = $request->file('foto')->store('homecare');
        } else {
            $care->foto = null;
        }
        
        $care->save();
        // return $care;
        return redirect()->route('home.care');
    }


    public function edit($id)
    {

    }

    public function update(Request $request,$id)
    {

    }

    public function destroy($id)
    {

    }
}
