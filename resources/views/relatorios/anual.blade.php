@extends('template.principal')
@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<div class="d-flex justify-content-between">
    <h1 class="text-center">Relatório Anual</h1>
    <select name="ano" id="ano" class="btn btn-secondary m-3 text-left pr-2" style="font-size: 15px;">
        <option value="x">Selecione o ano</option>
    </select>

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

<div id="chart-master">
    
</div>

<script src="https://cdnjs.com/libraries/Chart.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    
    $(document).ready( function () {
        $('#ano').change(function () {
            $('#graf').remove();
            $('#myChart').remove();
            $('#chart-master').html('<canvas id="myChart"></canvas>');

            $.ajax({
            url:"{{ route('anos_dados') }}",
            type: "GET",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'ano': $('#ano').val(),
            },
            dataType: 'json',
            success: function(response){
                const ctx = document.getElementById('myChart');
                let labels = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
                indice = response.indexOf(0)

                //RETIRA OS MESES VAZIOS
                while(indice >= 0){
                    response.splice(indice, 1);
                    labels.splice(indice, 1);

                    indice = response.indexOf(0);
                }

                // Define uma função para gerar uma cor aleatória em tom pastel
                function generatePastelColor() {
                const r = Math.floor(Math.random() * 128) + 128;
                const g = Math.floor(Math.random() * 128) + 128;
                const b = Math.floor(Math.random() * 128) + 128;
                return `rgb(${r}, ${g}, ${b})`;
                }

                // Cria um array vazio para armazenar as cores geradas
                const pastelColors = [];

                // Gera 12 cores aleatórias em tons pastéis e adiciona ao array
                for (let i = 0; i < 12; i++) {
                const color = generatePastelColor();
                pastelColors.push(color);
                }

                const data = {
                    labels: labels,
                    datasets: [{
                        label: 'Número de Chamados',
                        data: response,
                        backgroundColor:pastelColors,
                        borderWidth: 1
                    }]
                };
                
                const config = {
                    type: 'doughnut',
                    data: data,
                    options: {
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
            }
        });
        })
    });
</script>
@endsection