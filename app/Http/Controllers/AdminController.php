<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\{User, Empresa};
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function showCadastro(){
        return view('admin.cadastro');
    }

    public function storeCadastro(Request $request){
        if(Auth::user()->Empresa == 1){
            $empresa = new Empresa;
            $empresa->nome = $request->Empresa;
            $empresa->save();
        }

        $user = new User;
        $user->Nome=  $request->nome;
        $user->email=  $request->email;
        $user->password= Hash::make($request->password);
        $user->acesso= $request->acesso;
        if(Auth::user()->Empresa == 1){
        $user->Empresa= $empresa->id;
        }else{
            $user->Empresa= Auth::user()->Empresa;
        }
        $user->ativo= '1';
        $user->save();
        
        Session::flash('message', 'Usuário cadastrado com sucesso!'); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect()->back();
    }

    public function showUsuarios(){
        if(Auth::user()->Empresa == 1){
            $users = new User;
            $users= $users->get();
        }else{
            $users = new User;
            $users = $users->where('Empresa', Auth::user()->Empresa)->get(); 
        }
        
        return view('admin.usuarios', ['users' => $users]);
    }

    public function updateUsuarios($ID){
        $users = new User;
        $users = $users->where('ID', $ID)->get();
        return view('admin.usuario', ['users' => $users]);
    }

    public function updateUsuariosStore($ID, Request $request){
        $User = User::where('ID', $ID)->update($request->except('_token'));

        Session::flash('message', 'Usuário atualizado com sucesso!'); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect()->back();
    }
}
