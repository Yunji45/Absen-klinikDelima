<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HomeCare;
use Illuminate\Support\Facades\Validator;

class HomeCareController extends Controller
{
    public function index()
    {
        $title = 'Data Home Care';
        $type = 'jasamedis';
        $users = User::all();
        return view ('template.backend.admin.jasamedis.care.index',compact('title','type','users'));

    }

    public function store(Request $request)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request,$id)
    {

    }

    public function destroy($id)
    {

    }
}
