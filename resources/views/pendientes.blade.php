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

<body style="background-image: url('diseno/images/a3.jpg')">
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


    <a type="button" href="{{route('exportarPendiente')}}" class="btn btn-success" > Exportar </a>

    <form  class="d-none d-md-inline-block form-inline
                           ml-auto mr-0 mr-md-2 my-0 my-md-0 mb-md-2">
        <div class="input-group" style="width: 300px">
            <input class="form-control" name="search" type="search" placeholder="Search"
                   aria-label="Search">
            <div class="input-group-append">
                <a id="borrarBusqueda" class="btn btn-danger hideClearSearch" style="color: white"
                   href="{{url("/pendientes")}}">&times;</a>
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
    @foreach($home3 as $homedata)
    <table id="datatable" class="table table-light" >
        <thead>

        <tr>
            <th scope="col">N° de Pedido</th>
            <th scope="col">Codigo de Unidad</th>
            <th scope="col">Descripción</th>
            <th scope="col">Codigo de Fábrica</th>
            <th scope="col">Nota</th>
            <th scope="col">Fecha Pedido</th>
            <th scope="col">Fecha Requerida</th>


        <tbody>


            <tr>
                <td>{{$homedata->pedido}}</td>
                <td>{{$homedata->codigo}}</td>
                <td>{{$homedata->descripcion}}</td>
                <td>{{$homedata->fabrica}}</td>
                <td>{{$homedata->nota}}</td>
                <td>{{$homedata->fecha_pedido}}</td>
                <td>{{$homedata->fecha_requerida}}</td>
            </tr>
            <tr>
                <th scope="col">Empaque</th>
                <th scope="col">Cantidad Original</th>
                <th scope="col">Cantidad Recibida</th>
                <th scope="col">Cantidad Pendiente</th>
                <th scope="col">Dias R/F</th>
                <th scope="col">Acciones</th>
            </tr>
            <tr>
                <td>{{$homedata->empaque}}</td>
                <td>{{$homedata->cantidad_original}}</td>
                <td>{{$homedata->cantidad_recibida}}</td>
                <td>{{$homedata->cantidad_pendiente}}</td>
                <td>{{$homedata->dias}}</td>


                <td>
                    <button class="btn btn-sm btn-info"
                            title="Borrar"
                            data-toggle="modal"
                            data-target="#modalBorrarPrestaLibro"
                            data-id="{{$homedata->id}}"
                            data-cantidad_pendiente="{{$homedata->cantidad_pendiente}}">
                        <span>Entregar</span>
                    </button>
                </td>

            </tr>

        </tbody>


    </table>
    @endforeach

</div>
<div class="modal fade" id="modalBorrarPrestaLibro" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <form method="post" action="{{route("entregapedidos")}}" enctype="multipart/form-data">
                @method("Put")
                @csrf
                <div class="modal-header" style="background: #4986FC">

                    <h5 class="modal-title" style="color: white"><span class="fas fa-trash"></span>Entregar
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style="color: white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Cantidad Pendiente:  <label
                            id="cantidad_pendiente"></label> </p>

                </div>
                <div class="form-group">
                    <label >Cantidad Entregada</label>
                    <input type="number" class="form-control" name="cantidad"  placeholder="cantidad Entregada">
                </div>
                <div class="modal-footer">
                    <input id="id" name="id" type="hidden" value="">
                    <button type="submit" class="btn btn-danger">Borrar</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>

    </div>
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
