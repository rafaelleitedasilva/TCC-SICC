<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Notifications\{NotificationChamado,NotificationItem, NotificationChamadoAlterado};
use App\Models\{Setor,Chamado,Comentario,Item,User,Objeto};
use DataTables;

class ChamadoController extends Controller
{
    public function Chamado($ID){
        $chamado = new Chamado;
        $chamado = $chamado->where('Empresa', Auth::user()->Empresa)->where('ID', $ID)->get();

        $item = new Item;
        $item = $item->where('Empresa', Auth::user()->Empresa)->where('ativo', 1)->get();
        
        $comentarios = new Comentario;
        $comentarios = $comentarios->where('Empresa', Auth::user()->Empresa)->where('idChamado', $ID)->get();

        $usuarios = new User();
        $usuarios = $usuarios->get();
        
        return view('chamado.chamado',['chamado'=>$chamado, 'comentarios'=>$comentarios, 'item'=>$item, 'usuarios'=>$usuarios]);
    }
    
    public function alterarItem(Request $request){
        $chamado = new Chamado;
        $chamado = $chamado->where('ID', $request->ID)->update(['Itens'=>$request->itens]);
        return redirect('chamado/abertura');
    }
    
    public function alterarChamado(Request $request){
        $gestor = new Setor();
        $gestor = $gestor->where('ID', $request->Setor)->where('ativo', 1)->first();
            
        $chamado = new Chamado;
        $chamado = $chamado->where('ID', $request->ID)->update(['processo'=>$request->processo, 'Manutentor'=>Auth::user()->Nome]);
        
        $chamadoNotification = new Chamado;
        $chamadoNotification = $chamadoNotification->where('ID', $request->ID)->first();
        
        
        $solEmail = new User();
        $solEmail = $solEmail->where('Empresa', Auth::user()->Empresa)->where('Nome',$chamadoNotification->Solicitante)->where('ativo', 1)->first();
        
        Notification::route('mail', $solEmail->email)->notify(new NotificationChamadoAlterado($chamadoNotification));
        
        if($request->itens != null && $request->processo == 2){
            $users = new User();
            $users = $users->where('Empresa', Auth::user()->Empresa)->where('acesso', 'Compras')->where('ativo', 1)->get();

            foreach ($users as $user) {
                Notification::route('mail', $user->email)->notify(new NotificationItem($request->itens, $chamadoNotification));
            }

            Notification::route('mail', $gestor->Gestor->email)->notify(new NotificationItem($request->itens, $chamadoNotification));
        }
        
        return redirect('chamado/abertura');
    }
    
    public function comentarioChamado(Request $request){
        $comentario = new Comentario;
        $comentario->Comentario = $request->Comentario; 
        $comentario->idUsuario =  Auth::user()->ID; 
        $comentario->Foto =  Auth::user()->Foto;
        $comentario->idChamado = $request->idChamado; 
        $comentario->Empresa = $request->Empresa; 
        $comentario->save();
        
        return redirect()->back();
    }
    
    public function showChamado(){
        $setores = new Setor;
        $setores = $setores->where('Empresa', Auth::user()->Empresa)->where('ativo', 1)->get();

        $dados = new Objeto;
        $dados = $dados->where('Empresa', Auth::user()->Empresa)->where('ativo', 1)->get();

        $chamados = new Chamado;
        $chamados = $chamados->where('Empresa', Auth::user()->Empresa)->get();
        
        return view('chamado.index',['setores'=>$setores, 'dados'=>$dados, 'objeto'=>null, 'setor'=>null, 'chamado'=>null]);
    }
    
    public function qrcodeObjeto($ID){
        $setores = new Setor;
        $setores = $setores->where('Empresa', Auth::user()->Empresa)->where('ativo', 1)->get();
        
        $dados = new Objeto;
        $dados = $dados->where('Empresa', Auth::user()->Empresa)->where('ativo', 1)->get();
        
        $objeto = new Objeto;
        $objeto = $objeto->where('ID', $ID)->first();
        
        $chamado = new Chamado;
        $chamado = $chamado->where('Empresa', Auth::user()->Empresa)->where('ObjetoID', $ID)->get();
        
        return view('chamado.index',['setores'=>$setores, 'dados'=>$dados, 'objeto'=>$objeto, 'setor'=>null, 'chamado'=>$chamado]);
    }
    
