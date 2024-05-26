<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function get_data_user()
    {
        $user= User::all();
        $data = User::select('id', 'name')->get();
        return response()->json($data);
    }
}
