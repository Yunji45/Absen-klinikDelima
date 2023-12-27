<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DaftarPasien;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use App\Exports\DaftarPasienExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DaftarPasienImport;

class DaftarPasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Daftar Data Pasien';
        $type = 'jasamedis';
        $pasien = DaftarPasien::orderBy('created_at','desc')->get();
        return view ('template.backend.admin.jasamedis.pasien.index',compact('title','type','pasien'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_pasien' => 'required',
            'No_RM' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',

        ],[
            'nama_pasien.required' => 'Nama Pasien Tidak Boleh Kosong',
            'No_RM.required' => 'No RM Tidak Boleh Kosong',
            'alamat.required' => 'Alamat Pasien Tidak Boleh Kosong',
            'jenis_kelamin.required' => 'Jenis Kelamin Tidak Boleh Kosong',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        $pasien = new DaftarPasien;
        $pasien ->nama_pasien = $request->nama_pasien;
        $pasien ->jenis_kelamin = $request->jenis_kelamin;
        $pasien ->alamat = $request->alamat;
        $pasien ->bulan = $request->bulan;
        $pasien ->No_RM = $request->No_RM;
        $pasien ->save();
        return redirect()->back()->with('success','Data Paien Berhasil Disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Daftar Data Pasien';
        $type = 'jasamedis';
        $pasien = DaftarPasien::find($id);
        return view ('template.backend.admin.jasamedis.pasien.edit',compact('title','type','pasien'));

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
        $pasien = DaftarPasien::find($id);
        $pasien ->nama_pasien = $request->nama_pasien;
        $pasien ->jenis_kelamin = $request->jenis_kelamin;
        $pasien ->alamat = $request->alamat;
        $pasien ->bulan = $request->bulan;
        $pasien ->No_RM = $request->No_RM;
        $pasien ->save();
        return redirect()->back()->with('success','Data Paien Berhasil Diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pasien = DaftarPasien::find($id);
        $pasien ->delete();
        return redirect()->back()->with('success','Data Paien Berhasil Dihapus.');

    }

    public function ExportDaftarPasien()
	{
		return Excel::download(new DaftarPasienExport, 'Daftar-Pasien.xlsx');
	}

    public function ImportDaftarPasien(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        $file = $request->file('file');
        // membuat nama file unik
        $nama_file = $file->hashName();
        //temporary file
        $path = $file->storeAs('public/pasien/',$nama_file);
        // import data
        $import = Excel::import(new DaftarPasienImport(), storage_path('app/public/pasien/'.$nama_file));
        //remove from server
        Storage::delete($path);
        if($import) {
            //redirect
            return redirect()->route('daftar.pasien')->with('success', 'Data Berhasil Diimport!');
        } else {
            //redirect
            return redirect()->route('daftar.pasien')->with('error', 'Data Gagal Diimport!');
        }
    }
}
