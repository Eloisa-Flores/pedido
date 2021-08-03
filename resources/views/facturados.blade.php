@extends("layouts.MenuAdmin")
@section("content")
    <br>
    <br>
    <br>
    <div class="hero-wrap js-fullheight" >


        <section class="ftco-section ftco-no-pb ftco-no-pt">
            <div class="container-fluid ">
                <h1 class="mt-4">Libros Pendientes

                </h1>
                <nav aria-label="breadcrumb">
                    <form  class="d-none d-md-inline-block  ">
                        <div class="input-group " >
                            <input class="form-control col-md-6" name="fecha1" type="Date" placeholder="Buscar"
                                   aria-label="Search">
                            <label>&nbsp;  hasta  &nbsp;</label>

                            <input class="form-control col-md-6" name="fecha2" type="Date" placeholder="Buscar"
                                   aria-label="Search">
                            <div class="input-group-append">
                                <a id="borrarBusqueda" class="btn btn-danger hideClearSearch" style="color: white"
                                   href="{{route("LibroPendiente")}}">&times;</a>
                                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>

                    <div class="pagination pagination-sm">
                        <a class="btn btn-success hideClearSearch" style="color: white"
                           id="botonAbrirModalNuevoRecepcionCapa"
                           data-toggle="modal" data-target="#modalfecha">Excel</a>

                        @foreach($total as $producto)
                            <label  class="d-none d-md-inline-block form-inline
                           ml-auto mr-0 mr-md-2 my-0 my-md-0 mb-md-2"
                                    style="align-content: center">Total Libros Pendiente: {{$producto->total_capa}}</label>
                        @endforeach

                        <form  class="d-none d-md-inline-block form-inline
                           ml-auto mr-0 mr-md-2 my-0 my-md-0 mb-md-2">
                            <div class="input-group" style="width: 300px">
                                <input class="form-control" name="search" type="search" placeholder="Buscar"
                                       aria-label="Search">
                                <div class="input-group-append">
                                    <a id="borrarBusqueda" class="btn btn-danger hideClearSearch" style="color: white"
                                       href="{{route("LibroPendiente")}}">&times;</a>
                                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>

                </nav>


                @if(session("exito"))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session("exito")}}
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

            <!--------------------------Reabrir modal si hay errror---------------------------->
                @if(session("errores"))
                    <input id="id_M" name="id_M" value="{{session("id_M")}}" type="hidden" >

                    <script>
                        var id=document.getElementById("id_M").value;
                        document.onreadystatechange = function () {
                            if (document.readyState) {
                                document.getElementById("editar_M"+id).click();
                            }
                        }
                    </script>
                @else
                    @if($errors->any())
                        <script>
                            document.onreadystatechange = function () {
                                if (document.readyState) {
                                    document.getElementById("botonAbrirModalNuevaMarca").click();
                                }
                            }
                        </script>
                    @endif
                @endif

                <table class="table">
                    <thead class="ftco-footerr">
                    <tr>
                        <th style="color:#f1f1f1">#</th>
                        <th  style="color:#f1f1f1">Alumno</th>
                        <th  style="color:#f1f1f1">Libro</th>
                        <th  style="color:#f1f1f1">Fecha Devuelto</th>
                        <th  style="color:#f1f1f1">Dias Retraso</th>


                        <th style="color:#f1f1f1"><span class="fas fa-info-circle"></span></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($prestalibro as $prestalibros)
                        <tr>
                            <td>{{$noPagina++}}</td>
                            <td>{{$prestalibros->nombre_libro}}</td>
                            <td>{{$prestalibros->nombre_usuario}}</td>
                            <td>{{$prestalibros->fechadevolucion}}</td>
                            <td  style="color:#e72828">{{$prestalibros->diasf}}  dias Retraso</td>

                            <td>
                                <button class="btn btn-sm btn-info"
                                        title="Ver"
                                        data-toggle="modal"
                                        data-target="#modalVerPrestalibro"
                                        data-nombre_usuario="{{$prestalibros->nombre_usuario}}"
                                        data-nombre_libro="{{$prestalibros->nombre_libro}}"
                                        data-email_usuario="{{$prestalibros->email_usuario}}"
                                        data-codigo_usuario="{{$prestalibros->codigo_usuario}}"
                                        data-genero_usuario="{{$prestalibros->genero_usuario}}"
                                        data-telefono_usuario="{{$prestalibros->telefono_usuario}}"
                                        data-foto_usuario="{{$prestalibros->foto_usuario}}"
                                        data-tema_libro="{{$prestalibros->tema_libro}}"
                                        data-foto_libro="{{$prestalibros->foto_libro}}"
                                        data-autor_libro="{{$prestalibros->autor_libro}}"
                                        data-diasf="{{$prestalibros->diasf}}"
                                        data-fechadevolucion="{{$prestalibros->fechadevolucion}}">
                                    <span class="fas fa-eye"></span>
                                </button>

                                <button class="btn btn-sm btn-danger"
                                        title="Borrar"
                                        data-toggle="modal"
                                        data-target="#modalBorrarPrestaLibro"
                                        data-id="{{$prestalibros->id}}"
                                        data-id_user="{{$prestalibros->id_user}}">
                                    <span class="fas fa-trash"></span>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>




                <!------------------MODAL VER PRODUCTO-------------------------------->
                <div class="modal fade" id="modalVerPrestalibro" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background: #2a2a35">
                                <h5 class="modal-title" style="color: white"><span class="fas fa-plus"></span> Detalle del Prestamo
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" style="color: white">&times;</span>
                                </button>
                            </div>
                            @include('Alerts.errors')

                            @csrf
                            <div class="modal-body row" >

                                <div class="col-sm-5">
                                    <div class="image-border">
                                        <img id="foto_libro"
                                             height="217" width="217"
                                             style="object-fit: contain"
                                             onerror="this.src='/images/noimage.jpg'">
                                    </div>
                                    <b><label for="nombreNuevoProducto" id="nombreNuevoProducto"></label></b>
                                </div>

                                <div class="col-sm-10 card">


                                    <div class="form-group row">
                                        <div class="col-sm-6"><label for="nombre_libro"><strong>Nombre Libro: </strong></label></div>
                                        <div class="col-md-3"><label for="nombre_libro" id="nombre_libro"></label></div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6"><label for="tema_libro"><strong>Tema :</strong></label></div>
                                        <div class="col-sm-3"><label for="tema_libro" id="tema_libro"></label></div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6"><label for="autor_libro"><strong>Autor :</strong></label></div>
                                        <div class="col-sm-3"><label for="autor_libro" id="autor_libro"></label></div>
                                    </div>



                                </div>
                                <div class="modal-body row" >

                                    <div class="col-sm-5">
                                        <div class="image-border">
                                            <img id="foto_usuario"
                                                 height="217" width="217"
                                                 style="object-fit: contain"
                                                 onerror="this.src='/images/noimage.jpg'">
                                        </div>
                                        <b><label for="nombreNuevoProducto" id="nombreNuevoProducto"></label></b>
                                    </div>

                                    <div class="col-sm-9 card">


                                        <div class="form-group row">
                                            <div class="col-sm-6"><label for="nombre_usuario"><strong>Nombre Usuario : </strong></label></div>
                                            <div class="col-md-3"><label for="nombre_usuario" id="nombre_usuario"></label></div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6"><label for="email_usuario"><strong> Correo:</strong></label></div>
                                            <div class="col-sm-3"><label for="email_usuario" id="email_usuario"></label></div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6"><label for="codigo_usuario"><strong> Identidad:</strong></label></div>
                                            <div class="col-sm-3"><label for="codigo_usuario" id="codigo_usuario"></label></div>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-sm-6"><label for="genero_usuario"><strong>Género : </strong></label></div>
                                            <div class="col-md-3"><label for="genero_usuario" id="genero_usuario"></label></div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6"><label for="telefono_usuario"><strong> Teléfono:</strong></label></div>
                                            <div class="col-sm-3"><label for="telefono_usuario" id="telefono_usuario"></label></div>
                                        </div>


                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button data-dismiss="modal" class="btn btn-success">Aceptar</button>
                            </div>
                        </div>

                    </div></div>
                <!--------------------------MODAL BORRAR MARCA----------------------------------->
                <div class="modal fade" id="modalBorrarPrestaLibro" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <form method="post" action="{{route("LibroPendienteborrar")}}" enctype="multipart/form-data">
                                @method("PUT")
                                @csrf
                                <div class="modal-header" style="background: #4986FC">
                                    <h5 class="modal-title" style="color: white"><span class="fas fa-trash"></span> Devolver Libro
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span style="color: white" aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>¿Estás seguro que deseas Devolver el Libro <label
                                            id="nombreArea"></label>? </p>

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


                <div class="modal fade" id="modalfecha" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background: #2a2a35">
                                <h5 class="modal-title" style="color: white"><span class="fas fa-plus"></span> Exportar EXCEL
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" style="color: white">&times;</span>
                                </button>
                            </div>
                            <form id="nuevoP" method="POST" action="{{route("exportarLibroPendiente")}}" enctype="multipart/form-data">

                                @csrf
                                <div class="modal-body">
                                    <div class="form-row cols-md-6">
                                        <label for="fecha1">Fecha Inicial</label>
                                        <input class="form-control @error('name') is-invalid @enderror" name="fecha1" id="fecha1"
                                               type="datetime-local"
                                               value="{{ old('fecha1')}}" >
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-row cols-md-6">
                                        <label for="fecha2">Fecha Final</label>
                                        <input class="form-control @error('name') is-invalid @enderror" name="fecha2" id="fecha1"
                                               type="datetime-local"
                                               value="{{ old('fecha2')}}" >
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" id="nuevoP" class="btn btn-success">Exportar</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>


            </div>
        </section>

    </div>

    <style>
        .image-preview-input-tipo-categoria {
            position: relative;
            overflow: hidden;
            margin: 0px;
            color: #333;
            background-color: #fff;
            border-color: #ccc;
        }

        .image-preview-input-tipo-categoria input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            font-size: 20px;
            cursor: pointer;
            opacity: 0;
            filter: alpha(opacity=0);
        }

        .image-preview-input-title-tipo-categoria {
            margin-left: 2px;
        }

        .image-preview-input {
            position: relative;
            overflow: hidden;
            margin: 0px;
            color: #333;
            background-color: #fff;
            border-color: #ccc;
        }

        .image-preview-input input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            font-size: 20px;
            cursor: pointer;
            opacity: 0;
            filter: alpha(opacity=0);
        }

        .image-preview-input-title {
            margin-left: 2px;
        }

        .image-class {
            border-radius: 50%;
            object-fit: cover;
        }
        .image-class:hover{
            opacity: 0.7;
            transition: all 0.1s ease-in-out;
        }
    </style>
@endsection
