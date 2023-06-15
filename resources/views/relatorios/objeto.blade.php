@extends('template.principal')
@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>

<div class="d-flex justify-content-between p-2 flex-wrap">
    <h1 class="text-center">Relatório de Objeto</h1>
    
    <div class="d-flex justify-content-around">
        <button type="button" class="btn btn-dark m-1" data-toggle="modal" data-target="#Objeto">
            Objeto
        </button>
        <input type="text" name="Objeto" id="Value" class="form-control" style="width: 200px;" hidden>
    </div>
</div>

<div class="modal inmodal fade" id="Objeto" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Objeto</h4>
            </div>
            
            <div class="modal-body">
                <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css"/>
                <table id="informacao" class="display w-100" style="width:100%;">
                    <thead class="w-100">
                        <tr class="w-100">
                            <th class="w-25">ID</th>
                            <th class="w-25">Nome</th>
                            <th class="w-50">Setor</th>
                        </tr>
                    </thead>
                    @foreach($objeto as $obj)
                    <tr id="sel">
                        <td id="ID" data-dismiss="modal" >
                            {{ $obj->ID }}
                        </td>
                        <td id="Objeto" data-dismiss="modal" >
                            {{ $obj->Nome }}
                        </td>
                        <td id="Objeto" data-dismiss="modal">
                            {{ $obj->Setor->Nome }}
                        </td>
                    </tr>
                    @endforeach
                </table>
                <style>
                    #sel:hover{
                        cursor: pointer;
                    }
                </style>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>


<img style="max-width:500px;" class="w-100 d-block m-auto" src="{{asset('img/qw.png')}}" id="graf" alt="Gráfico Ilustrativo">

<div id='chart-master'>
    <canvas id="myChart"></canvas>
</div>
<hr>


<hr class="m-3">

<div id="tabela">
    
</div>

<div class='d-flex'>
    <div id='chart-master1' class='w-50'>
        
    </div>
    
    <div id='chart-master2' class='w-50'>
        
    </div>
</div>


<script src="https://cdnjs.com/libraries/Chart.js"></script>



<script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    function abrirPag(href){
        window.location.href = `/chamado/${href}`
    }
    
    $(document).ready( function () {
        $('#chamados').hide();
        $('#tbody-chamados').html('');
        let id = $(this).attr('id');
        $(`#informacao`).DataTable(settings2);
    });
    
    $('tr#sel').on('click', function(event) {
        const Objeto = $(this).children().first().text().trim();
        const Setor = $(this).children().last().text().trim();
        
        $('#Value').val(Objeto);
        $('#Setor').val(Setor);
        $('#Setor').attr('readonly', true);
        $('#graf').remove();
        $('#chart-master').html('<canvas id="myChart"></canvas>');
        $('#chart-master1').html('<h1 id="titulo1" class="display text-center"></h1><canvas id="myChart1"></canvas>');
        $('#chart-master2').html('<h1 id="titulo2" class="display text-center"></h1><canvas id="myChart2"></canvas>');
        
        $.ajax({
            url:"{{ route('objeto_dados') }}",
            type: "GET",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'objeto': $('#Value').val(),
                'empresa': "{{Auth::user()->Empresa}}"
            },
            dataType: 'json',
            success: function(response){
                $('#tabela').html(`<table id="chamados" class="display" style="width:100%;">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nome</th>
                            <th>Solicitante</th>
                            <th>Item</th>
                            <th>Descrição</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-chamados">
                        
                    </tbody>
                </table>`);
                
                for(var i = 0; i < response[1].length; i++){
                    let processo = '';
                    let descricao = 'Nenhuma descrição encontrada!';
                    let item = 'Nenhum item utilizado!'
                    
                    if(response[1][i].Processo == 0){
                        processo = '<span class="fa fa-circle" style="color:rgb(255, 74, 74);"></span>';
                    }
                    else if(response[1][i].Processo == 1){
                        processo = '<span class="fa fa-circle" style="color:rgb(70, 104, 255);"></span>';
                    }
                    else if(response[1][i].Processo == 2){
                        processo = '<span class="fa fa-circle" style="color:rgb(115, 255, 87);"></span>'
                    }
                    else{
                        processo = '<span class="fa fa-circle" style="color:rgb(90, 90, 90);"></span>';
                    }
                    
                    if(response[1][i].Descricao != null){descricao = response[1][i].Descricao};
                    if(response[1][i].Itens != null){item = response[1][i].Itens};
                    
                    $('#tbody-chamados').append(`
                    <tr onclick="abrirPag('${response[1][i].ID}')">
                        <td>${processo}</td>
                        <td>${response[1][i].Nome}</td>
                        <td>${response[1][i].Solicitante}</td>
                        <td>${item}</td>
                        <td>${descricao}</td>
                    </tr>`);
                }
                
                $('#chamados').DataTable(settings)
                
                const ctx = document.getElementById('myChart');
                
                let labels = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro','Outubro', 'Novembro', 'Dezembro'];                    
                
                
                const data = {
                    labels: labels,
                    datasets: [{
                        label: 'Número de Chamados',
                        data: response[0],
                        backgroundColor:'transparent',
                        borderColor: '#2F4050',
                        borderWidth: 2
                    }]
                };
                
                const config = {
                    type: 'line',
                    data: data,
                    options: {
                        elements: {
                            line: {
                                tension: 0.1
                            }
                        },
                        legend: {
                            display: false
                        },
                        scales: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    },
                };
                
                new Chart(ctx,  config);
                
                const ctx1 = document.getElementById('myChart1');  
                
                let array = response.map(function(obj) {
                    return Object.keys(obj).map(function(chave) {
                        return obj[chave];
                    });
                });
                const data1 = {
                    labels: [ 'Pendente', 'Em Andamento','Concluído', 'Cancelado'],
                    datasets: [{
                        data: array[2],
                        backgroundColor:['rgb(255, 74, 74)','rgb(70, 104, 255)','rgb(115, 255, 87)','rgb(90, 90, 90)'],
                        borderColor: 'transparent',
                        borderWidth: 2,
                        hidden: false
                    }]
                };
                
                const config1 = {
                    type: 'doughnut',
                    data: data1,
                };
                
                new Chart(ctx1,  config1);
                //--------------------------------------------------------------------
                const ctx2 = document.getElementById('myChart2');  
                let array1 = response[1].map(function(obj) {
                    return obj.Grau
                });
                let dataDonut = [0,0,0];
                for(let i = 0; i < array1.length; i++){
                    if(array1[i] == '3'){
                        dataDonut[0] += 1
                    }else if (array1[i] == '2'){
                        dataDonut[1] += 1
                    }else{
                        dataDonut[2] += 1
                    }
                }
                const data2 = {
                    labels: [ 'Alto', 'Médio','Baixo'],
                    datasets: [{
                        data: dataDonut,
                        backgroundColor:['rgb(255, 74, 74)','rgb(70, 104, 255)','rgb(115, 255, 87)'],
                        borderColor: 'transparent',
                        borderWidth: 2,
                        hidden: false
                    }]
                };
                
                const config2 = {
                    type: 'doughnut',
                    data: data2,
                };
                
                new Chart(ctx2,  config2);
                $('#titulo2').text('Grau');
                $('#titulo1').text('Processo');
            }
        });
    });
</script>
@endsection