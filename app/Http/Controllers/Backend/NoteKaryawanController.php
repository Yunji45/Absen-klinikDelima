<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\NoteKaryawan;
use Illuminate\Support\Facades\Validator;
use Auth;

class NoteKaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Catatan Karyawan';
        $type = 'kpi';
        $data = NoteKaryawan::orderBy('created_at',direction: 'desc')->get();
        $bulan = date('m');
        $tahun = date('Y');
        // $data = NoteKaryawan::whereYear('bulan', $tahun)
        //                     ->whereMonth('bulan', $bulan)
        //                     ->orderBy('created_at', 'desc')
        //                     ->get();  
        return view ('template.backend.admin.note-karyawan.index',compact('title','type','data'));
    }

    public function SearchCatatan(Request $request)
    {
        $title = 'Catatan Karyawan';
        $type = 'kpi';
        $bulan = $request->input('bulan');
        $startDate = $bulan . '-01';
        $endDate = $bulan . '-31';
    
        $data = NoteKaryawan::whereBetween('bulan', [$startDate, $endDate])->orderBy('created_at', 'desc')->get();
        // dd(DB::getQueryLog());
        // return $data;
        return view ('template.backend.admin.note-karyawan.index',compact('title','type','bulan','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Catatan Karyawan';
        $type = 'kpi';
        $user = User::whereIn('role',['pegawai','evaluator','hrd','keuangan'])->get();
        // return $user;
        return view ('template.backend.admin.note-karyawan.create',compact('title','type','user'));
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
            'user_id' => 'required',
            'bulan' => 'required',
            'keterangan' => 'required',
            'deskripsi' => 'required',
        ],[
            'user_id.required' => 'Nama Karyawan tidak boleh kosong',
            'bulan.required' => 'Waktu pembuatan catatan tidak boleh kosong',
            'keterangan.required' => 'keterangan wajib ada',
            'deskripsi.required' => 'Deskripsi catatan harus ada',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }
        $catatan = new NoteKaryawan;
        $catatan->user_id = $request->user_id;
        $catatan->bulan = $request->bulan;
        $catatan->keterangan = $request->keterangan;
        $catatan->deskripsi = $request->deskripsi;
        $catatan->resume = $request->resume;
        $catatan->save();
        // return $catatan;
        return redirect()->route('note-karyawan.index')->with('success','Data Catatan Berhasil Disimpan.');
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
        $title = 'Tambah Catatan Karyawan';
        $type = 'kpi';
        $catatan = NoteKaryawan::find($id);
        $user = User::whereIn('role',['pegawai','evaluator','hrd','keuangan'])->get();
        // return $user;
        return view ('template.backend.admin.note-karyawan.edit',compact('title','type','user','catatan'));

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
        $catatan = NoteKaryawan::find($id);
        $catatan->user_id = $request->user_id;
        $catatan->bulan = $request->bulan;
        $catatan->keterangan = $request->keterangan;
        $catatan->deskripsi = $request->deskripsi;
        $catatan->resume = $request->resume;
        // $catatan->save();
        return $catatan;
        // return redirect()->route('note-karyawan.index')->with('success','Data Catatan Berhasil Diupdate.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
    public function delete($id)
    {
        $catatan = NoteKaryawan::find($id);
        $catatan->delete();
        return redirect()->back()->with('success','Data Catatan Berhasil Dihapus');
    }
    public function updatelagi(Request $request, $id)
    {
        $catatan = NoteKaryawan::find($id);
        $catatan->user_id = $request->user_id;
        $catatan->bulan = $request->bulan;
        $catatan->keterangan = $request->keterangan;
        $catatan->deskripsi = $request->deskripsi;
        $catatan->resume = $request->resume;
        $catatan->save();
        // return $catatan;
        return redirect()->route('note-karyawan.index')->with('success','Data Catatan Berhasil Diupdate.');
    }

}
