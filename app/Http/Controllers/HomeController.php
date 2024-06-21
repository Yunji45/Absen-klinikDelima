<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\presensi;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\Backend\BiznetController;
use App\Models\SignaturePad;
use App\Notifications\AbsensiNotification;
use App\Notifications\AbsensiExitNotification;


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
        $title = 'Halaman Presensi';
        $type = 'component';
        $currentTimeInWIB = Carbon::now();

        $currentTimeFormatted = $currentTimeInWIB->format('Y-m-d H:i:s');
        $spv = SignaturePad::where('name','spv')->first();
        $dir = SignaturePad::where('name','contoh')->first();
        $present = presensi::whereUserId(auth()->user()->id)->whereTanggal(date('Y-m-d'))->first();
        $notifications = Auth::user()->notifications()
                        ->whereYear('created_at', Carbon::now()->year)
                        ->whereMonth('created_at', Carbon::now()->month)
                        ->orderBy('created_at', 'desc')->take(3)->get();

        // return $spv;
        return view('template.backend.karyawan.page.presensi.presensi', compact('present', 'currentTimeFormatted','title','type','notifications','spv','dir'));    

    }

    public function skill()
    {
        $title = 'Future Plan';
        $type = 'skills';
        $notifications = Auth::user()->notifications()
        ->whereYear('created_at', Carbon::now()->year)
        ->whereMonth('created_at', Carbon::now()->month)
        ->orderBy('created_at', 'desc')->take(3)->get();
    
        return view('template.backend.karyawan.page.skill.index',compact('title','notifications','type'));
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
