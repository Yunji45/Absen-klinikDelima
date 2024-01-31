<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Beranda;
use App\Models\Tentang;
use App\Models\Layanan;
use App\Models\Divisi;
use App\Models\FaqKontak;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class LayoutController extends Controller
{
    public function index()
    {
        $title = 'Setting Content';
        $type = 'content';
        return view ('template.backend.admin.layout-content.index',compact('title','type'));
    }

    //beranda
    public function index_beranda()
    {
        $title = 'Setting Content Beranda';
        $type = 'content';
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
        $type = 'content';
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
        $type = 'content';
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
        $type = 'content';
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

    //divisi
    public function index_divisi()
    {
        $title = 'Setting Content Divisi';
        $type = 'content';
        $divisi = Divisi::all();
        return view ('template.backend.admin.layout-content.divisi.index',compact('title','type','divisi'));
    }

    public function edit_divisi($id)
    {
        $title = 'Setting Content Divisi';
        $type = 'content';
        $divisi = Divisi::find($id);
        return view ('template.backend.admin.layout-content.divisi.edit',compact('title','type','divisi'));
    }

    public function update_divisi(Request $request, $id)
    {
        try {
            $divisi = Divisi::findOrFail($id);

            // Update data divisi
            $divisi->nama_divisi = $request->nama_divisi;
            $divisi->deskripsi_singkat = $request->deskripsi_singkat;
            $divisi->deskripsi_divisi = $request->deskripsi_divisi;

            // Jika ada file gambar baru diupload
            if ($request->hasFile('foto_divisi')) {
                $imageName = time().'.'.$request->file('foto_divisi')->extension();

                // Hapus foto lama dari storage
                Storage::delete('public/content-divisi/' . $divisi->foto_divisi);

                // Upload foto baru ke storage
                Storage::putFileAs('public/content-divisi', $request->file('foto_divisi'), $imageName);

                // Update nama file foto baru di database
                $divisi->foto_divisi = $imageName;
            }

            $divisi->save();

            return redirect()->route('setting-content.divisi')->with('success', 'Data Berhasil Diupdate');
        } catch (\Exception $e) {
            \Log::error('Kesalahan mengupdate data divisi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate data divisi');
        }
    }   

    public function store_divisi(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_divisi' => 'required',
            'deskripsi_singkat' => 'required',
            'deskripsi_divisi' => 'required',
            'foto_divisi' => 'required|file|mimes:png,jpg,jpeg,svg|max:2048',
        ],[
            'nama_divisi.required' => 'nama divisi wajib di isi',
            'deskripsi_singkat.required' => 'deskripsi singkat wajib diisi',
            'deskripsi_divisi.required' => 'deskripsi singkat wajib diisi',
            'foto_divisi.required' => 'Foto wajib diisi',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        try {
            $imageName = time().'.'.$request->file('foto_divisi')->extension();
            Storage::putFileAs('public/content-divisi', $request->file('foto_divisi'), $imageName);
        
        } catch (\Exception $e) {
            \Log::error('Kesalahan unggah file: ' . $e->getMessage());
            return redirect()->back()
                ->with('errorForm', ['file' => 'Terjadi kesalahan saat mengunggah file'])
                ->withInput();
        }

        $divisi = new Divisi;
        $divisi -> nama_divisi = $request->nama_divisi;
        $divisi -> deskripsi_singkat = $request->deskripsi_singkat;
        $divisi -> deskripsi_divisi = $request->deskripsi_divisi;
        $divisi -> foto_divisi = $imageName;
        $divisi -> save();
        return redirect()->back()->with('success','Data Berhasil Disimpan');
    }

    public function destroy_divisi($id)
    {
        try {
            $divisi = Divisi::findOrFail($id);

            // Hapus foto dari storage
            $fotoPath = 'public/content-divisi/' . $divisi->foto_divisi;
            Storage::delete($fotoPath);

            // Hapus data dari database
            $divisi->delete();

            return redirect()->back()->with('success', 'Data Berhasil Dihapus');
        } catch (\Exception $e) {
            \Log::error('Kesalahan menghapus data divisi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data divisi');
        }
    }

    //faq
    public function index_faq()
    {
        $title = 'Setting Content FAQ';
        $type = 'content';
        $faq = FaqKontak::all();
        return view ('template.backend.admin.layout-content.faq.index',compact('title','type','faq'));
    }

    public function store_faq(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'pertanyaan' => 'required',
            'jawaban' => 'required',
        ],[
            'pertanyaan.required' => 'pertanyaan wajib di isi',
            'jawaban.required' => 'content wajib diisi',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        $faq = new FaqKontak;
        $faq -> pertanyaan = $request->pertanyaan;
        $faq -> jawaban = $request->jawaban;
        // return $faq;
        $faq -> save();
        return redirect()->back()->with('success','Data Berhasil Disimpan.');
    }

    public function update_faq(Request $request,$id)
    {
        $faq = FaqKontak::find($id);
        $faq -> pertanyaan = $request->pertanyaan;
        $faq -> jawaban = $request->jawaban;
        // return $faq;
        $faq -> save();
        return redirect()->route('setting-content.faq')->with('success','Data Berhasil Diupdate.');
    }

    public function edit_faq($id)
    {
        $title = 'Setting Content FAQ';
        $type = 'content';
        $faq = FaqKontak::find($id);
        return view ('template.backend.admin.layout-content.faq.edit',compact('title','type','faq'));
    }

    public function destroy_faq($id)
    {
        $faq = FaqKontak::find($id);
        $faq->delete();
        return redirect()->back()->with('success','Data Berhasil Dihapus.');
    }

}
