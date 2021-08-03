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
{{--Star add Modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ingrese los datos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{action('HomeController@store')}}" method="POST">

                {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-group">
                        <label >N° Pedido</label>
                        <input type="text" class="form-control" name="pedido"  placeholder="Ingrese el numero de pedido">

                    </div>
                    <div class="form-group">
                        <label >Codigo de Unidad</label>
                        <input type="text" class="form-control"  name="codigo" placeholder="Ingrese el codigo de unidad">
                    </div>
                    <div class="form-group">
                        <label >Descripción</label>
                        <input type="text" class="form-control" name="descripcion" placeholder="Ingrese la Descripción">
                    </div>
                    <div class="form-group">
                        <label >Codigo de Fábrica</label>
                        <input type="text" class="form-control"  name="fabrica" placeholder="Ingreso el codigo de fabrica">
                    </div>
                    <div class="form-group">
                        <label >Nota</label>
                        <input type="text" class="form-control" name="nota" placeholder="Ingrese la nota">
                    </div>
                    <div class="form-group">
                        <label >Fecha de Pedido</label>
                        <input type="date" class="form-control" name="fecha_pedido"  placeholder="seleccione la fecha de pedido ">
                    </div>
                    <div class="form-group">
                        <label >Fecha Requerida</label>
                        <input type="date" class="form-control"  name="fecha_requerida" placeholder="Seleccione la fecha requerida">
                    </div>
                    <div class="form-group">
                        <label >Empaque</label>
                        <input type="text" class="form-control"  name="empaque" placeholder="Ingrese el tipo de empaque">
                    </div>
                    <div class="form-group">
                        <label >Cantidad Original</label>
                        <input type="number" class="form-control"  name="cantidad_original" placeholder="Seleccione la cantidad original">
                    </div>
                    <div class="form-group">
                        <label >Cantidad Recibida</label>
                        <input type="number" class="form-control"  name="cantidad_recibida" placeholder="Seleccione la cantidad recibida">
                    </div>
                    <div class="form-group">
                        <label >Cantidad Pendiente</label>
                        <input type="number" class="form-control"  name="cantidad_pendiente" placeholder="Seleccione la cantidad pendiente">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Datos</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{--End add  Modal --}}


{{--Star Edit Modal --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edite los datos ingresados</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="/ligero_colombia" method="POST" id="editForm">
                {{csrf_field()}}
                {{method_field('put')}}

                <div class="modal-body">
                    <div class="form-group">
                        <label >N° Pedido</label>
                        <input type="text" class="form-control" name="pedido" id="pedido" placeholder="Ingrese el numero de pedido">

                    </div>
                    <div class="form-group">
                        <label >Codigo de Unidad</label>
                        <input type="text" class="form-control"  name="codigo" id="codigo" placeholder="Ingrese el codigo de unidad">
                    </div>
                    <div class="form-group">
                        <label >Descripción</label>
                        <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Ingrese la Descripción">
                    </div>
                    <div class="form-group">
                        <label >Codigo de Fábrica</label>
                        <input type="text" class="form-control"  name="fabrica" id="fabrica" placeholder="Ingreso el codigo de fabrica">
                    </div>
                    <div class="form-group">
                        <label >Nota</label>
                        <input type="text" class="form-control" name="nota" id="nota" placeholder="Ingrese la nota">
                    </div>
                    <div class="form-group">
                        <label >Fecha de Pedido</label>
                        <input type="date" class="form-control" name="fecha_pedido" id="fecha_pedido" placeholder="seleccione la fecha de pedido ">
                    </div>
                    <div class="form-group">
                        <label >Fecha Requerida</label>
                        <input type="date" class="form-control"  name="fecha_requerida" id="fecha_requerida" placeholder="Seleccione la fecha requerida">
                    </div>
                    <div class="form-group">
                        <label >Empaque</label>
                        <input type="text" class="form-control"  name="empaque" id="empaque" placeholder="Ingrese el tipo de empaque">
                    </div>
                    <div class="form-group">
                        <label >Cantidad Original</label>
                        <input type="number" class="form-control"  name="cantidad_original" id="cantidad_original" placeholder="Seleccione la cantidad original">
                    </div>
                    <div class="form-group">
                        <label >Cantidad Recibida</label>
                        <input type="number" class="form-control"  name="cantidad_recibida" id="cantidad_recibida" placeholder="Seleccione la cantidad recibida">
                    </div>
                    <div class="form-group">
                        <label >Cantidad Pendiente</label>
                        <input type="number" class="form-control"  name="cantidad_pendiente" id="cantidad_pendiente" placeholder="Seleccione la cantidad pendiente">
                    </div>

                    <div class="modal-footer" >
                        <button type="button" name="id" id="editForm" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Actualizar Datos</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{--End Edit  Modal --}}


{{--Star Delete Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar datos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="/home" method="POST" id="deleteForm">

                {{csrf_field()}}
                {{method_field('DELETE')}}

                <p> ¿ Esta seguro de borrar los datos ?</p>
                <div class="modal-footer">
                    <button type="button" name="id"  id="deleteForm" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary"> Si, Eliminar </button>
                </div>
                <input type="hidden" name="id"  id="" value="">

            </form>
        </div>
    </div>
</div>
{{--End Delete  Modal --}}



<!-- Modal Importar -->


{{--End importar  Modal --}}


<body style="background-image: url('image/background.jpg')">
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

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Nuevo
    </button>
    <a type="button" href="{{route('exportar')}}" class="btn btn-success" > Exportar </a>

    <a href="{{url('/import')}}" type="button" class="btn btn-primary" ><i class="fas fa-file-import"></i> Importar</a>

    <br><br>
    <table id="datatable" class="table table-light" >
        <thead>

        <tr>
            <th scope="col">Id</th>
            <th scope="col">N° de Pedido</th>
            <th scope="col">Codigo de Unidad</th>
            <th scope="col">Descripción</th>
            <th scope="col">Codigo de Fábrica</th>
            <th scope="col">Nota</th>
            <th scope="col">Fecha Pedido</th>
            <th scope="col">Fecha Requerida</th>
            <th scope="col">Empaque</th>
            <th scope="col">Cantidad Original</th>
            <th scope="col">Cantidad Recibida</th>
            <th scope="col">Cantidad Pendiente</th>
            <th scope="col">Dias R/F</th>
            <th scope="col">Acciones</th>
        </thead>
        <tbody>
        @foreach($home3 as $homedata)

            <tr>
                <th>{{$homedata->id}}</th>
                <th>{{$homedata->pedido}}</th>
                <th>{{$homedata->codigo}}</th>
                <th>{{$homedata->descripcion}}</th>
                <th>{{$homedata->fabrica}}</th>
                <th>{{$homedata->nota}}</th>
                <th>{{$homedata->fecha_pedido}}</th>
                <th>{{$homedata->fecha_requerida}}</th>
                <th>{{$homedata->empaque}}</th>
                <th>{{$homedata->cantidad_original}}</th>
                <th>{{$homedata->cantidad_recibida}}</th>
                <th>{{$homedata->cantidad_pendiente}}</th>
                <th>{{$homedata->dias}}</th>

                <td>


                    <a href="#" class="btn btn-success edit">Editar</a>
                    <a href="#" class="btn btn-danger delete" >Eliminar</a>
                </td>
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


            $('#editForm').attr('action','/home/'+data[0]);
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

            $('#deleteForm').attr('action','/home/'+data[0]);
            $('#deleteModal').modal('show');
        });
        //End Delete Record
    });

</script>


</body>




@endsection
