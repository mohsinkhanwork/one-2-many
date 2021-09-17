<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index() {

        $role = Auth::user()->role;

        if($role == '1') {

            return view('admin.dashboard');
            // return redirect()->route('party.index');
        }
        elseif($role == '0') {

            return view('dashboard');
        }
    }
}
