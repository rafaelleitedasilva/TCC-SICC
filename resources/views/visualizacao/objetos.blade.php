@extends('template.principal')
@section('content')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css"/>

<table id="objetos" class="display" style="width:100%;">
    <thead>
        <tr>
            <th>Objeto</th>
            <th>Setor</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>
    </thead>
    @foreach($objetos as $objeto)
    <tr>
        <td>{{$objeto->Nome}}</td>
        <td>{{$objeto->Setor->Nome}}</td>
        <td>
            <a class="btn btn-success" href="{{ route('update_objetos', ['ID' => $objeto->ID]) }}"><i class="fa fa-pencil"></i> Editar</a>
        </td>
        <td>
            <a class="btn btn-danger" href="{{ route('objetos_delete', ['ID' => $objeto->ID]) }}"><i class="fa fa-close"></i> Excluir</a>
        </td>
    </a>
</tr>
@endforeach
</table>

<script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#objetos').DataTable(settings);
    });
</script>

@endsection