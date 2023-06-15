@extends('template.principal')
@section('content')
@if(Auth::check())

<h1 class="display" style="font-family: Georgia, serif"><strong>Novo Chamado</strong></h1>
<div class="form p-3">
    <form action="{{route('abertura')}}" method="post">
        {{ csrf_field() }}
        
        <div class="row m-3">
            <div class="col">
                <h3 class="text-start"> Título do Chamado </h3>
                <input type="text" class="form-control" placeholder="Título do problema" value="" id="Nome" name ='Nome' required>
            </div>
        </div>
        
        <div class="row m-3">
            <div class="col">
                <h3 class="text-start"> Descrição </h3>
                <textarea name="Descricao" id="Descricao" class="form-control"></textarea>
            </div>
        </div>
        
        <div class="row m-3">
            <div class="col" style="min-width: 250px;">
                <div class="form-outline mb-3">
                    <h3 class="text-start"> Setor </h3>
                    @if($objeto != null)
                    <select id="Setor" name="Setor"  class="form-control form-control-lg" readonly>
                        @foreach ($setores as $set)
                        <option value="{{ $set->ID }}" @if( $set->ID == $objeto->Setor->ID) selected @endif>{{ $set->Nome }}</option>  
                        @endforeach
                    </select>
                    @else
                    <select id="Setor" name="Setor"  class="form-control form-control-lg" readonly>
                        @foreach ($setores as $set)
                        <option value="{{ $set->ID }}" @if( $set->ID == $setor) selected @endif>{{ $set->Nome }}</option>  
                        @endforeach
                    </select>
                    @endif
                </div>
            </div>
            
            <div class="col" style="min-width: 250px;">
                <h3 class="text-start"> Objeto </h3>
                <div class="form-outline d-flex">
                    @if($objeto != null)
                        <input type="text" name="Objeto" id="Value" value="{{ $objeto->ID }}" class="form-control ml-3" hidden>
                        <input type="text" id="Value" value="{{ $objeto->Nome }}" class="form-control" readonly>
                    @else
                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#Objeto">
                        Objeto
                    </button>
                    <input type="text" name="Objeto" id="Value" value="424" class="form-control ml-3" hidden>
                    <input type="text" id="ObjetoNome" name="ObjetoNome" value="" class="form-control ml-3" readonly>
                    <div class="modal inmodal fade" id="Objeto" tabindex="-1" role="dialog" style="display: none;">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">Objeto</h4>
                                </div>
                                
                                <div class="modal-body">
                                    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css"/>
                                    <table id="informacao" class="display" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
                                                <th>Setor</th>
                                            </tr>
                                        </thead>
                                        @foreach($dados as $dado)
                                        <tr id="sel">
                                            <td id="Objeto" data-dismiss="modal">
                                                {{ $dado->ID }}
                                            </td>
                                            <td id="Objeto" data-dismiss="modal">
                                                {{ $dado->Nome }}
                                            </td>
                                            <td id="Objeto" data-dismiss="modal" class="{{ $dado->Setor->ID }}">
                                                {{ $dado->Setor->Nome }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                    <style>
                                        #sel:hover{
                                            cursor: pointer;
                                        }
                                    </style>
                                    <script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
                                </div>
                                
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                </div>
            </div>
            
        </div>
        
        <div class=" m-3">
            <div class="col">
                <h3 class="text-start"> Grau de urgência </h3>
                <select class="form-control form-control-lg" name = "Grau" aria-label=".form-select-sm example">
                    <option value="1">Baixa</option>
                    <option value="2">Média</option>
                    <option value="3">Alta</option>
                </select>
            </div>
        </div>
        
        <input type="text" class="form-control" value="{{ Auth::user()->Nome }}" name = 'Solicitante' hidden>
        
        @if(Auth()->user()->Empresa != 'Administrador Sicc')
        <input type="text" name="Empresa" value="{{Auth()->user()->Empresa}}" hidden>
        @else
        <div class="form-outline mb-3">
            <input type="text" name="Empresa" value="" class="form-control form-control-lg" placeholder="Coloque o nome da Empresa">
            <label class="form-label" for="Empresa">Empresa</label>
        </div>
        @endif
        
        <div class="d-flex flex-wrap justify-content-center m-3">

            <div class="col">
                <button type="submit" id="carregar" class="btn btn-primary m-1 w-100">Abrir chamado</button>
            </div>

            <div class="col">
                <button type="reset" id="carregar" class="btn btn-danger m-1 w-100">Limpar Formulário</button>
            </div>
            
        </div>
        
    </form>
</div>
@if($chamado != null)
<table id="chamados" class="display" style="width:100%;">
    <thead>
        <tr>
            <th></th>
            <th>Nome</th>
            <th>Grau</th>
            <th>Setor</th>
            <th>Objeto</th>
        </tr>
    </thead>
    @foreach($chamado as $ch)
            <tr id="{{$ch->ID}}" style="cursor:pointer;" onclick="abrirPag(`{{route('chamado',['ID' => $ch->ID])}}`)">
                <td style="text-align:center;width:20px;">
                    <p hidden>{{ $ch->Processo }}</p>
                    <p hidden>{{ $ch->created_at }}</p>
                    @if($ch->Processo == 0)
                    <span class="fa fa-circle" style="color:rgb(255, 74, 74);"></span>
                    @elseif($ch->Processo == 1)
                    <span class="fa fa-circle" style="color:rgb(70, 104, 255);"></span>
                    @elseif($ch->Processo == 2)
                    <span class="fa fa-circle" style="color:rgb(115, 255, 87);"></span>
                    @else
                    <span class="fa fa-circle" style="color:rgb(90, 90, 90);"></span>
                    @endif
                </td>
            
                <td style='text-transform:uppercase;'>{{$ch->Nome}}</td>

                <td>
                    @if($ch->Grau == 1)
                    Baixo
                    @elseif($ch->Grau == 2)
                    Médio
                    @else
                    Alto
                    @endif
                </td>

                <td>{{$ch->Setor->Nome}}</td>
                
                <td>@if($ch->Objeto->ID == 424 || $ch->Objeto->Nome == 'Objetos apresentam QR code') <strong>Não</strong> identificado @else {{ $ch->Objeto->Nome }}@endif</td>
            </tr>
    @endforeach
</table>
@endif
<script>
    $(document).ready( function () {
        let id = $(this).attr('id');
        
        @if($chamado != null)
        $(`#chamados`).DataTable(settings2);
        @endif
        
        $(`#informacao`).DataTable(settings2);
        $('#carregando').hide();
    });
    
    $('tr#sel').on('click', function(event) {
        const Objeto = $(this).children().first().text().trim();
        const Nome = $(this).children().eq(1).text().trim();
        const Setor = $(this).children().last().attr('class').split(" ")[0].trim();
        $('#Value').val(Objeto);
        $('#ObjetoNome').val(Nome);
        $('#Setor').val(Setor);
    });
</script>
<script>
    $('#carregar').on('click', function(event) {
        if($('#Nome').val() != ""){
            $('#carregando').addClass('d-flex');    
        }
    });
</script>

@endif
@endsection

