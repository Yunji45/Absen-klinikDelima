<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\presensi;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\Backend\BiznetController;



class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __constract()
    {
        $this->middleware('auth');
        // $this->middleware('verified_face');
    }
    public function index(Request $request)
    {
        $currentTimeInWIB = Carbon::now();

        $currentTimeFormatted = $currentTimeInWIB->format('Y-m-d H:i:s');
        $present = presensi::whereUserId(auth()->user()->id)->whereTanggal(date('Y-m-d'))->first();

        return view('frontend.home', compact('present', 'currentTimeFormatted'));    

        // $biznetController = new BiznetController();

        // // Memanggil metode identifyFace pada BiznetController
        // $result = $biznetController->identifyFace(request());

        // // Memeriksa apakah verifikasi wajah berhasil
        // if ($result instanceof \Illuminate\Http\RedirectResponse) {
        //     return $result;
        // } else {
        //     // Jika bukan objek redirect, lanjutkan dengan pemeriksaan status
        //     if (isset($result['risetai']['status']) && $result['risetai']['status'] === "200") {
        //         // Jika verifikasi berhasil, lanjutkan dengan tampilan home
        //         $currentTimeInWIB = Carbon::now();
        //         $currentTimeFormatted = $currentTimeInWIB->format('Y-m-d H:i:s');
        //         $present = Presensi::whereUserId(auth()->user()->id)->whereTanggal(date('Y-m-d'))->first();
        
        //         return view('frontend.home', compact('present', 'currentTimeFormatted'));
        //     } else {
        //         // Jika verifikasi gagal, redirect ke /biznet
        //         return redirect('/biznet')->with('error', 'Anda harus melewati verifikasi wajah di /biznet terlebih dahulu.');
        //     }
        // }
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
        //
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
