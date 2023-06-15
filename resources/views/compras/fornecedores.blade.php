@extends('template.principal')
@section('content')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css"/>

<div class="container">
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-bordered fornecedores">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Serviço</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
</body>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $(function () {
        var table = $('.fornecedores').DataTable({
            lengthMenu: [
            [5, 10, 15, -1],
            [5, 10, 15, 'All'],
            ],
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('fornecedores_json') }}",
                type: "GET",
                data: function (d) {
                    d._token = $('meta[name="csrf-token"]').attr('content');
                }
            },
            columns: [
            {data: 'Nome', name: 'Nome'},
            {data: 'Email', name: 'Email'},
            {data: 'Servico', name: 'Servico'},
            {data: 'action', name: 'Ações', orderable: false, searchable: false},
            ],
            select: {
                style: 'single',
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
                sProcessing: "Processando...",
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
            buttons: ['colvis',{
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':visible'
                },
                customize: function(doc) {
                    doc.pageMargins = [ 10, 10, 10, 10 ]
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
        
        ]});
    });
</script>
@endsection