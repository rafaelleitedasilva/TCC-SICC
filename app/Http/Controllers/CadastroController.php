<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\{
    Setor,
    Item,
    Objeto,
    User
};

class CadastroController extends Controller
{
    public function showSetor(){
        $user = new User;
        $user = $user->where('Empresa', Auth::user()->Empresa)->where('ativo', 1)->get();
        return view('cadastro.cadastroSetor', ['user' => $user]);
    }

    public function storeSetor(Request $request){
        $setores = new Setor;
        $setores->Nome=  $request->Nome;
        $setores->GestorID=  $request->GestorID;
        $setores->Empresa= $request->Empresa;
        $setores->ativo = 1;
        $setores->save();
        Session::flash('title', 'Cadastro Realizado!');
        Session::flash('message', 'Setor cadastrado com sucesso!'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect()->back();
    }

    public function showItem(){
        return view('cadastro.cadastroItem');
    }

    public function storeItem(Request $request){
        $gestor = new Item;
        $gestor->Nome=  $request->Nome;
        $gestor->Descricao=  $request->Descricao;
        $gestor->Empresa= $request->Empresa;
        $gestor->ativo = 1;
        $gestor->save();

        Session::flash('title', 'Cadastro Realizado!');
        Session::flash('message', 'Item cadastrado com sucesso!'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect()->back();
    }
    public function showObjeto(){
        $setor = new Setor;
        $setor = $setor->where('Empresa', Auth::user()->Empresa)->where('ativo', 1)->get();
        return view('cadastro.cadastroObjeto', ['setor'=>$setor]);
    }

    public function storeObjeto(Request $request){
        $objeto = new Objeto;
        $objeto->Nome=  $request->Nome;
        $objeto->SetorID=  $request->Setor;
        $objeto->Empresa= $request->Empresa;
        $objeto->ativo = 1;
        $objeto->save();
        
        Session::flash('title', 'Cadastro Realizado!');
        Session::flash('message', 'Objeto cadastrado com sucesso!'); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect()->back();
    }
}
