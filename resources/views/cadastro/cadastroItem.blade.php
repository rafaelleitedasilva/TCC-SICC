@extends('template.principal')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Cadastro do Item</h2>
    </div>
</div>

<section>
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col mt-3">
                <form action="{{route('cadastro_item')}}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    
                    <!-- Nome input -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="nome"><strong>Nome:</strong></label>
                        <input type="text" id="Nome" name="Nome"  class="form-control form-control-lg"/>
                    </div>

                    <!-- Descricao input -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="Descricao"><strong>Descrição:</strong></label>
                        <textarea name="Descricao" id="Descricao" class="form-control form-control-lg" maxlength="1000"></textarea>
                    </div>

                    @if(Auth()->user()->Empresa != 'Administrador Sicc')
                    <input type="text" name="Empresa" value="{{Auth()->user()->Empresa}}" hidden>
                    @else
                    <div class="form-outline mb-3">
                        <input type="text" name="Empresa" value="" class="form-control form-control-lg" placeholder="Coloque o nome da Empresa">
                        <label class="form-label" for="Empresa">Empresa</label>
                    </div>
                    @endif

                    <div class="d-flex w-100 justify-content-start pt-2">
                        <button class="btn btn-primary" type="submit"> Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection