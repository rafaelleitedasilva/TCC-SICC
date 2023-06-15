<?php

namespace App\Http\Controllers;

use App\Mail\ContatoMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class WebsiteController extends Controller
{
    public function Home(){
        return view('web.index');
    }

    public function Contact(){
        return view('web.contact');
    }

    public function Contato(Request $request){

        $nome = $request->Nome;
        $email = $request->email;
        $assunto = $request->assunto;
        $mensagem = $request->mensagem;

        // Enviar o email
        Mail::to('central.sicc@gmail.com')->send(new ContatoMail($nome, $email, $assunto, $mensagem));


        Session::flash('title', 'Contato realizado!'); 
        Session::flash('message', 'Seu email foi enviado para a nossa empresa, retornaremos assim que possível!'); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect()->back();
    }
}
