@extends('template.principal')
@section('content')
<h1 class="display">Funcionários da {{ Auth::user()->EmpresaID->nome }}</h1>
<div class="row">
    @foreach($usuarios as $usuario)
    <div class="col">
        <div class="contact-box center-version" style="height: 290px;">
            <a style="hover:default;">
            <p></p>
                <h3 class="m-b-xs mt-2"><strong>{{ $usuario->Nome }}</strong></h3>
            </a>
            <div class="contact-box-footer">
                <div class="m-t-xs btn-group">
                    <p><strong>Acesso:</strong><br>@if($usuario->acesso == 'admin') Administrador @else {{ $usuario->acesso }} @endif</p>
                </div>
                <hr>
                <div class="m-t-xs btn-group">
                    <p><strong>Email:</strong><br>{{$usuario->email}}</p>
                </div>
            </div>

        </div>
    </div>
    @endforeach
</div>
@endsection
