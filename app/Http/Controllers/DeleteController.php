<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class DeleteController extends Controller
{
    public function Setores($ID){
        DB::table('Setor')->where('ID', $ID)->update(['ativo'=>0]);

        Session::flash('title', 'Operação Realizada!'); 
        Session::flash('message', 'Setor apagado com sucesso!'); 
        Session::flash('alert-class', 'alert-warning'); 
        return redirect()->back();
    }


    public function Fornecedores($ID){
        DB::table('Fornecedor')->where('ID', $ID)->update(['ativo'=>0]);
        
        Session::flash('title', 'Operação Realizada!'); 
        Session::flash('message', 'Fornecedor apagado com sucesso!'); 
        Session::flash('alert-class', 'alert-warning'); 
        return redirect()->back();
    }

    public function Itens($ID){
        DB::table('Item')->where('ID', $ID)->update(['ativo'=>0]);
        
        Session::flash('title', 'Operação Realizada!'); 
        Session::flash('message', 'Item apagado com sucesso!'); 
        Session::flash('alert-class', 'alert-warning'); 
        return redirect()->back();
    }

    public function Objetos($ID){
        DB::table('Objeto')->where('ID', $ID)->update(['ativo'=>0]);
        
        Session::flash('title', 'Operação Realizada!'); 
        Session::flash('message', 'Objeto desativado com sucesso!'); 
        Session::flash('alert-class', 'alert-warning'); 
        return redirect()->back();
    }

    public function Usuarios($ID){
        if(DB::table('Users')->where('ID', $ID)->value('ativo') == 0){
            DB::table('Users')->where('ID', $ID)->update(['ativo'=>1]);
            Session::flash('message', 'Usuário ativado com sucesso!'); 
        }else{
            DB::table('Users')->where('ID', $ID)->update(['ativo'=>0]);
            Session::flash('message', 'Usuário desativado com sucesso!'); 
        }

        Session::flash('title', 'Operação Realizada!'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect()->back();
    }

}
