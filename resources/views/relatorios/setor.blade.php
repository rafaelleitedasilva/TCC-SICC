@extends('template.principal')
@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css"/>

<h1 class="text-center">Relatório de Setor</h1>

<div id='chart-master'>
    <canvas id="myChart"></canvas>
</div>

    <table id="chamados" class="w-100">
        <thead>
            <tr class="w-100">
                <th width="auto">Setores</th>
                <th width="auto">Chamados</th>
                <th width="auto">Último Chamado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($array as $key => $a)
                <tr>
                    <td>{{ $key }}</td>
                    <td><strong>{{ $a[0] }}</strong></td>
                    <td>{{ $a[1] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

<script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.com/libraries/Chart.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    
    $(document).ready( function () {
        $('#chamados').DataTable(settings2);
        $.ajax({
            url:"{{ route('setor_dados') }}",
            type: "GET",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'empresa': "{{Auth::user()->Empresa}}"
            },
            dataType: 'json',
            success: function(response){
                const ctx = document.getElementById('myChart');
                let labels = Object.keys(response[4]);
                
                
                let array = response.map(function(obj) {
                    return Object.keys(obj).map(function(chave) {
                        return obj[chave];
                    });
                });
                
                // Verificar labels sem dados e removê-los
                labels = labels.filter(function(label, index) {
                    return array[0][index] > 0 || array[1][index] > 0 || array[2][index] > 0 || array[3][index] > 0;
                });
                
                const data = {
                    labels: labels,
                    datasets: [
                    {
                        label: 'Pendente',
                        data: array[0],
                        backgroundColor: 'rgb(255, 74, 74)',
                    },
                    {
                        label: 'Em Andamento',
                        data: array[1],
                        backgroundColor: 'rgb(70, 104, 255)',
                    }
                    ]
                };
                
                const stackedBar = new Chart(ctx, {
                    type: 'bar',
                    data: data,
                    options: {
                        scales: {
                            x: {
                                stacked: true
                            },
                            y: {
                                stacked: true
                            }
                        }
                    }
                });
            }
        });
    })  
</script>
@endsection