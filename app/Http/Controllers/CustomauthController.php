<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CustomauthController extends Controller
{

	public function index() {

		return view('customAuth.login');
	}

	public function customLogin(Request $request) {

		$request->validate([

			'email' => "required",
			'password' => "required"
		]);

		$credentials = $request->only('email', 'password');

		if(Auth::attempt($credentials)) {

			return redirect()->intended('dashboard')->withSuccess('Signed in');
		}


		return redirect("login")->withSuccess('login credentials are not valids');
	}


	public function registration()
	
	{
		return view('customAuth.registration');
	}

	public function customRegistration(Request $request)
	{
		$request->validate([

			'name' => 'required',
			'email' => 'required|email|unique:users',
			'password' => 'required|min:6'
		]);

		$data = $request->all();
		$check = $this->create($data);


		return redirect("dashboard")->withSuccess("you have signed in");
	}

	public function create(array $data)
	{
			return User::create([
				'name' => $data['name'],
				'email' => $data['email'],
				'password' => Hash::make($data['password'])
			]);
	}


	public function dashboard()
	{
		if(Auth::check()) {

			return view('customAuth.Success');
		}


		return redirect("login")->withSuccess("you are not allowed to access");
	}

	public function signOut()
	{
		Session::flush();
		Auth::logout();


		return Redirect('login');
	}

    
}
