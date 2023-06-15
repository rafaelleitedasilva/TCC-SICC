<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content='Rafael Leite da Silva'>
    <title>SICC</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="shortcut icon" href="{{ asset('img/favicon.png')}}" type="image/x-icon">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"> 
    
    <!-- Toastr style -->
    <link href="{{ asset('css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
    <!-- Datatable css -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css"/>
    
    <link href="{{ asset('lightbox/css/lightbox.css') }}" rel="stylesheet" />
</head>
<body>
    <div id="carregando" style="width:100vw;height:100vh;position:fixed;display:flex;align-items:center;justify-content:center;background-color:white;z-index:8000;display:none;">
        <div class="w-50 h-50">
            <img src="https://gifs.eco.br/wp-content/uploads/2022/09/gifs-de-engrenagem-0.gif" class="d-block m-auto w-100" style="max-width: 300px;" alt="Engrenagem Girando">
            <h1 style="font-family: Cambria;text-align:center;"> Chamado sendo criado... </h1>
        </div>
    </div>
    
    @if(Session::has('message'))
    <div class="alert {{ Session::get('alert-class') }} alert-success alert-dismissible fade show position-fixed" style="z-index:3000;top:50px;right:5px;" role="alert">
        <h4><strong>{{ Session::get('title') }}</strong></h4>
        <p>{{ Session::get('message') }}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show position-fixed" style="z-index:3000;top:50px;right:5px;" role="alert">
        <h4>Erro de Autenticação!</h4>
        @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    <div id="wrapper">
        @include("template.menu")
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                        <form role="search" class="navbar-form-custom" action="search_results.html">
                            <div class="form-group">
                                <input type="text" class="form-control" name="top-search" id="top-search">
                            </div>
                        </form>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message">Bem vindo ao <strong>Sistema Interno de Chamado e Compras</strong>!</span>
                        </li>
                        <li>
                            <a href="{{route('logout')}}" class="pr-3">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight pr-0 pl-0 pt-0">
                @yield('content')
            </div>            
        </div>
    </div>
</body>

<script src="{{ asset('lightbox/js/lightbox.js') }}"></script>

<!-- Datatable js -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.colVis.min.js"></script>

<!-- Mainly scripts -->
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('js/inspinia.js') }}"></script>
<script src="{{ asset('js/plugins/pace/pace.min.js') }}"></script>

<!-- Diff march patch -->
<script src="{{ asset('js/plugins/diff_match_patch/javascript/diff_match_patch.js') }}"></script>

<!-- jQuery pretty text diff -->
<script src="{{ asset('js/plugins/preetyTextDiff/jquery.pretty-text-diff.min.js') }}"></script>

<script>
    $('#carregando').hide();
    
    function detectar_mobile() {
        var check = false; //wrapper no check
        (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = true})(navigator.userAgent||navigator.vendor||window.opera);
        return check;
    }
    
    if(detectar_mobile() == true){
        $('#relatorios_menu').hide();
    }
    
    var settings = 
    {
        scrollX: true,
        "columnDefs": [
        {
            "targets": [ -1 ],
            "visible": false,
            "searchable": false
        }
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
                colvis: "Excluir",
                collection: "Coleção",
                info: "Info",
                print: "Imprimir",
                pdf: "PDF",
                excel: "Excel"
            }
        },
        dom: 'Bfrtip',
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
        
        ]
    }   
    
    var settings1 = 
    {
        scrollX: true,
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
        dom: 'Bfrtip',
        buttons: [{
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
        
        ]
    } 
    
    var settings2 = 
    {
        lengthMenu: [
        [5, 10, 15, -1],
        [5, 10, 15, 'All'],
        ],
        scrollX: true,
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
            }
        }
    }   
    
    var settingsPaginate = 
    {
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('fornecedores_json') }}",
        "columns": [
        { "data": "Nome", "name": "Nome" },
        { "data": "Email", "name": "Email" },
        { "data": "Telefone", "name": "Telefone" },
        { "data": "Servico", "name": "Serviço" },
        { "data": "Local", "name": "Localidade" },
        { "data": "Descricao", "name": "Descrição" },
        ],
        scrollX: true,
        "columnDefs": [
        {
            "targets": [ -1 ],
            "visible": false,
            "searchable": false
        }
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
                colvis: "Excluir",
                collection: "Coleção",
                info: "Info",
                print: "Imprimir",
                pdf: "PDF",
                excel: "Excel"
            }
        },
        dom: 'Bfrtip',
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
        
        ] 
    }
</script>
</html>
