<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Resto\User;

class AuthController extends Controller
{
    private $user;
    public function __construct(){
        $this->user = new User;
    }
    public function index(){
        if(session()->has('authenticated')){
            return redirect()->route('dashboard.index');
        }
        return view('login.index');
    }
    public function attempt(Request $request){
        //Validate Auth
        $validate = $this->user->validateAuth($request->all());
        if($validate){
            return redirect()->route('login.index')->with('warning', 'Nama Pengguna atau Kata Sandi tidak boleh dikosongkan');
        }

        //Failed Auth
        $failed = $this->user->failedAuth($request->all());
        if($failed){
            return redirect()->route('login.index')->with('warning', 'Nama Pengguna atau Kata Sandi tidak ditemukan !');
        }

        return redirect()->route('dashboard.index');
    }
    public function logout(){
        session()->forget('authenticated');
        session()->flush();
        return redirect('/');
    }
}
