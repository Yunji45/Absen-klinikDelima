<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriJasaMedis;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use App\Exports\KategoriJasaExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\KategoriJasaImport;


class KategoriJasaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Kategori Jasa Layanan';
        $type = 'jasamedis';
        $kategori = KategoriJasaMedis::all();
        return view ('template.backend.admin.jasamedis.kategori.index',compact('title','type','kategori'));
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
            'jenis_layanan' => 'required',
            'jenis_jasa' => 'required',
            'tarif_jasa' => 'required',

        ],[
            'jenis_layanan.required' => 'Jenis Layanan Tidak Boleh Kosong',
            'jenis_jasa.required' => 'Jenis Jasa Tidak Boleh Kosong',
            'tarif_jasa.required' => 'Tarif Jasa Tidak Boleh Kosong',
        ]);
        $kategori = new KategoriJasaMedis;
        $kategori -> jenis_layanan = $request->jenis_layanan;
        $kategori -> jenis_jasa = $request->jenis_jasa;
        $kategori -> tarif_jasa = $request->tarif_jasa;
        $kategori -> save();
        if($kategori){
            return redirect()->back()->with('success','Data Layanan Berhasil Disimpan.');
        }else{
            return redirect()->back()->with('error','Data Layanan Gagal Disimpan.');
        }
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
        $title = 'Edit Kategori Jasa Layanan';
        $type = 'jasamedis';
        $kategori = KategoriJasaMedis::find($id);
        return view ('template.backend.admin.jasamedis.kategori.edit',compact('title','type','kategori'));
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
        $kategori = KategoriJasaMedis::find($id);
        $kategori -> jenis_layanan = $request->jenis_layanan;
        $kategori -> jenis_jasa = $request->jenis_jasa;
        $kategori -> tarif_jasa = $request->tarif_jasa;
        $kategori -> save();
        if($kategori){
            return redirect()->back()->with('success','Data Layanan Berhasil Diupdate.');
        }else{
            return redirect()->back()->with('error','Data Layanan Gagal Diupdate.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = KategoriJasaMedis::find($id);
        $kategori -> delete();
        return redirect()->back()->with('success','Data Layanan Berhasil Dihapus.');
    }

    public function exportKategori()
	{
		return Excel::download(new KategoriJasaExport, 'kategori.xlsx');
	}

    public function importKategori(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        $file = $request->file('file');
        // membuat nama file unik
        $nama_file = $file->hashName();
        //temporary file
        $path = $file->storeAs('public/kategori/',$nama_file);
        // import data
        $import = Excel::import(new KategoriJasaImport(), storage_path('app/public/kategori/'.$nama_file));
        //remove from server
        Storage::delete($path);
        if($import) {
            //redirect
            return redirect()->route('kategori.jasa')->with('success', 'Data Berhasil Diimport!');
        } else {
            //redirect
            return redirect()->route('kategori.jasa')->with('error', 'Data Gagal Diimport!');
        }
    }
}
