<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    //
	public function __construct()
	{
		$this->middleware('auth');
	}
		
	public function profil (Request $request)
	{
		if($request->isMethod('post'))
		{
			$this->validate($request,['password' => 'required|min:6']);
			
			$user = auth()->user();
			$user->password = bcrypt($request->all()['password']);
			$user->save();
		}
		return view('auth.profil');
	}
}
	
	
	
