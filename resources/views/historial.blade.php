@extends('layouts.app')

@section('content')


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Control de Pedidos</title>
    <!--nuevo-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">



</head>

{

<body style="background-image: url('diseno/images/a2.jpg')">
<div class="container">

    <br>
    <h2 align="center" style="color: white" >Control de Pedidos</h2>

    @if (count($errors)>0)
        <div class="alert- alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(\Session::has('success'))
        <div class="alert alert-success">
            <p>{{\Session::get('success')}}</p>
        </div>
    @endif
    <br>


    <a type="button" href="{{route('exportar')}}" class="btn btn-success" > Exportar </a>

    <form  class="d-none d-md-inline-block form-inline
                           ml-auto mr-0 mr-md-2 my-0 my-md-0 mb-md-2">
        <div class="input-group" style="width: 300px">
            <input class="form-control" name="search" type="search" placeholder="Search"
                   aria-label="Search">
            <div class="input-group-append">
                <a id="borrarBusqueda" class="btn btn-danger hideClearSearch" style="color: white"
                   href="{{url("/historial")}}">&times;</a>
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </form>
    <br><br>

    @if(session("exito"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session("exito")}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(session("error"))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{session("error")}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-warning alert-dismissible fade show " role="alert">

            @foreach ($errors->all() as $error)
                <span class="fa fa-exclamation-triangle"></span> {{ $error }}
            @endforeach
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

        <table id="datatable" class="table table-light" >
            <thead>

            <tr>
                <th scope="col">N° de Pedido</th>
                <th scope="col">Codigo de Unidad</th>
                <th scope="col">Descripción</th>
                <th scope="col">Codigo de Fábrica</th>
                <th scope="col">Nota</th>
                <th scope="col">Fecha Pedido</th>
                <th scope="col">Cantidad Original</th>

            </thead>
            <tbody>
            @foreach($home3 as $homedata)

                <tr>
                    <td>{{$homedata->pedido}}</td>
                    <td>{{$homedata->codigo}}</td>
                    <td>{{$homedata->descripcion}}</td>
                    <td>{{$homedata->fabrica}}</td>
                    <td>{{$homedata->nota}}</td>
                    <td>{{$homedata->fecha_pedido}}</td>
                    <td>{{$homedata->cantidad_original}}</td>



                </tr>
            @endforeach
            </tbody>


        </table>

</div>



{{-- Javascript --}}
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">

    $(document).ready(function (){

        var table = $('#datatable').DataTable();

        //star Edit Record
        table.on('click','.edit', function () {
            $tr = $(this).closest('tr');
            if ($($tr).hasClass('child')) {
                $tr = $tr.prev('.parent');
            }
            var data = table.row($tr).data();
            console.log(data);

            $('#pedido').val(data[1]);
            $('#codigo').val(data[2]);
            $('#descripcion').val(data[3]);
            $('#fabrica').val(data[4]);
            $('#nota').val(data[5]);
            $('#fecha_pedido').val(data[6]);
            $('#fecha_requerida').val(data[7]);
            $('#empaque').val(data[8]);
            $('#cantidad_original').val(data[9]);
            $('#cantidad_recibida').val(data[10]);
            $('#cantidad_pendiente').val(data[11]);


            $('#editForm').attr('action','/'+data[0]);
            $('#editModal').modal('show');
        });
        //End Edit Record

        //star Delete Record
        table.on('click','.delete', function () {
            $tr = $(this).closest('tr');
            if ($($tr).hasClass('child')) {
                $tr = $tr.prev('.parent');
            }
            var data = table.row($tr).data();
            console.log(data);

            // $('#id').val(data[0]);

            $('#deleteForm').attr('action','/'+data[0]);
            $('#deleteModal').modal('show');
        });
        //End Delete Record
    });

</script>


</body>




@endsection
