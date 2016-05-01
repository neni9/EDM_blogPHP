<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Category;
use App\Http\Requests;
use Illuminate\Http\Request;

class LoginController extends Controller
{
	/**
	 * login method for all users
	 * 
	 * @param  Request $request 
	 * @return response        
	 */
    public function login(Request $request){

    	if($request->isMethod('post')){

    		$this->validate($request, [
	            'email'    => 'required|email',
	            'password' => 'required',
	            'remember' => 'in:remember'
	        ]);

    		$remember = !empty($request->input('remember')) ? true : false;

	        $credentials = $request->only('email','password');

	        if(Auth::attempt($credentials,$remember)){

	        	if(Auth::user()->role == 'administrator')
	        		return redirect('post')->with(['message','Bienvenue']);
	        	else
	        		return redirect('/')->with(['message','Bienvenue ']);
	        }
	        else{
	        	return back()->withInput($request->only('email','remember'))
	        				 ->with(['message' => "Erreur lors de l'authentification."]);
	        }

    	}else{
    		
			$title  = "Formulaire d'authentification";

    		return view('auth.login',compact('title'));
    	}

    }

    /**
     * logout method for connected user
     * 
     * @return redirect
     */
    public function logout(){

    	Auth::logout();
    
    	return redirect('/')->with(['message' => "Déconnexion réussie."]);
    }
}
