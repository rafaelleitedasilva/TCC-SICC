@extends('template.principal')
@section('content')
@if(Auth::check())
<div class="row">
    @foreach($chamado as $ch)
    <div class="col w-100">
        <div class="ibox">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 style='text-transform:uppercase;font-size: 30px;'><strong>{{$ch->Nome}}</strong></h2>
                            @if(auth()->user()->acesso == 'Manutenção')
                            @if($ch->Processo == 0 || $ch->Processo == 1)
                            <select class="btn btn-secondary h-25 text-left" id="processo">
                                @if($ch->Processo == 0)
                                <option value="">Aberto</option>
                                <option value="1" id="1-processo">Atender</option>
                                <option value="2" id="2-fechar">Fechar</option>
                                <option value="3" id="3-cancelar">Cancelar</option>
                                @elseif($ch->Processo == 1)
                                <option value="1" id="1-processo">Atendendo</option>
                                <option value="2" id="2-fechar">Fechar</option>
                                <option value="3" id="3-cancelar">Cancelar</option>
                                @elseif($ch->Processo == 2)
                                <option value="2" id="2-fechar">Concluído</option>
                                @elseif($ch->Processo == 3)
                                <option value="3" id="3-cancelar">Cancelado</option>
                                @endif
                            </select>
                            @endif
                            @endif
                        </div>
                    </div>
                </div>

                <div class="d-flex">
                    <p style='font-size: 20px;'>{{$ch->Descricao}}</p>
                </div>
                <hr style="border: 2px solid black;">
                <div class="row">
                    <div class="col">
                        <dl class="row mb-0">
                            <div class="col text-sm-right"><dt>Status:</dt> </div>
                            <div class="col text-sm-left"><dd class="mb-1">@if($ch->Processo == 0)<span class="label label-danger" id="process">Pendente</span>@elseif($ch->Processo == 1)<span class="label label-warning"  id="process">Em Atendimento</span>@elseif($ch->Processo == 3)<span class="label label-dark"  id="process">Cancelado</span> @else <span class="label label-primary"  id="process">Concluído</span> @endif</dd></div>
                        </dl>
                        <dl class="row mb-0">
                            <div class="col text-sm-right"><dt>Setor:</dt> </div>
                            <div class="col text-sm-left"><dd class="mb-1">{{$ch->Setor->Nome}}</dd> </div>
                        </dl>
                        <dl class="row mb-0">
                            <div class="col text-sm-right"><dt>Solicitante:</dt> </div>
                            <div class="col text-sm-left"> <dd class="mb-1">{{$ch->Solicitante}}</dd></div>
                        </dl>
                    </div>
                    <div class="col">
                        <dl class="row mb-0">
                            <div class="col text-sm-right">
                                <dt>Grau:</dt>
                            </div>
                            <div class="col text-sm-left"><dd class="mb-1">@if($ch->Grau == 3)<span class="label label-danger">Alto</span>@elseif($ch->Grau == 2)<span class="label label-warning">Médio</span> @else <span class="label label-primary">Baixo</span> @endif</dd></div>
                        </dl>
                        <dl class="row mb-0">
                            <div class="col text-sm-right">
                                <dt>Objeto:</dt>
                            </div>
                            <div class="col text-sm-left">
                                <dd class="mb-1">{{$ch->Objeto->Nome}}</dd>
                            </div>
                        </dl>
                        <dl class="row mb-0">
                            <div class="col text-sm-right">
                                <dt>Data de Abertura:</dt>
                            </div>
                            <div class="col text-sm-left">
                                <dd class="mb-1">{{$ch->created_at->format('d/m/Y H:i:s')}}</dd>
                            </div>
                        </dl>
                    </div>
                    <div class="col">
                        <h3 class="text-start"> Item </h3>
                        <div class="form-outline d-flex">
                            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#Item" @if($ch->Processo == 3 || $ch->Processo == 2) disabled @endif>
                                Item    
                            </button>
                            <div id="item-123" class="itens">
                                @php 
                                $num = 1; 
                                $itenns = explode(';',$ch->Itens);
                                array_pop($itenns);
                                $stringItens = '';
                                @endphp
                                @foreach ($itenns as $i)
                                <input type="text" name="Item" id="Value{{ $num }}" value='{{ $i }}'  style="cursor:pointer;" class="form-control ml-3 item-item" readonly @if($ch->Processo == 0 || $ch->Processo == 1) onclick='removerItem("Value{{ $num }}")' @endif >
                                @php $num = $num + 1; @endphp
                                @endforeach
                            </div>
                            <div class="modal inmodal fade" id="Item" tabindex="-1" role="dialog" style="display: none;">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Itens</h4>
                                        </div>
                                        <div class="modal-body">
                                            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css"/>
                                            <table id="informacao" class="display" style="width:100%;">
                                                <thead>
                                                    <th>Nome</th>
                                                    <th class="w-100">Descrição</th>
                                                </thead>
                                                @foreach ($item as $i)
                                                <tr id="sel">
                                                    <td>{{ $i->Nome }}</td>
                                                    <td>{{ $i->Descricao }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                            <style>
                                                #sel:hover{
                                                    cursor: pointer;
                                                }
                                            </style>
                                            <script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
                                            <script>
                                                $(document).ready( function () {
                                                    let id = $(this).attr('id');
                                                    $(`#informacao`).DataTable(settings2);
                                                });
                                                
                                                $('tr#sel').on('click', function(event) {
                                                    const Item = $(this).children().first().text().trim()
                                                    const Setor = $(this).children().last().text().trim()
                                                    
                                                    $('#item-123').append(`<input type="text" name="Item" id="Value${$('#item-123').length}" value='${Item}' onclick='removerItem("Value${$('#item-123').length}")' style="cursor:pointer;" class="form-control ml-3 item-item" readonly>`)
                                                    let itens = document.getElementsByName('Item');
                                                    let text = '';
                                                    for(let i = 0; i < itens.length; i++){
                                                        text += `${itens[i].value};`;
                                                    }
                                                    
                                                    $.ajax({
                                                        url:"{{ route('alterar_item') }}",
                                                        type: "POST",
                                                        data: {
                                                            '_token': $('meta[name="csrf-token"]').attr('content'),
                                                            'itens': text,
                                                            'ID': {{$ch->ID}},
                                                        },
                                                        dataType: 'json',
                                                        success: function(response){
                                                            
                                                        }
                                                    });
                                                });
                                                
                                                function removerItem(id){
                                                    $(`#${id}`).remove()
                                                    
                                                    let itens = document.getElementsByName('Item');
                                                    let text = '';
                                                    
                                                    for(let i = 0; i < itens.length; i++){
                                                        text += `${itens[i].value};`;
                                                    }
                                                    
                                                    $.ajax({
                                                        url:"{{ route('alterar_item') }}",
                                                        type: "POST",
                                                        data: {
                                                            '_token': $('meta[name="csrf-token"]').attr('content'),
                                                            'itens': text,
                                                            'ID': {{$ch->ID}},
                                                        },
                                                        dataType: 'json',
                                                        success: function(response){
                                                            
                                                        }
                                                    });
                                                }
                                            </script>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row m-t-sm">
                    <div class="col-lg-12">
                        <div class="panel blank-panel">
                            <div class="panel-heading">
                                <div class="panel-options">
                                    <ul class="nav nav-tabs">
                                        <li><a class="nav-link active show" href="#tab-1" data-toggle="tab">Atualizações</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane active show" id="tab-1">
                                        <div class="feed-activity-list">
                                            @foreach($comentarios as $comentario)
                                            <div class="feed-element">
                                                <div class="media-body d-flex">
                                                    <div class="w-100 d-flex align-items-center flex-wrap">
                                                        <p class="w-100 m-0" style="font-size: 19px;"><strong>{{$comentario->Usuario->Nome}}</strong></p>
                                                        <div class="d-flex w-100 justify-content-between align-items-center flex-wrap">
                                                            <p class="text-muted m-0" style="font-size: 16px;">{{$comentario->Comentario}}</p>
                                                            <small>{{$comentario->created_at->format('d/m/Y H:i:s')}}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            
                                        </div>
                                        @if($ch->Processo == 0 || $ch->Processo == 1)
                                        <form method="POST" action="{{route('comentario')}}">
                                            <div class="input-group"><input type="text" name="Comentario" class="form-control" placeholder="..." required> <span class="input-group-append"> <button type="submit" class="btn btn-primary"> Enviar
                                            </button></span></div>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                            <input type="text" name="idChamado" value="{{$ch->ID}}" hidden>
                                            <input type="text" name="Empresa" value="{{Auth::user()->Empresa}}" hidden>
                                        </form>
                                        @endif
                                    </div>
                                    <div class="feed-element">
                                        <div class="media-body ">
                                            <h3 class="text-center"><strong>{{$ch->Solicitante}}</strong></h3><br>
                                            <h4 class="text-center">Chamado <strong>{{$ch->Nome}}</strong> aberto em {{$ch->created_at->format('d/m/Y H:i:s')}}.</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $(function(){
        $('#processo').change(function(event){ 
            event.preventDefault();
            var value = $(this).val();
            $('#processo').attr('disabled', true)
            $('#processo').removeClass();
            if(value==1){
                $('#processo').addClass('btn btn-primary text-left');
                $('#1-processo').html('Atendendo');
                $('#process').removeClass()
                $('#process').addClass('label label-warning')
                $('#process').html('Em atendimento')
            }else if(value==2){
                $('#processo').addClass('btn btn-primary text-left');
                $('#2-fechar').html('Concluído');
                $('#process').removeClass()
                $('#process').addClass('label label-primary')
                $('#process').html('Concluído')
            }else{
                $('#processo').addClass('btn btn-dark color-white text-left');
                $('#3-cancelar').html('Cancelado');
                $('#process').removeClass()
                $('#process').addClass('label label-dark')
                $('#process').html('Cancelado')
            }    
            
            let array = [];
            
            for(let i = 0; i<document.getElementsByName('Item').length; i++){
                array.push(document.getElementsByName('Item')[i].value)
            }
            
            
            $.ajax({
                url:"{{ route('alterar_processo') }}",
                type: "POST",
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'processo': value,
                    'itens': array,
                    'ID': {{$ch->ID}},
                    'Setor': {{ $ch->Setor->ID }},
                },
                dataType: 'json',
                success: function(response){
                    
                }
            });
        })
    })
</script>
@endforeach
@endif
@endsection
