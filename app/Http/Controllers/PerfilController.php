<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PerfilController extends Controller
{
    public function perfil(){
        
        return view('perfil');
    }

    public function perfilStore(Request $request){
        $user = new User();
        $user = $user->where('ID', Auth::user()->ID)->update(['password' => Hash::make($request->password)]);
        
        return redirect()->back();
    }

    public function upload(Request $request){
        // Valida o arquivo de imagem
        $validator = Validator::make($request->all(), [
            'Foto' => 'required|max:8192',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        // Salva o arquivo de imagem no servidor
        $path = $request->file('Foto')->move(public_path('fotos_perfil'), Auth::user()->ID.".png");

        // Salva o caminho do arquivo de imagem no banco de dados
        $usuario = new User;
        $usuario = $usuario->where('ID', Auth::user()->ID)->first();
        $usuario->Foto = Auth::user()->ID.".png";
        $usuario->save();

        return back();
    }

    public function funcionarios(){
        $usuarios = new User;
        $usuarios = $usuarios
        ->where('Empresa', Auth::user()->Empresa)
        ->where('Ativo', 1)
        ->orderBy('nome')
        ->get();

        return view('funcionarios', ['usuarios'=>$usuarios]);
    }
}
