@extends('template.principal')
@section('content')
<section>
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col mt-3">
                <form action="{{route('perfil')}}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <!-- Nome input -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="Nome">Nome</label>
                        <input type="text" id="Nome" name="Nome" value="{{Auth::user()->Nome}}"  class="form-control form-control-lg"
                        />
                    </div>
                    
                    <!-- Email input -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="password">Resetar Senha</label>
                        <input type="password" id="Email" name="password" value=""  class="form-control form-control-lg"
                        />
                    </div>
                    
                    <div class="d-flex w-100 justify-content-start pt-4">
                        <button class="btn btn-primary" type="submit"> Atualizar </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection