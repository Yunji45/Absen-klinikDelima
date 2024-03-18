<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\THR_lebaran;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class THRController extends Controller
{
    public function index()
    {
        $title = 'THR Idul Fitri';
        $type = 'gajian';
        $data = THR_lebaran::all();
        return view('template.backend.admin.THR.index',compact('title','type','data'));
    }

    public function GetDataMultiple(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'bulan' => 'required',
        ],[
            'bulan.required' => 'Bulan Tidak Boleh Kosong',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }    
        
    }
}
