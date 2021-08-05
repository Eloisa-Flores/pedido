@extends("layouts.app")
@section("content")

    <div class="hero-wrap js-fullheight" >


    <section class="ftco-section ftco-no-pb ftco-no-pt">
    <div class="container-fluid ">
        <h1 class="mt-4">Empresas
            <div class="btn-group form-group" role="group" style=" margin-left: 20px; margin-top: 20px">
                <button class="btn btn-sm btn-success"
                        id="botonAbrirModalNuevaMarca"
                        data-toggle="modal" data-target="#modalCrearMarca">
                    Nueva
                </button>
            </div>

        </h1>
        <nav aria-label="breadcrumb">

            <div class="pagination pagination-sm">

                <form  class="d-none d-md-inline-block form-inline
                           ml-auto mr-0 mr-md-2 my-0 my-md-0 mb-md-2">
                    <div class="input-group" style="width: 300px">
                        <input class="form-control" name="search" type="search" placeholder="Search"
                               aria-label="Search">
                        <div class="input-group-append">
                            <a id="borrarBusqueda" class="btn btn-danger hideClearSearch" style="color: white"
                               href="{{route("verarea")}}">&times;</a>
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
            <thead>
            <tr>
                <th >#</th>
                <th >Nombre</th>
                <th >Codigo</th>

                <th style="color:#f1f1f1"><span class="fas fa-info-circle"></span></th>
            </tr>
            </thead>
            <tbody>

            @foreach($area as $marca)
                <tr>
                    <td>{{$noPagina++}}</td>
                    <td>{{$marca->name}}</td>
                    <td>{{$marca->codigo}}</td>
                    <td>

                        <button class="btn btn-sm btn-success"
                                title="Editar"
                                id="editar_M{{$marca->id}}"
                                data-toggle="modal"
                                data-target="#modalEditarArea"
                                data-id="{{$marca->id}}"
                                data-name="{{$marca->name}}"
                                data-codigo="{{$marca->codigo}}">
                            <span >Editar</span>
                        </button>
                        <button class="btn btn-sm btn-danger"
                                title="Borrar"
                                data-toggle="modal"
                                data-target="#modalBorrarArea"
                                data-id="{{$marca->id}}"
                                data-name="{{$marca->name}}">
                            <span >Borrar</span>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-----------------MODAL CREAR MARCA--------------------------------------->
        <div class="modal fade" id="modalCrearMarca" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background: #4986FC">
                        <h5 class="modal-title" style="color: white"><span class="fas fa-pencil-alt"></span> Agregar Área
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span style="color: white" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="{{route("creararea")}}" enctype="multipart/form-data">
                        @csrf
                    <div class="modal-body" style="object-fit: fill">
                        <div class="form-group">
                            <label for="name">Nombre Empresa:</label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror" name="name" id="name" maxlength="100"
                                   value="{{old('name')}}" required pattern="[a-zA-Z áéíóúñÑ]{2,254}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="codigo">Codigo:</label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror" name="codigo" id="codigo" maxlength="100"
                                   value="{{old('codigo')}}" required>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" >Crear</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-----------------------------MODA EDITAR MARCA------------------------------------>
        <div class="modal fade" id="modalEditarArea" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background: #4986FC">
                        <h5 class="modal-title" style="color: white"><span class="fas fa-pencil-alt"></span> Editar Empresa
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span style="color: white" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="{{route("editararea")}}" enctype="multipart/form-data">
                        @method('PUT');
                        @csrf
                        <div class="modal-body" style="object-fit: fill">
                            <div class="form-group">
                                <label for="name">Nombre Empresa:</label>
                                <input required="required" type="text"
                                       class="form-control @error('name') is-invalid @enderror" name="name" id="name" maxlength="30"
                                       value="{{old('name')}}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message}}</strong>
                            </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="codigo">Codigo:</label>
                                <input required="required" type="text"
                                       class="form-control @error('name') is-invalid @enderror" name="codigo" id="codigo" maxlength="30"
                                       value="{{old('codigo')}}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message}}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" id="id_marca">
                            <button type="submit" class="btn btn-success" >Editar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!--------------------------MODAL BORRAR MARCA----------------------------------->
        <div class="modal fade" id="modalBorrarArea" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <form method="post" action="{{route("borrararea")}}" enctype="multipart/form-data">
                        @method("DELETE")
                        @csrf
                        <div class="modal-header" style="background: #4986FC">
                            <h5 class="modal-title" style="color: white"><span class="fas fa-trash"></span> Borrar Área
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span style="color: white" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>¿Estás seguro que deseas borrar la Empresa <label
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


    </div>
    </section>

        </div>

@endsection
