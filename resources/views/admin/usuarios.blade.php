@extends('template.principal')
@section('content')
<table id="usuarios" class="display" style="width:100%;">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Acesso</th>
            @if(Auth()->user()->Empresa == 1)
            <th>Empresa</th>
            @endif
            <th>Editar</th>
            <th>Ativação/Desativação</th>
        </tr>
    </thead>
    @foreach($users as $user)
    <tr>
        <td>{{$user->Nome}}</td>
        <td>@if($user->acesso == 'admin')Administrador @else {{$user->acesso}} @endif</td>
        @if(Auth()->user()->Empresa == 1)
        <td>{{$user->EmpresaID->nome}}</td>
        @endif
        <td>
            <a class="btn btn-success w-100" href="{{route('updateUsuarios', ['ID' => $user->ID])}}"><i class="fa fa-pencil"></i> Editar</a>
        </td>
        <td>
            @if($user->ativo == 0)
                <a class="btn btn-primary w-100" href="{{route('usuarios_delete', ['ID' => $user->ID])}}"><i class="fa fa-close"></i> Ativar</a>
            @else
                <a class="btn btn-danger w-100" href="{{route('usuarios_delete', ['ID' => $user->ID])}}"><i class="fa fa-close"></i> Desativar</a>
            @endif
        </td>
    </a>
</tr>
@endforeach
</table>
<script>
    $(document).ready( function () {
        $('#usuarios').DataTable(settings);
    });
</script>
@endsection