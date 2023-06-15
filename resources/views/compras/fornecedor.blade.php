@extends('template.principal')
@section('content')
@foreach($fornecedores as $fornecedor)

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Atualização de Fornecedor</h2>
    </div>
</div>

@if(Auth::user()->Empresa == $fornecedor->Empresa || Auth::user()->Empresa == 'Administrador Sicc')
<section>
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col mt-3">
                <form action="{{route('update_fornecedores', ['ID' => $fornecedor->ID])}}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    
                    <!-- Nome input -->
                    <div class="form-outline mb-3">
                        <input type="text" id="nome" name="nome" value="{{$fornecedor->Nome}}"  class="form-control form-control-lg"
                        />
                        <label class="form-label" for="nome">Nome</label>
                    </div>

                    <div class="form-outline mb-3">
                        <input type="text" id="Email" name="Email" value="{{$fornecedor->Email}}"  class="form-control form-control-lg"
                        />
                        <label class="form-label" for="Email">Email</label>
                    </div>

                    <div class="form-outline mb-3">
                        <input type="text" id="Telefone" name="Telefone" value="{{$fornecedor->Telefone}}"  class="form-control form-control-lg"
                        />
                        <label class="form-label" for="Telefone">Telefone</label>
                    </div>

                    <div class="form-outline mb-3">
                        <input type="text" id="Servico" name="Servico" value="{{$fornecedor->Servico}}"  class="form-control form-control-lg"
                        />
                        <label class="form-label" for="Servico">Serviço</label>
                    </div>

                    <div class="form-outline mb-3">
                        <input type="text" id="Local" name="Local" value="{{$fornecedor->Local}}"  class="form-control form-control-lg"
                        />
                        <label class="form-label" for="Local">Local</label>
                    </div>

                    <div class="form-outline mb-3">
                        <input type="text" id="Descricao" name="Descricao" value="{{$fornecedor->Descricao}}"  class="form-control form-control-lg"
                        />
                        <label class="form-label" for="Descricao">Descrição</label>
                    </div>

                    @if(Auth()->user()->Empresa != 'Administrador Sicc')
                    <input type="text" name="Empresa" value="{{Auth()->user()->Empresa}}" hidden>
                    @else
                    <div class="form-outline mb-3">
                        <input type="text" name="Empresa" class="form-control form-control-lg" value="{{$fornecedor->Empresa}}" placeholder="Coloque o nome da Empresa">
                        <label class="form-label" for="Empresa">Empresa</label>
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