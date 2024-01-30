<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Beranda;
use App\Models\Tentang;
use App\Models\Layanan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class LayoutController extends Controller
{
    public function index()
    {
        $title = 'Setting Content';
        $type = 'layout';
        return view ('template.backend.admin.layout-content.index',compact('title','type'));
    }

    //beranda
    public function index_beranda()
    {
        $title = 'Setting Content Beranda';
        $type = 'layout';
        return view ('template.backend.admin.layout-content.beranda.index',compact('title','type'));
    }

    public function store_beranda(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'foto_1' => 'required|file|mimes:png,jpg,jpeg,svg|max:2048',
            'foto_2' => 'required|file|mimes:png,jpg,jpeg,svg|max:2048',
            'foto_3' => 'required|file|mimes:png,jpg,jpeg,svg|max:2048',
        ],[
            'foto_1.required' => 'Foto Wajib Di isi.',
            'foto_2.required' => 'Foto Wajib Di isi.',
            'foto_3.required' => 'Foto Wajib Di isi.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        try {
            $imageName = time().'.'.$request->file('foto_1')->extension();
            Storage::putFileAs('public/content-beranda/foto-1', $request->file('foto_1'), $imageName);
        
            $CvName = time().'.'.$request->file('foto_2')->extension();
            Storage::putFileAs('public/content-beranda/foto-2', $request->file('foto_2'), $CvName);
        
            // Logika penyimpanan foto_3 jika diperlukan
            if ($request->hasFile('foto_3')) {
                $filePendukungName = time().'.'.$request->file('foto_3')->extension();
                Storage::putFileAs('public/content-beranda/foto-3', $request->file('foto_3'), $filePendukungName);
            }
        } catch (\Exception $e) {
            \Log::error('Kesalahan unggah file: ' . $e->getMessage());
            return redirect()->back()
                ->with('errorForm', ['file' => 'Terjadi kesalahan saat mengunggah file'])
                ->withInput();
        }
        $beranda = new Beranda;
        $beranda ->sub_judul_1 = $request->sub_judul_1;
        $beranda ->sub_judul_2 = $request->sub_judul_2;
        $beranda ->sub_judul_3 = $request->sub_judul_3;
        $beranda ->content_1 = $request->content_1;
        $beranda ->content_2 = $request->content_2;
        $beranda ->content_3 = $request->content_3;
        $beranda ->foto_1 = $imageName;
        $beranda ->foto_2 = $CvName;
        $beranda ->foto_3 = $filePendukungName;
        // return $beranda;
        $beranda ->save();
        if($beranda){
            return redirect()->back()->with('success','Data Content Berhasil Disimpan.');
        }else{
            return redirect()->back()->with('error','Data Content Gagal Disimpan.');
        }
    }

    public function update_beranda(Request $request,$id)
    {
        $validator = Validator::make($request->all(),[
            'foto_1' => 'required|file|mimes:png,jpg,jpeg,svg|max:2048',
            'foto_2' => 'required|file|mimes:png,jpg,jpeg,svg|max:2048',
            'foto_3' => 'required|file|mimes:png,jpg,jpeg,svg|max:2048',
        ],[
            'foto_1.required' => 'Foto Wajib Di isi.',
            'foto_2.required' => 'Foto Wajib Di isi.',
            'foto_3.required' => 'Foto Wajib Di isi.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        try {
            $imageName = time().'.'.$request->file('foto_1')->extension();
            Storage::putFileAs('public/content-beranda/foto-1', $request->file('foto_1'), $imageName);
        
            $CvName = time().'.'.$request->file('foto_2')->extension();
            Storage::putFileAs('public/content-beranda/foto-2', $request->file('foto_2'), $CvName);
        
            // Logika penyimpanan foto_3 jika diperlukan
            if ($request->hasFile('foto_3')) {
                $filePendukungName = time().'.'.$request->file('foto_3')->extension();
                Storage::putFileAs('public/content-beranda/foto-3', $request->file('foto_3'), $filePendukungName);
            }
        } catch (\Exception $e) {
            \Log::error('Kesalahan unggah file: ' . $e->getMessage());
            return redirect()->back()
                ->with('errorForm', ['file' => 'Terjadi kesalahan saat mengunggah file'])
                ->withInput();
        }
        $beranda = Beranda::find(3);
        $beranda ->sub_judul_1 = $request->sub_judul_1;
        $beranda ->sub_judul_2 = $request->sub_judul_2;
        $beranda ->sub_judul_3 = $request->sub_judul_3;
        $beranda ->content_1 = $request->content_1;
        $beranda ->content_2 = $request->content_2;
        $beranda ->content_3 = $request->content_3;
        $beranda ->foto_1 = $imageName;
        $beranda ->foto_2 = $CvName;
        $beranda ->foto_3 = $filePendukungName;
        // return $beranda;
        $beranda ->save();
        if($beranda){
            return redirect()->back()->with('success','Data Content Berhasil Disimpan.');
        }else{
            return redirect()->back()->with('error','Data Content Gagal Disimpan.');
        }
    }

    //tentang
    public function index_tentang()
    {
        $title = 'Setting Content Profil';
        $type = 'layout';
        return view ('template.backend.admin.layout-content.tentang.index',compact('title','type'));
    }

    public function store_tentang(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'foto_1' => 'required|file|mimes:png,jpg,jpeg,svg|max:2048',
        ],[
            'foto_1.required' => 'Foto Wajib Di isi.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }
        try {
            $imageName = time().'.'.$request->file('foto_1')->extension();
            Storage::putFileAs('public/content-tentang', $request->file('foto_1'), $imageName);
        
        } catch (\Exception $e) {
            \Log::error('Kesalahan unggah file: ' . $e->getMessage());
            return redirect()->back()
                ->with('errorForm', ['file' => 'Terjadi kesalahan saat mengunggah file'])
                ->withInput();
        }
        $tentang = new Tentang;
        $tentang ->sub_judul_1 = $request->sub_judul_1;
        $tentang ->sub_judul_2 = $request->sub_judul_2;
        $tentang ->content_1 = $request->content_1;
        $tentang ->content_2 = $request->content_2;
        $tentang ->foto_1 = $imageName;
        $tentang ->save();
        // return $tentang;
        return redirect()->back()->with('success','Data Profil Berhasil Disimpan.');
        
    }

    //layanan
    public function index_layanan()
    {
        $title = 'Setting Content Layanan';
        $type = 'layout';
        $layanan = Layanan::all();
        return view ('template.backend.admin.layout-content.layanan.index',compact('title','type','layanan'));
    }

    public function store_layanan(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'judul_layanan' => 'required',
            'content_layanan' => 'required',
        ],[
            'judul_layanan.required' => 'judul wajib di isi',
            'content_layanan.required' => 'content wajib diisi',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }
        $layanan = new Layanan;
        $layanan ->judul_layanan = $request->judul_layanan;
        $layanan ->content_layanan = $request->content_layanan;
        $layanan->save();
        // return $layanan;
        return redirect()->back()->with('success','Data Berhasil Disimpan');
    }

    public function edit_layanan($id)
    {
        $title = 'Setting Content Layanan';
        $type = 'layout';
        $layanan = Layanan::find($id);
        return view ('template.backend.admin.layout-content.layanan.edit',compact('title','type','layanan'));

    }

    public function update_layanan(Request $request,$id)
    {
        $layanan = Layanan::find($id);
        $layanan ->judul_layanan = $request->judul_layanan;
        $layanan ->content_layanan = $request->content_layanan;
        $layanan->save();
        return redirect()->route('setting-content.layanan')->with('success','Data Berhasil Diupdate');
    }

    public function destroy_layanan($id)
    {
        $layanan = Layanan::find($id);
        $layanan->delete();
        return redirect()->back()->with('success','Data Berhasil Dihapus');
    }
}
