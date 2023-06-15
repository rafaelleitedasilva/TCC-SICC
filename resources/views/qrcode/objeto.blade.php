@extends('template.principal')
    @section('content')
    <table id="objeto-qrcode" class="display" style="width:100%;">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Setor</th>
                <th>QRCode</th>
            </tr>
        </thead>
        @foreach($objeto as $obj)
        <tr>        
            <td style='text-transform:uppercase;'>{{$obj->Nome}}</td>
            <td>{{$obj->Setor->Nome}}</td>
            <td><a href='{{ asset("qrcode/$obj->ID-$obj->Nome.png") }}' data-lightbox="image-{{ $obj->ID }}" data-title="{{ $obj->Nome }}"><img width="50" src="{{ asset("qrcode/$obj->ID-$obj->Nome.png") }}" alt=""></a></td>
        </tr>
        @endforeach
    </table>

    <script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready( function () {
            $('#objeto-qrcode').DataTable(settings1);
        });
    </script>
@endsection