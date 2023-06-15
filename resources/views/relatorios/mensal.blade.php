@extends('template.principal')
@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>

<div class="d-flex justify-content-between p-2">
    <h1 class="text-center">Relatório Mensal <span class="mes-selecionado"></span></h1>
    
    <div>
        <select class="btn btn-secondary m-3 text-left pr-2" style="font-size: 15px;" name="mes" id="mes" disabled>
            <option value="">Selecione um mês</option>
            <option value="01">Janeiro</option>
            <option value="02">Fevereiro</option>
            <option value="03">Março</option>
            <option value="04">Abril</option>
            <option value="05">Maio</option>
            <option value="06">Junho</option>
            <option value="07">Julho</option>
            <option value="08">Agosto</option>
            <option value="09">Setembro</option>
            <option value="10">Outubro</option>
            <option value="11">Novembro</option>
            <option value="12">Dezembro</option>
        </select>
        <select name="ano" id="ano" class="btn btn-secondary m-3 text-left pr-2" style="font-size: 15px;">
            
        </select>
    </div>
    
    <script>
        $.ajax({
            url:"{{ route('ano_mensal_dados') }}",
            type: "GET",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
            },
            dataType: 'json',
            success: function(response){
                var selectAno = document.getElementById('ano')
                $.each(response, function(index, value){
                    let option = document.createElement("option");
                    
                    option.value = value;
                    option.textContent = value;
                    
                    selectAno.appendChild(option);
                });
            }
        });
    </script>
</div>

<img style="max-width:500px;" class="w-100 d-block m-auto" src="{{asset('img/qw.png')}}" id="graf" alt="Encolher Ombros">

<div id='chart-master'>
    <canvas id="myChart"></canvas>
</div>

<hr class="m-3">

<div id="tabela">
    
</div>

<div class="d-flex">
    <div id='chart-master1' class='w-50'>
        
    </div>
    
    <div id='chart-master2' class='w-50'>
        
    </div>
</div>

