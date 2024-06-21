<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SignaturePad as signature;
use Illuminate\Support\Facades\File;

class SignaturePadController extends Controller
{
    public function index()
    {
        $title= 'Signature-pad';
        $type = 'Signature-pad';
        $data = signature::orderBy('created_at','desc')->get();
        return view('template.backend.admin.signature-pad.index',compact('title','type','data'));
    }

    public function save(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'signed' => 'required|string'
        ]);

        // Set folder path
        $folderPath = storage_path('app/public/signatures/');
        
        // Create the directory if it doesn't exist
        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0755, true);
        }

        // Process the base64 image
        $image_parts = explode(";base64,", $request->signed);
        if (count($image_parts) < 2) {
            return back()->withErrors('Invalid image data');
        }

        $image_type_aux = explode("image/", $image_parts[0]);
        if (count($image_type_aux) < 2) {
            return back()->withErrors('Invalid image type');
        }

        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        if ($image_base64 === false) {
            return back()->withErrors('Failed to decode base64 image data');
        }

        $file_name = uniqid() . '.' . $image_type;
        $file_path = $folderPath . $file_name;

        if (file_put_contents($file_path, $image_base64) === false) {
            return back()->withErrors('Failed to save image');
        }

        signature::create([
            'name' => $request->name,
            'signature' => $file_name
        ]);

        return back()->with('success', 'Successfully saved the signature');
    }

    public function getdata()
    {
        $signatures = Signature::all();
        return view('index', compact('signatures'));

    }

    public function destroy($id)
    {
        $data = signature::find($id);
        $data -> delete();
        if($data){
            return redirect()->back()->with('success','Data Signature Berhasil Dihapus.');
        }else{
            return redirect()->back()->with('error','Data Signature Gagal Dihapus.');
        }
    }

}
