@extends('template.principal')
    @section('content')
    <table id="setor-qrcode" class="display" style="width:100%;">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Gestor</th>
                <th>QRCode</th>
            </tr>
        </thead>
        @foreach($setor as $set)
        <tr>        
            <td style='text-transform:uppercase;'>{{$set->Nome}}</td>
            <td>{{$set->Gestor->Nome}}</td>
            <td><a href='{{ asset("qrcode/$set->ID-$set->Nome.png") }}' data-lightbox="image-{{ $set->ID }}" data-title="{{ $set->Nome }}"><img width="50" src='{{ asset("qrcode/$set->ID-$set->Nome.png") }}'></a></td>
        </tr>
        @endforeach
    </table>

    <script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready( function () {
            $('#setor-qrcode').DataTable(settings1);
        });
    </script>
@endsection