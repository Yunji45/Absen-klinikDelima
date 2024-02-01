<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KritikSaran;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class KritikSaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Kritik dan Saran';
        $type = 'content';
        $kritik = KritikSaran::all();
        return view ('template.backend.admin.kritik-saran.index',compact('title','type','kritik'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'nama' => 'required',
            'no_tlp' => 'required',
            'kategori' => 'required',
            'deskripsi' => 'required',
        ],[
            'nama.required' => 'nama tidak boleh kosong',
            'no_tlp.required' => 'no telp tidak boleh kosong',
            'kategori.required' => 'kategori tidak boleh kosong',
            'deskripsi.required' => 'deskripsi tidak boleh kosong',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        $kritik = new KritikSaran;
        $kritik ->nama = $request->nama;
        $kritik ->no_tlp = $request->no_tlp;
        $kritik ->kategori = $request->kategori;
        $kritik ->deskripsi = $request->deskripsi;
        $kritik ->save();
        return redirect()->route('frontend')->with('success','Data Kritik Berhasil Terkirim');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
