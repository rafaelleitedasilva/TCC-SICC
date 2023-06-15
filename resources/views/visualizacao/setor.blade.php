@extends('template.principal')
@section('content')
@foreach($setores as $setor)

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Atualização de Setor</h2>
    </div>
</div>

@if(Auth::user()->Empresa == $setor->Empresa || Auth::user()->Empresa == 'Administrador Sicc')
<section>
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col mt-3">
                <form action="{{route('update_setores', ['ID' => $setor->ID])}}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    
                    <!-- Nome input -->
                    <div class="form-outline mb-3">
                        <input type="text" id="nome" name="nome" value="{{$setor->Nome}}"  class="form-control form-control-lg"
                        />
                        <label class="form-label" for="nome">Nome</label>
                    </div>


                    <div class="mb-4">
                        <h3 class="text-start"> Gestor </h3>
                        <div class="form-outline d-flex">
                            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#Gestor">
                                Gestor    
                            </button>
                            <div id="gestor-123" class="itens w-100">
                                <input type="text" name="GestorID" id="Value" value='{{ $setor->Gestor->ID }}'  style="cursor:pointer;display:none;" class="form-control ml-5 item-item w-50" readonly>
                                <input type="text" id="Value" value='{{ $setor->Gestor->Nome }}'  style="cursor:pointer;" class="form-control ml-5 item-item w-50" readonly>
                            </div>
                            <div class="modal inmodal fade" id="Gestor" tabindex="-1" role="dialog" style="display: none;">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Usuários</h4>
                                        </div>
                                        <div class="modal-body">
                                            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css"/>
                                            <table id="informacao" class="display" style="width:100%;">
                                                <thead>
                                                    <th>ID</th>
                                                    <th>Nome</th>
                                                    <th>Email</th>
                                                </thead>
                                                    @foreach ($user as $u)
                                                    <tr id="sel">
                                                            <td>{{ $u->ID }}</td>
                                                            <td>{{ $u->Nome }}</td>
                                                            <td>{{ $u->email }}</td>
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
                                                    
                                                    $('tr#sel').on('click', function(event) {
                                                        const id = $(this).children().first().text().trim();
                                                        const nome = $(this).children().eq(1).text().trim();

                                                        $('#gestor-123').html(`<input type="text" name="GestorID" value='${id}' onclick='removerItem("Value${$('#item-123').length}")' style="cursor:pointer;display:none;" class="form-control ml-5 item-item w-25" readonly>
                                                        <input type="text" value='${nome}' onclick='removerItem("Value${$('#item-123').length}")' style="cursor:pointer;" class="form-control ml-5 item-item w-25" disabled/>`);

                                                    });
                                                    
                                                });

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
                    

                    @if(Auth()->user()->Empresa != 'Administrador Sicc')
                    <input type="text" name="Empresa" value="{{Auth()->user()->Empresa}}" hidden>
                    @else
                    <div class="form-outline mb-3">
                        <input type="text" name="Empresa" class="form-control form-control-lg" value="{{$setor->Empresa}}" placeholder="Coloque o nome da Empresa">
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