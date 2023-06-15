@extends('template.principal')
@section('content')

<h1 class="display" style="font-family: Georgia, serif"><strong>Chamados</strong></h1>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css"/>

<table id="chamados" class="display" style="width:100%;">
    <thead>
        <tr>
            <th width='10px;'></th>
            <th>Nome</th>
            <th>Grau</th>
            <th>Setor</th>
            <th>Solicitante</th>
            <th>Descrição</th>
        </tr>
    </thead>
    <tbody>
        
    </tbody>
</table>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $(function () {
        var table = $('#chamados').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('chamado_json') }}",
                type: "GET",
                data: function (d) {
                    d._token = $('meta[name="csrf-token"]').attr('content');
                }
            },
            columns: [
            {data:'Processo', name:''},
            {data: 'Nome', name: 'Nome'},
            {data: 'Grau', name: 'Grau'},
            {data:'SetorID', name:'Setor'},
            {data:'Solicitante', name:'Solicitante'},
            {data:'Descricao', name:'Descrição'}
            ],
            select: {
                style: 'single',
            },
            createdRow: function(row, data, dataIndex) {
                $(row).attr('onclick', 'window.location.href="' + data.link + '";');
                $(row).css('cursor', 'pointer');
            },
            language: {
                sEmptyTable: "Nenhum registro encontrado",
                sInfo: "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                sInfoEmpty: "Mostrando 0 até 0 de 0 registros",
                sInfoFiltered: "(Filtrados de _MAX_ registros)",
                sInfoPostFix: "",
                sInfoThousands: ".",
                sLengthMenu: "_MENU_ resultados por página",
                sLoadingRecords: "Carregando...",
                sProcessing: "",
                sSearch: "Pesquisar",
                sZeroRecords: "Nenhum registro encontrado",
                oPaginate: {
                    sNext: "Próximo",
                    sPrevious: "Anterior",
                    sFirst: "Primeiro",
                    sLast: "Último"
                },
                oAria: {
                    sSortAscending: ": Ordenar colunas de forma ascendente",
                    sSortDescending: ": Ordenar colunas de forma descendente"
                },
                select: {
                    rows: {
                        _: "%d linhas selecionadas",
                        0: "Nenhuma linha selecionada",
                        1: "1 linha selecionada"
                    }
                },
                buttons: {
                    copy: "Copiar",
                    colvis: "Colunas",
                    collection: "Coleção",
                    info: "Info",
                    print: "Imprimir",
                    pdf: "PDF",
                    excel: "Excel"
                }
            },
            dom: 'lBfrtip',
            buttons: ['colvis', {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':visible'
                },
                customize: function(doc) {
                    doc.pageMargins = [ 10,10, 10, 10, 10 ]
                    doc.defaultStyle.alignment = 'center';
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            }
            
            ]
        });
    });
</script>
@endsection