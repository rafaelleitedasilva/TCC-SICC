@extends('template.principal')
@section('content')
@foreach($objetos as $objeto)

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Atualização de Objeto</h2>
    </div>
</div>

@if(Auth::user()->Empresa == $objeto->Empresa || Auth::user()->Empresa == 'Administrador Sicc')
<section>
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col mt-3">
                <form action="{{route('update_objetos', ['ID' => $objeto->ID])}}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    
                    <!-- Nome input -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="Nome">Nome</label>
                        <input type="text" id="Nome" name="Nome" value="{{$objeto->Nome}}"  class="form-control form-control-lg"
                        />
                    </div>
                    
                    <div class="form-outline mb-4">
                        <label class="form-label" for="Setor"><strong>Setor:</strong></label>
                        <select id="Setor" name="SetorID" class="form-control form-control-lg">
                            @foreach ($setor as $s)
                                <option @if($s->Nome == $objeto->Setor->Nome) selected @endif value="{{ $s->ID }}">{{ $s->Nome }}</option>  
                            @endforeach
                        </select>
                    </div>
                    
                    @if(Auth()->user()->Empresa != 'Administrador Sicc')
                    <input type="text" name="Empresa" value="{{Auth()->user()->Empresa}}" hidden>
                    @else
                    <div class="form-outline mb-3">
                        <input type="text" name="Empresa" class="form-control form-control-lg" value="{{$objeto->Empresa}}" placeholder="Coloque o nome da Empresa">
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