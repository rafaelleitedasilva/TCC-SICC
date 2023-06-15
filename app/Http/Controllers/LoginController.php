<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{

    public function show_cadastro(){
        return view('login.cadastro');
    }

    public function store(Request $request){
        $user = new User;
        $user->Nome=  $request->nome;
        $user->email=  $request->email;
        $user->password= Hash::make($request->password);
        $user->acesso= 'admin';
        $user->ativo= '1';
        $user->save();
        return redirect('login');
    }

    public function Redefinir(){
        return view('login.esqueceu');
    }

    public function empresa(Request $request){
        $user = new User;
        $user = $user->where('email', $request->email)->get();

        $empresa = [];
        foreach($user as $u){
            array_push($empresa, [$u->Empresa, $u->EmpresaID->nome]);
        }

        return $empresa;
    }
    

    public function auth(Request $request){
        $credendials = $request->only(array('email', 'password', 'Empresa'));
    
        if(!Auth::attempt($credendials)){
            return redirect()->back()->withErrors('Email ou senha incorreta! Tente novamente, se o erro persistir contate o administrador da sua empresa!');
        }

        return redirect()->route('abertura');
    }

    public function login(){
        return view('login.index');
    }

    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect('login');
    }
}
