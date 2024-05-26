<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Helper\Biznet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BiznetController extends Controller
{
    public function index()
    {
        return view('template.frontend.face');
        // return view('template.frontend.error-page.500');
    }

    public function Face(Request $request)
    {
        // Validasi input
        $request->validate([
            'base64image' => 'required|string', 
        ]);
        $image = $request->input('base64image');
        $result = Biznet::identify($image);
        // return response()->json(['result' => $result]);

        return response()->json($result);
        // if (isset($result['risetai']['status']) && $result['risetai']['status'] === "200") {
        //     // Jika status adalah "200", arahkan ke rute '/'
        //     return redirect('/home');
        // } else {
        //     // Jika status bukan "200", arahkan ke rute '/biznet'
        //     return redirect('/biznet');
        // }
    }
    public function identifyFace(Request $request)
    {
        // Validasi input
        $request->validate([
            'base64image' => 'required|string', 
        ]);

        $image = $request->input('base64image');

        $result = Biznet::identify($image);

        session(['face_verification_result' => $result]);

        if (isset($result['risetai']['return'][0]['user_name'])) {
            $identifiedUserName = $result['risetai']['return'][0]['user_name'];

            $loggedInUserName = Auth::user()->name;

            if ($identifiedUserName === $loggedInUserName) {
                return redirect('/home');
            } else {
                return redirect('/biznet');
            }
        } else {
            return redirect('/biznet');
        }
    }

}