<script src="https://cdnjs.com/libraries/Chart.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    function abrirPag(href){
        window.location.href = href
    }
    
    $(document).ready( function () {
        $('#mes').attr('disabled',false);
        $('#mes').change(function(){
            
            $('#graf').remove();
            $('#myChart').remove();
            $('#chart-master').html('<canvas id="myChart"></canvas>');
            $('#chart-master1').html('<h1 id="titulo1" class="display text-center"></h1><canvas id="myChart1"></canvas>');
            $('#chart-master2').html('<h1 id="titulo2" class="display text-center"></h1><canvas id="myChart2"></canvas>');
            $('.mes-selecionado').html(`de ${$('#mes option:selected').text()}`);
            
            $.ajax({
                url:"{{ route('mes_dados') }}",
                type: "GET",
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'mes': $(this).val(),
                    'ano': $('#ano').val(),
                    'Empresa':'{{ Auth::user()->Empresa }}'
                },
                dataType: 'json',
                success: function(response){
                    
                    const ctx = document.getElementById('myChart');
                    
                    let labels = ['Dia 1','Dia 2', 'Dia 3' ,'Dia 4' ,'Dia 5' ,'Dia 6' ,'Dia 7','Dia 8','Dia 9','Dia 10','Dia 11','Dia 12','Dia 13','Dia 14','Dia 15','Dia 16','Dia 17' ,'Dia 18' ,'Dia 19' ,'Dia 20' ,'Dia 21' ,'Dia 22' ,'Dia 23','Dia 24','Dia 25','Dia 26','Dia 27','Dia 28','Dia 29','Dia 30','Dia 31'];
                    
                    var columnsToRemove = [];
                    response.forEach(function(value,index) {
                        if (value === 0) {
                            columnsToRemove.push(0);
                        }else{
                            columnsToRemove.push(1);
                        }
                    });
                    
                    // Remova as colunas identificadas do gráfico
                    for (var i = columnsToRemove.length - 1; i >= 0; i--) {
                        if (columnsToRemove[i] === 0) {
                            labels.splice(i, 1);
                            response.splice(i,1);
                        }
                    }
                    
                    
                    const data = {
                        labels: labels,
                        datasets: [{
                            label: 'Número de Chamados',
                            data: response,
                            backgroundColor:'#2F4050',
                            borderColor: '#2F4050',
                            borderWidth: 2
                        }]
                    };
                    
                    const config = {
                        type: 'bar',
                        data: data,
                        options: {
                            scales: {
                                yAxes: [{
                                    display: true,
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            },
                            elements: {
                                line: {
                                    tension: 0
                                }
                            },
                            legend: {
                                display: false
                            },
                            tooltips: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return tooltipItem.yLabel;
                                    }
                                }
                            }
                        },
                    };
                    
                    new Chart(ctx,  config);
                }
            });
            
            $.ajax({
                url:"{{ route('mes_dados_tabela') }}",
                type: "GET",
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'mes': $('#mes').val(),
                    'ano': $('#ano').val()
                },
                dataType: 'json',
                success: function(response){
                    $('#tabela').html(`<table id="chamados" class="display" style="width:100%;">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nome</th>
                                <th>Grau</th>
                                <th>Solicitante</th>
                                <th>Descrição</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-chamados">
                            
                        </tbody>
                    </table>`);
                    
                    for(var i = 0; i < response.length; i++){
                        let processo = '';
                        let descricao = 'Nenhuma descrição encontrada!';
                        let grau = ''
                        
                        if(response[i].Processo == 0){
                            processo = '<span class="fa fa-circle" style="color:rgb(255, 74, 74);"></span>';
                        }
                        else if(response[i].Processo == 1){
                            processo = '<span class="fa fa-circle" style="color:rgb(70, 104, 255);"></span>';
                        }
                        else if(response[i].Processo == 2){
                            processo = '<span class="fa fa-circle" style="color:rgb(115, 255, 87);"></span>'
                        }
                        else{
                            processo = '<span class="fa fa-circle" style="color:rgb(90, 90, 90);"></span>';
                        }
                        
                        if(response[i].Grau == 3){
                            grau = '<span style="color:rgb(255, 74, 74);"> Alto </span>';
                        }
                        else if(response[i].Grau == 2){
                            grau = '<span style="color:rgb(70, 104, 255);">Médio</span>';
                        }
                        else {
                            grau = '<span style="color:rgb(115, 255, 87);">Baixo</span>'
                        }
                        
                        
                        if(response[i].Descricao != null){descricao = response[i].Descricao};
                        if(response[i].Itens != null){item = response[i].Itens};
                        
                        $('#tbody-chamados').append(`
                        <tr onclick="abrirPag('../chamado/${response[i].ID}')">
                            <td><p hidden>${response[i].Processo}</p><p hidden>${response[i].created_at}</p>${processo}</td>
                            <td>${response[i].Nome}</td>
                            <td>${grau}</td>
                            <td>${response[i].Solicitante}</td>
                            <td>${descricao}</td>
                        </tr>`);
                    }
                    
                    $('#chamados').DataTable(settings)
                    
                    //-------------------------------------------------------------------------------
                    
                    const ctx1 = document.getElementById('myChart1');  
                    
                    let array = response.map(function(obj) {
                        return obj.Grau
                    });
                    
                    let dataDonut = [0,0,0];
                    
                    for(let i = 0; i < array.length; i++){
                        if(array[i] == 3){
                            dataDonut[0] += 1
                        }else if (array[i] == 2){
                            dataDonut[1] += 1
                        }else{
                            dataDonut[2] += 1
                        }
                    }
                    
                    const data1 = {
                        labels: [ 'Alto', 'Médio','Baixo'],
                        datasets: [{
                            data: dataDonut,
                            backgroundColor:['rgb(255, 74, 74)','rgb(70, 104, 255)','rgb(115, 255, 87)'],
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
                    
                    //---------------------------------------------------------------------------
                    
                    const ctx2 = document.getElementById('myChart2');  
                    
                    
                    
                    let array2 = response.map(function(obj) {
                        return obj.Processo
                    });
                    
                    let dataDonut2 = [0,0,0,0];
                    
                    for(let i = 0; i < array2.length; i++){
                        if(array2[i] == 3){
                            dataDonut2[3] += 1
                        }else if (array2[i] == 2){
                            dataDonut2[2] += 1
                        }else if(array2[i] == 1){
                            dataDonut2[1] += 1
                        }else{
                            dataDonut2[0] += 1
                        }
                    }
                    
                    const data2 = {
                        labels: [ 'Pendente','Concluído', 'Em Andamento', 'Cancelado'],
                        datasets: [{
                            data: dataDonut2,
                            backgroundColor:['rgb(255, 74, 74)','rgb(70, 104, 255)','rgb(115, 255, 87)','rgb(90, 90, 90)'],
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
                    
                    $('#titulo1').text('Grau');
                    $('#titulo2').text('Processo');
                    
                }
            })
        });
    })  
    
</script>
@endsection