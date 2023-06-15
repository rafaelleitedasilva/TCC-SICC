<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    Setor,
    Chamado,
    Objeto,
};

class RelatorioController extends Controller
{
    public function Objeto(){
        $objeto = new Objeto;
        $objeto = $objeto->where('Empresa', Auth::user()->Empresa)->get();

        return view('relatorios.objeto', ['objeto'=>$objeto]);
    }

    public function Mensal(){
        return view('relatorios.mensal');
    }

    public function Setor(){
        $chamados = new Chamado;

        $setores = new Setor;
        $setores = $setores->where('Empresa', Auth::user()->Empresa)->get();

        $array = [];
        foreach($setores as $setor){
            $chamadosSetor = $chamados->where('Empresa', Auth::user()->Empresa)->where('SetorID', $setor->ID)->get();
            $array[$setor->Nome] = [$chamadosSetor->count() , $chamadosSetor->isNotEmpty() ? $chamados->where('Empresa', Auth::user()->Empresa)->where('SetorID', $setor->ID)->latest()->first()->created_at->format('d/m/Y H:i:s'): 'N/A'];
        }

        return view('relatorios.setor')->with('array',$array);
    }

    public function Anual(){
        return view('relatorios.anual');
    }

    public function AnoMesDados(){
        $anos = [];

        $relatorios = new Chamado;
        $relatorios = $relatorios->where('Empresa', Auth::user()->Empresa)->select('created_at')->get();

        foreach($relatorios as $relatorio){
            if(!in_array(date('Y', strtotime($relatorio->created_at)), $anos)){
                array_push($anos,date('Y', strtotime($relatorio->created_at)));
            }
        }

        rsort($anos);

        return $anos;
    }

    public function AnoAnoDados(){
        $anos = [];

        $relatorios = new Chamado;
        $relatorios = $relatorios->where('Empresa', Auth::user()->Empresa)->select('created_at')->get();

        foreach($relatorios as $relatorio){
            if(!in_array(date('Y', strtotime($relatorio->created_at)), $anos)){
                array_push($anos,date('Y', strtotime($relatorio->created_at)));
            }
        }

        rsort($anos);

        return $anos;
    }

    public function AnosDados(Request $request)
    {
        $chamados = Chamado::where('Empresa', Auth::user()->Empresa)
                        ->whereYear('created_at', $request->ano)
                        ->get();
    
        $mesArray = [0,0,0,0,0,0,0,0,0,0,0,0];
    
        foreach ($chamados as $chamado) {
            $mes = explode('-', $chamado->created_at)[1];
    
            $mesArray[(int)$mes - 1] += 1;
        }
    
        return $mesArray;
    }
    

    public function SetorDados(Request $request){
        $setores = new Setor;
        $setores = $setores->where('Empresa',$request->empresa)->get();

        $chamado = new Chamado;
        $chamado = $chamado->where('Empresa',$request->empresa)->get();

        $setorArray = [];
        $setorPendenteArray = [];
        $setorAndamentoArray = [];
        $setorConcluidoArray = [];
        $setorCanceladoArray = [];

        foreach($setores as $setor){
            $setorArray[$setor->Nome] = 0;
            $setorPendenteArray[$setor->Nome] = 0;
            $setorAndamentoArray[$setor->Nome] = 0;
            $setorConcluidoArray[$setor->Nome] = 0;
            $setorCanceladoArray[$setor->Nome] = 0;
        }

        foreach($setores as $setor){
            foreach($chamado as $ch){
                if($setor->ID == $ch->SetorID && $ch->Processo == 0){
                        $setorPendenteArray[$setor->Nome] += 1;
                }else if($setor->ID == $ch->SetorID && $ch->Processo == 1){
                        $setorAndamentoArray[$setor->Nome] += 1;
                }
            }
        }

        return [$setorPendenteArray, $setorAndamentoArray, $setorConcluidoArray, $setorCanceladoArray, $setorArray];
    }

    public function MesDados(Request $request){
        $chamados = new Chamado;
        $chamados = $chamados->where('Empresa', Auth::user()->Empresa)->whereYear('created_at', $request->ano)->get();
        $mesArray = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
        
        foreach ($chamados as $chamado){
            $dia = explode(' ',explode('-',$chamado->created_at)[2])[0];
            $mes = explode('-',$chamado->created_at)[1];
            if($request->mes == $mes){
                $mesArray[$dia-1] += 1;
            }
        }

        return $mesArray;
    }

    public function MesDadosTabela(Request $request){ 
        $chamados = new Chamado;
        $chamados = $chamados->where('Empresa', Auth::user()->Empresa)->whereYear('created_at', $request->ano)->whereMonth('created_at', $request->mes)->get();

        return $chamados;
    }

    public function SetorDadosTabela(Request $request){
        $setor = new Setor;
        $setor = $setor->where('Empresa', Auth::user()->Empresa)->where('ID', $request->SetorID)->first();
        return $setor;
    }

    public function ObjetoDados(Request $request){
        $objeto = new Objeto;
        $objeto = $objeto->where('ID', $request->objeto)->where('Empresa', Auth::user()->Empresa);
        $objeto = $objeto->first();

        $chamados = new Chamado;
        $chamados = $chamados->where('ObjetoID', $objeto->ID)->where('Empresa', Auth::user()->Empresa);
        $chamados = $chamados->get();
        
        $objetoArray = [0,0,0,0,0,0,0,0,0,0,0,0];
        $processoArray = [];$processoArray[0] = 0;$processoArray[1] = 0;$processoArray[2] = 0;$processoArray[3] = 0;

        
        foreach ($chamados as $chamado){
            $processo = $chamado->Processo;
            $processoArray[$processo] += 1;

            $mes = explode('-',$chamado->created_at)[1];
            if($mes == '01'){
                $objetoArray[0] += 1;
                }else if($mes == '02'){
                    $objetoArray[1] += 1;
                }else if($mes == '03'){
                    $objetoArray[2] += 1;
                }else if($mes == '04'){
                    $objetoArray[3] += 1;
                }else if($mes == '05'){
                    $objetoArray[4] += 1;
                }else if($mes == '06'){
                    $objetoArray[5] += 1;
                }else if($mes == '07'){
                    $objetoArray[6] += 1;
                }else if($mes == '08'){
                    $objetoArray[7] += 1;
                }else if($mes == '09'){
                    $objetoArray[8] += 1;
                }else if($mes == '10'){
                    $objetoArray[9] += 1;
                }else if($mes == '11'){
                    $objetoArray[10] += 1;
                }else if($mes == '12'){
                $objetoArray[11] += 1;
            }


        }


        return [$objetoArray,$chamados,$processoArray];
    }
}
