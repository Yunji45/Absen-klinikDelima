<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\presensi;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
    }
    public function index()
    {
        // $currentTimeInWIB = Carbon::now();

        // $currentTimeFormatted = $currentTimeInWIB->format('Y-m-d H:i:s');
        // $present = presensi::whereUserId(auth()->user()->id)->whereTanggal(date('Y-m-d'))->first();

        // return view('frontend.home', compact('present', 'currentTimeFormatted'));    

        $biznetFace = false;
        if ($biznetFace){
            $currentTimeInWIB = Carbon::now();

            $currentTimeFormatted = $currentTimeInWIB->format('Y-m-d H:i:s');
            $present = presensi::whereUserId(auth()->user()->id)->whereTanggal(date('Y-m-d'))->first();
    
            return view('frontend.home', compact('present', 'currentTimeFormatted'));    

        }else {
            return redirect()->intended('/biznet')->with('error', 'Maaf , Anda Belum Melakukan Verifikasi Wajah.');
        }

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
