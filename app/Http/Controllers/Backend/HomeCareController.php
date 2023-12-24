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
        $care = HomeCare::all();
        return view ('template.backend.admin.jasamedis.care.index',compact('title','type','users','care'));

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
            'foto' => 'required|file|mimes:png,jpg,jpeg,svg|max:2048'
        ], [
            'user_id.required' => 'Nama Petugas Tidak Boleh Kosong',
            'No_HC.required' => 'Nomor HC Tidak Boleh Kosong',
            'nama_pasien.required' => 'Nama Pasien Tidak Boleh Kosong',
            'jenis_layanan.required' => 'Jenis Layanan Tidak Boleh Kosong',
            'jenis_jasa.required' => 'Jenis Jasa Tidak Boleh Kosong',
            'tarif_jasa.required' => 'Tarif Jasa Tidak Boleh Kosong',
            'tarif_jasa.numeric' => 'Tarif Jasa harus berupa angka',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        try {
            $imageName = time().'.'.$request->file('foto')->extension();
            Storage::putFileAs('public/homecare', $request->file('foto'), $imageName);
        } catch (\Exception $e) {
            \Log::error('Kesalahan unggah file: ' . $e->getMessage());
            return redirect()->back()
                ->with('errorForm', ['foto' => 'Terjadi kesalahan saat mengunggah file'])
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
        $care->foto = $imageName;

        $care->save();
        // return $care;
        return redirect()->route('home.care')->with('success','Terimakasih !! Data Berhasil Disimpan.');
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
