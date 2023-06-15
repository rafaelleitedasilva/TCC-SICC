<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use DataTables;


use App\Models\{
    Item,
    Fornecedor
};

class ComprasController extends Controller
{
    public function showFornecedor(){
        $itens = new Item;
        $itens = $itens::where('Empresa',Auth::user()->Empresa)->get();
        return view('compras.cadastroFornecedor',['itens' => $itens]);
    }
    
    public function fornecedores(){
        $data = new Fornecedor;
        $data = $data->where('Empresa',Auth::user()->Empresa)->where('ativo', 1)->select('ID','Nome','Email','Telefone','Servico','Local','Descricao')->get();

        foreach ($data as $item) {
            if ($item->Nome == null) {
                $item->Nome = 'Nome Indefinido';
            }if($item->Email == null){
                $item->Email = 'Email Indefinido';
            }if($item->Telefone == null){
                $item->Telefone = 'Telefone Indefinido';
            }if($item->Servico == null){
                $item->Servico = 'Serviço Indefinido';
            }
        }

        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $route = route('update_fornecedores',[$row->ID]);
            $routeDelete = route('fornecedores_delete',[$row->ID]);
            $btn = '<a href="'.$route.'" class="edit btn btn-primary btn-sm m-1">Editar</a>';
            $btn = $btn.'<a href="'.$routeDelete.'" class="edit btn btn-danger btn-sm m-1">Deletar</a>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
    
    public function storeFornecedor(Request $request){
        $fornecedor = new Fornecedor;
        $fornecedor->Nome = $request->Nome;
        $fornecedor->Email = $request->email;
        $fornecedor->Telefone = $request->telefone;
        $fornecedor->Servico = $request->Servico;
        $fornecedor->IDItem = $request->Item;
        $fornecedor->Descricao = $request->Descricao;
        $fornecedor->ativo = 1;
        $fornecedor->Local = $request->Local;
        $fornecedor->Empresa = $request->Empresa;
        $fornecedor->save();
        
        Session::flash('title', 'Cadastro Realizado!');
        Session::flash('message', 'Fornecedor cadastrado com sucesso!'); 
        Session::flash('alert-class', 'alert-success'); 
        
        return redirect()->back();
    }
}
