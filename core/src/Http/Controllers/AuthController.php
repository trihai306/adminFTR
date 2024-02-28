<?php

namespace Future\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Kreait\Firebase\Factory;
use Illuminate\Http\Request;
class AuthController extends Controller
{
   public function login()
   {
       return view('future::auth.login');
   }

   public function logout()
   {
         auth()->logout();
         return redirect()->route('login');
   }

    public function forgotPassword()
    {
         return view('future::auth.forgot-password');
    }

    public function profile()
    {
        return view('future::auth.profile');
    }

}
