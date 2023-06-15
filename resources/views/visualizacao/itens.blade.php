@extends('template.principal')
@section('content')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css"/>

<table id="itens" class="display" style="width:100%;">
    <thead>
        <tr>
            <th>Item</th>
            <th>Descrição</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>
    </thead>
    @foreach($itens as $item)
    <tr>
        <td>{{$item->Nome}}</td>
        <td>{{$item->Descricao}}</td>
        <td>
            <a class="btn btn-success" href="{{ route('update_itens', ['ID' => $item->ID]) }}"><i class="fa fa-pencil"></i> Editar</a>
        </td>
        <td>
            <a class="btn btn-danger" href="{{ route('itens_delete', ['ID' => $item->ID]) }}"><i class="fa fa-close"></i> Excluir</a>
        </td>
    </a>
</tr>
@endforeach
</table>

<script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#itens').DataTable(settings);
    });
</script>

@endsection