    public function qrcodeSetor($ID){
        $setores = new Setor;
        $setores = $setores->where('Empresa', Auth::user()->Empresa)->where('ativo', 1)->get();
        
        $dados = new Objeto;
        $dados = $dados->where('Empresa', Auth::user()->Empresa)->where('SetorID', $ID)->where('ativo', 1)->get();
        
        $setor = new Setor;
        $setor = $setor->where('ID', $ID)->first();
        
        $chamado = new Chamado;
        $chamado = $chamado->where('Empresa', Auth::user()->Empresa)->where('SetorID', $ID)->get();
        
        return view('chamado.index',['setores'=>$setores, 'dados'=>$dados,'objeto'=>null, 'setor'=>$ID, 'chamado'=>$chamado]);
        
    }

    public function chamados(){
            $data = new Chamado;
            $data = $data->where('Empresa',Auth::user()->Empresa)->select('ID','Nome', 'Descricao', 'ObjetoID','SetorID','Grau','Solicitante','Processo','created_at')->get();
            foreach ($data as $item) {
                $item->ObjetoID = $item->ObjetoID ?? 'Objeto Indefinido';
                
                if ($item->Processo == 0 || $item->Processo == '0') {
                    $color = 'rgb(255, 74, 74)';
                    $processo = '0';
                } elseif ($item->Processo == 1 || $item->Processo == '1') {
                    $color = 'rgb(70, 104, 255)';
                    $processo = '1';
                } elseif ($item->Processo == 2 || $item->Processo == '2') {
                    $color = 'rgb(115, 255, 87)';
                    $processo = '2';
                } else {
                    $color = 'rgb(90, 90, 90)';
                    $processo = '3';
                }

                if ($item->Grau == 1) {
                    $grau = 'Baixo';
                } elseif ($item->Grau == 2) {
                    $grau = 'Médio';
                } else {
                    $grau = 'Alto';
                }
                
                $item->Grau = $grau;
                $item->link = route('chamado', ['ID'=>$item->ID]);
                
                $created_at = $item->created_at;
                if($item->Descricao == null){
                    $item->Descricao = 'Sem Descrição';
                }
                $item->Processo = sprintf('<p hidden>%s %s</p><span class="fa fa-circle d-block m-auto" style="color:%s;"></span>', $processo, $created_at, $color);
                $item->SetorID = $item->Setor->Nome;
            }

            return DataTables::of($data)
            ->rawColumns(['Processo'])
            ->make(true);
    }

    public function showHistorico(){
        $chamados = new Chamado;
        $chamados = $chamados->where('Empresa', Auth::user()->Empresa)->get();
        return view('chamado.historico',['chamados'=>$chamados]);
    }

    public function storeChamado(Request $request){        
        $chamado = new Chamado;
        $chamado->Nome = $request->Nome; 
        $chamado->Solicitante =  Auth::user()->Nome; 
        $chamado->ObjetoID = $request->Objeto; 
        $chamado->SetorID = $request->Setor; 
        $chamado->Descricao = $request->Descricao; 
        $chamado->Grau = $request->Grau; 
        $chamado->Processo = 0; 
        $chamado->created_at = "$request->data $request->hora";
        $chamado->Empresa = $request->Empresa; 
        $chamado->save();

        $users = new User();
        $users = $users->where('Empresa', Auth::user()->Empresa)->where('acesso', 'Manutenção')->where('ativo', 1)->get();

        
        foreach ($users as $user) {
            Notification::route('mail', $user->email)->notify(new NotificationChamado($chamado));
        }

        $gestor = new Setor();
        $gestor = $gestor->where('ID', $chamado->SetorID)->where('ativo', 1)->first();

        Notification::route('mail', $gestor->Gestor->email)->notify(new NotificationChamado($chamado));
        

        Session::flash('title', 'Chamado Aberto!');
        Session::flash('message', 'O seu chamado foi aberto e será atendido em breve!'); 
        Session::flash('alert-class', 'alert-success'); 
        
        return redirect()->back();
    }
}
