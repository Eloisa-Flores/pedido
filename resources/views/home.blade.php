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


            <form action="{{route("crearhome")}}" method="POST">

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

                    <div class="form-group ">
                        <label for="fabrica">  Codigo Empresa</label>
                        <select name="fabrica"
                                required="required"
                                class=" select2Empresa form-control @error('id_marca')
                                    is-invalid @enderror" id="codigo">
                            <option  disabled selected value="">Seleccione</option>
                            @foreach($empresa as $libros)
                                <option style="color:#151313" value="{{$libros->codigo}}" @if(Request::old('fabrica')==$libros->codigo){{'selected'}}@endif
                                @if(session("idMarca"))
                                    {{session("idMarca")==$libros->codigo ? 'selected="selected"':''}}
                                    @endif>{{$libros->codigo}}
                                </option>
                            @endforeach
                        </select>
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

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
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

            <form action="{{route("editarhome")}}" method="POST" id="editForm" enctype="multipart/form-data">>
                {{csrf_field()}}
                {{method_field('PUT')}}

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
                        <label >Codigo Fabrica</label>
                    <select name="fabrica"
                            required
                            style="width: 100%"
                            class="select2TipoCategoria form-control @error('id_semilla') is-invalid @enderror"
                            id="fabrica" required="required">
                        <option disabled selected value="">Seleccione</option>
                        @foreach($empresa as  $libros)
                            <option value="{{$libros->codigo}}">{{$libros->codigo}}
                            </option>
                        @endforeach
                    </select>
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


                    <div class="modal-footer" >
                        <button type="button" name="id" id="editForm" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
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

            <form action="{{route("eliminarhome")}}" method="POST" id="deleteForm">

                {{csrf_field()}}
                {{method_field('DELETE')}}


                <div class="modal-body">
                    <p>Esta Seguro que desea Borra:  <label
                            id="pedido"> ?</label> </p>

                </div>
                <div class="modal-footer">
                    <button type="button" name="id"  id="deleteForm" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger"> Si, Eliminar </button>
                </div>
                <input type="hidden" name="id"  id="" value="">

            </form>
        </div>
    </div>
</div>
{{--End Delete  Modal --}}



<!-- Modal Importar -->


{{--End importar  Modal --}}


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

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Nuevo
    </button>
    <a type="button" href="{{route('exportar')}}" class="btn btn-success" > Exportar </a>

    <a href="{{url('/import')}}" type="button" class="btn btn-info" ><i class="fas fa-file-import"></i> Importar</a>

    <form  class="d-none d-md-inline-block form-inline
                           ml-auto mr-0 mr-md-2 my-0 my-md-0 mb-md-2">
        <div class="input-group" style="width: 300px">
            <input class="form-control" name="search" type="search" placeholder="Buscador"
                   aria-label="Search">
            <div class="input-group-append">
                <a id="borrarBusqueda" class="btn btn-danger hideClearSearch" style="color: white"
                   href="{{url("/")}}">&times;</a>
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
                    <button class="btn btn-sm btn-success"
                            title="Editar"
                            id="editar_M{{$homedata->id}}"
                            data-toggle="modal"
                            data-target="#editModal"
                            data-id="{{$homedata->id}}"
                            data-pedido="{{$homedata->pedido}}"
                            data-codigo="{{$homedata->codigo}}"

                            data-descripcion="{{$homedata->descripcion}}"
                            data-fabrica="{{$homedata->fabrica}}"
                            data-nota="{{$homedata->nota}}"
                            data-fecha_pedido="{{$homedata->fecha_pedido}}"
                            data-fecha_requerida="{{$homedata->fecha_requerida}}"
                            data-empaque="{{$homedata->empaque}}"
                            data-cantidad_original="{{$homedata->cantidad_original}}"
                            data-cantidad_recibida="{{$homedata->cantidad_recibida}}"
                            data-cantidad_pendiente="{{$homedata->cantidad_pendiente}}">
                        <span >Editar</span>
                    </button>

                    <button class="btn btn-sm btn-danger"
                            title="Borrar"
                            data-toggle="modal"
                            data-target="#deleteModal"
                            data-id="{{$homedata->id}}"
                            data-pedido="{{$homedata->pedido}}">
                        <span >Borrar</span>
                    </button>
                </td>
                <td>



                </td><td>
                </td>
            </tr>

        </tbody>


    </table>
    @endforeach

</div>
<div class="modal fade" id="modalBorrarPrestaLibro" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <form method="post" action="{{route("entregapedido")}}" enctype="multipart/form-data">
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
                    <button type="submit" class="btn btn-danger">Entregar</button>
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




</body>




@endsection
