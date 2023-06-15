<?php

namespace App\Http\Controllers;

use App\Models\{
    Objeto,
    Fornecedor,
    Item,
    Setor,
    User
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use DataTables;

class VisualizacaoController extends Controller
{

    public function Itens(){
        $itens = new Item;
        $itens = $itens->where('Empresa', Auth::user()->Empresa)->where('ativo', 1)->get(); 
        

        return view('visualizacao.itens', ['itens' => $itens]);
    }

    public function updateItens($ID){
        $itens = new Item;
        $itens = $itens->where('ID', $ID)->get();
        return view('visualizacao.item', ['itens' => $itens]);
    }

    public function updateItensStore($ID, Request $request){
        $item = DB::table('Item')->where('ID', $ID)->update($request->except('_token'));

        Session::flash('title', 'Atualização feita!'); 
        Session::flash('message', 'Item atualizado com sucesso!'); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect()->back();
    }

    public function Objetos(){
            $maquinas = new Objeto;
            $maquinas = $maquinas->where('Empresa', Auth::user()->Empresa)->where('ativo', 1)->get(); 
        

        return view('visualizacao.objetos', ['objetos' => $maquinas]);
    }

    public function updateObjetos($ID){
        $maquinas = new Objeto;
        $maquinas = $maquinas->where('ID', $ID)->get(); 

        $setor = DB::table('Setor')->where('Empresa', Auth::user()->Empresa)->get();
        return view('visualizacao.objeto', ['objetos' => $maquinas, 'setor'=>$setor]);
    }

    public function updateObjetosStore($ID, Request $request){
        $objeto = DB::table('Objeto')->where('ID', $ID)->update($request->except('_token'));

        Session::flash('title', 'Atualização feita!'); 
        Session::flash('message', 'Objeto atualizado com sucesso!'); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect()->back();
    }

    public function Setores(){
            $setores = new Setor;
            $setores = $setores->where('Empresa', Auth::user()->Empresa)->where('ativo', 1)->get();
        

        return view('visualizacao.setores', ['setores' => $setores]);
    }

    public function SetoresJson(){
        $data = new Setor;
        $data = $data->where('Empresa',Auth::user()->Empresa)->where('ativo',1)->select('ID','Nome', 'GestorID')->get();

        $gestor = new User;
        $gestor = $gestor->where('Empresa',Auth::user()->Empresa)->where('ativo',1);

        foreach($data as $item){
            $item->GestorID = $item->Gestor->Nome;
        }
        
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $route = route('update_setores',[$row->ID]);
            $routeDelete = route('setores_delete',[$row->ID]);
            $btn = '<a href="'.$route.'" class="edit btn btn-primary btn-sm m-1">Editar</a>';
            $btn = $btn.'<a href="'.$routeDelete.'" class="edit btn btn-danger btn-sm m-1">Deletar</a>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function updateSetores($ID){
            $setores = new Setor;
            $setores = $setores->where('ID', $ID)->get();

            $user = DB::table('Users');
            $user = $user->where('Empresa', Auth::user()->Empresa)->get();


        return view('visualizacao.setor', ['setores' => $setores,'user' => $user]);
    }

    public function updateSetoresStore($ID, Request $request){
        $setores = DB::table('Setor')->where('ID', $ID)->update($request->except('_token','informacao_length'));

        Session::flash('title', 'Atualização feita!'); 
        Session::flash('message', 'Setor atualizado com sucesso!'); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect()->back();
    }

    public function Fornecedores(){
            $fornecedores = new Fornecedor;
            $fornecedores = $fornecedores->where('Empresa', Auth::user()->Empresa)->where('ativo', 1)->get();

            $itens = new Item;
            $itens = $itens->where('Empresa', Auth::user()->Empresa)->get();

        return view('compras.fornecedores', ['fornecedores' => $fornecedores, 'itens' => $itens]);
    }

    public function updateFornecedores($ID){
            $fornecedores = new Fornecedor;
            $fornecedores = $fornecedores->where('ID', $ID)->get();

            $itens = new Item;
            $itens = $itens->get();

        return view('compras.fornecedor', ['fornecedores' => $fornecedores,'itens' => $itens]);
    }

    public function updateFornecedoresStore($ID, Request $request){
        $fornecedores = new Fornecedor;
        $fornecedore = $fornecedores->where('ID', $ID)->update($request->except('_token'));

        Session::flash('title', 'Atualização feita!'); 
        Session::flash('message', 'Fornecedor atualizado com sucesso!'); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect()->back();
    }

}