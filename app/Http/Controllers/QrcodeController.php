<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use phpseclib\Net\SFTP;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\BaconQrCodeGenerator;

use App\Models\{
    Objeto,
    Setor
};

class QrcodeController extends Controller
{
    public function Objeto(){
        $objeto = new Objeto;
        $objeto = $objeto->where('Empresa', Auth::user()->Empresa)->where('ativo', 1)->get();

        foreach($objeto as $obj){
            $qrCode = new BaconQrCodeGenerator;
            $qrCode->format('png');
            $qrCode->size(300);
            $qrCode->generate(route('qrcodeObjeto', ['ID' => $obj->ID]), public_path("qrcode/$obj->ID-$obj->Nome.png"));
        }
        
        return view('qrcode.objeto', ['objeto' => $objeto]);
    }

    public function Setor(){
        $setor = new Setor;
        $setor = $setor->where('Empresa', Auth::user()->Empresa)->where('ativo', 1)->get();

        foreach($setor as $set){
            $qrCode = new BaconQrCodeGenerator;
            $qrCode->format('png');
            $qrCode->size(300);
            $qrCode->generate(route('qrcodeSetor', ['ID' => $set->ID]), public_path("qrcode/$set->ID-$set->Nome.png"));
        }
        
        return view('qrcode.setor', ['setor' => $setor]);
    }

    public function Camera(){
        return view('qrcode.camera');
    }
}
