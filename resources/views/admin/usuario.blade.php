@extends('template.principal')
@section('content')
@foreach($users as $user)

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Atualização de Usuários</h2>
    </div>
</div>

@if(Auth::user()->Empresa == $user->Empresa || Auth::user()->Empresa== 1)
<section>
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col mt-3">
                
                <form action="{{$user->ID}}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    
                    <!-- Nome input -->
                    <div class="form-outline mb-3">
                        <input type="text" id="nome" name="nome" value="{{$user->Nome}}"  class="form-control form-control-lg"
                        placeholder="Coloque um nome para o usuário" />
                        <label class="form-label" for="nome">Nome</label>
                    </div>
                    
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="email" id="email"  name="email" value="{{$user->email}}" class="form-control form-control-lg"
                        placeholder="Coloque um Email válido" />
                        <label class="form-label" for="email">Endereço de Email</label>
                    </div>

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <select name="ativo" id="ativo" class="form-control form-control-lg" @if(Auth::user()->Nome == $user->Nome) disabled @endif>
                            <option value="1" @if($user->ativo == 1) selected @endif>Ativado</option>
                            <option value="0">Desativado</option>
                        </select>
                        <label class="form-label" for="ativo">Ativação</label>
                    </div>
                    
                    <!-- Acesso select -->
                    <div class="form-outline mb-3">
                        <select type="acesso" id="acesso" name="acesso" class="form-control form-control-lg" @if(Auth::user()->Nome == $user->Nome) disabled @endif>
                            <option value="admin" @if($user->acesso == 'admin') selected @endif>Administrativo</option>
                            <option value="Manutenção" @if($user->acesso == 'Manutenção') selected @endif>Manutenção</option>
                            <option value="Compras" @if($user->acesso == 'Compras') selected @endif>Compras</option>
                            <option value="Geral" @if($user->acesso == 'Geral') selected @endif>Geral</option>
                        </select>
                        <label class="form-label" for="acesso">Acesso</label>
                    </div>
                    @if(Auth()->user()->Empresa != 1)
                    <input type="text" name="Empresa" value="{{Auth()->user()->Empresa}}" hidden>
                    @else
                    <div class="form-outline mb-3">
                        <input type="text" name="Empresa" class="form-control form-control-lg" value="{{$user->Empresa}}" placeholder="Coloque o nome da Empresa">
                        <label class="form-label" for="Empresa">Empresa: {{$user->EmpresaID->nome}}</label>
                    </div>
                    @endif
                    <div class="d-flex w-100 justify-content-start pt-4">
                        <button class="btn btn-primary" type="submit"> Atualizar </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@else
<div><h1 class="text-center display" style="color:brown">Você não tem acesso a esses dados!</h1></div>
@endif
@endforeach
@endsection