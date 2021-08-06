
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Control de Pedidos</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="icon" type="image/png" href="/image/pedido.jpg" />
    <style>
        body {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Roboto', sans-serif;
        }
        .table-responsive {
            margin: 30px 0;
        }
        .table-wrapper {
            width: 850px;
            background: #fff;
            margin: 0 auto;
            padding: 20px 30px 5px;
            box-shadow: 0 0 1px 0 rgba(0,0,0,.25);
        }
        .table-title .btn-group {
            float: right;
        }
        .table-title .btn {
            min-width: 50px;
            border-radius: 2px;
            border: none;
            padding: 6px 12px;
            font-size: 95%;
            outline: none !important;
            height: 30px;
        }
        .table-title {
            min-width: 100%;
            border-bottom: 1px solid #e9e9e9;
            padding-bottom: 15px;
            margin-bottom: 5px;
            background: rgb(81, 188, 172);
            margin: -20px -31px 10px;
            padding: 15px 30px;
            color: #fff;
        }
        .table-title h2 {
            margin: 2px 0 0;
            font-size: 24px;
        }
        table.table {
            min-width: 100%;
        }
        table.table tr th, table.table tr td {
            border-color: #e9e9e9;
            padding: 12px 15px;
            vertical-align: middle;
        }
        table.table tr th:first-child {
            width: 40px;
        }
        table.table tr th:last-child {
            width: 100px;
        }
        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }
        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }
        table.table td a {
            color: #2196f3;
        }
        table.table td .btn.manage {
            padding: 2px 10px;
            background: #37BC9B;
            color: #fff;
            border-radius: 2px;
        }
        table.table td .btn.manage:hover {
            background: #2e9c81;
        }
    </style>
    <script>
        $(document).ready(function(){
            $(".btn-group .btn").click(function(){
                var inputValue = $(this).find("input").val();
                if(inputValue != 'all'){
                    var target = $('table tr[data-status="' + inputValue + '"]');
                    $("table tbody tr").not(target).hide();
                    target.fadeIn();
                } else {
                    $("table tbody tr").fadeIn();
                }
            });
            // Changing the class of status label to support Bootstrap 4
            var bs = $.fn.tooltip.Constructor.VERSION;
            var str = bs.split(".");
            if(str[0] == 4){
                $(".label").each(function(){
                    var classStr = $(this).attr("class");
                    var newClassStr = classStr.replace(/label/g, "badge");
                    $(this).removeAttr("class").addClass(newClassStr);
                });
            }
        });
    </script>
</head>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Nuevo Dato
</button>

<body style="background-image: url('diseno/images/a3.jpg')">
<div class="container">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-12"><h2><b>Control de Pedidos</b></h2></div>
                    <div class="col-sm-12">
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-info active">
                                <input type="radio" name="status" value="all" checked="checked"> Todos
                            </label>
                            <label class="btn btn-success">
                                <input type="radio" name="status" value="active">  Pendientes
                            </label>
                            <label class="btn btn-warning">
                                <input type="radio" name="status" value="inactive" >  Terminados
                            </label>
                            <label class="btn btn-danger">
                                <input type="radio" name="status" value="expired">  Enviados
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover ">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Fecha de Solicitud</th>
                    <th>Fecha de Entrega</th>
                    <th>Domain</th>
                    <th>Created&nbsp;On</th>
                    <th>Status</th>
                    <th>Server&nbsp;Location</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <tr data-status="active">
                    <td>1</td>
                    <td><a href="#">loremvallis.com</a></td>
                    <td>04/10/2013</td>
                    <td><span class="label label-success">Active</span></td>
                    <td>Buenos Aires</td>
                    <td><a href="#" class="btn btn-sm manage">Manage</a></td>
                </tr>
                @foreach($dashboar as $datadasboard)
                    <tr>
                        <th>{{$datadasboard->id}}</th>
                        <th>{{$datadasboard->fecha_solicitud}}</th>
                        <th>{{$datadasboard->fecha_entrega}}</th>
                        <th>{{$datadasboard->domain}}</th>
                        <th>{{$datadasboard->created_on}}</th>
                        <th>{{$datadasboard->status}}</th>
                        <th>{{$datadasboard->server_location}}</th>
<td>
                        <a href="#" class="btn btn-success edit">Editar</a>
                        <a href="#" class="btn btn-danger delete" >Eliminar</a>
</td>
                </tbody>
            </table>

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
<form action="{{action('DashboardController@store')}}" method="POST">

  {{csrf_field()}}
  <div class="modal-body">
  <div class="form-group">
  <label >Fecha de Entrada</label>
 <input type="date" class="form-control" name="fecha_entrada"  placeholder="Ingrese la fecha de entrada">
</div>
 <div class="form-group">
<label >Fecha Entrega</label>
 <input type="date" class="form-control"  name="fecha_entrega" placeholder="Ingrese la fecha de entrega">
 </div>
 <div class="form-group">
 <label >Procedencia</label>
 <input type="text" class="form-control" name="procedencia" placeholder="Ingrese la Procedencia">
 </div>
 <div class="form-group">
 <label >Destino</label>
 <input type="text" class="form-control"  name="destino" placeholder="Ingreso el destino">
 </div>
 <div class="form-group">
 <label >Entrada</label>
 <input type="text" class="form-control" name="entrada" placeholder="Ingrese la entrada">
 </div>
 <div class="form-group">
 <label >Salida</label>
 <input type="text" class="form-control" name="salida"  placeholder="Ingrese la salida">
  </div>
  <div class="form-group">
  <label >Existencia</label>
  <input type="text" class="form-control"  name="existencia" placeholder="Ingrese la existencia">
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
                                    <label >Mes</label>
                                    <input type="date" class="form-control" name="mes" id="mes" placeholder="Ingrese el mes">

                                </div>
                                <div class="form-group">
                                    <label >Remisión</label>
                                    <input type="text" class="form-control"  name="remisión" id="remisión" placeholder="Ingrese el numero de remisión">
                                </div>
                                <div class="form-group">
                                    <label >Procedencia</label>
                                    <input type="text" class="form-control" name="procedencia" id="procedencia" placeholder="Ingrese la Procedencia">
                                </div>
                                <div class="form-group">
                                    <label >Destino</label>
                                    <input type="text" class="form-control"  name="destino" id="destino"  placeholder="Ingreso el destino">
                                </div>
                                <div class="form-group">
                                    <label >Entrada</label>
                                    <input type="text" class="form-control" name="entrada" id="entrada" placeholder="Ingrese la entrada">
                                </div>
                                <div class="form-group">
                                    <label >Salida</label>
                                    <input type="text" class="form-control" name="salida" id="salida" placeholder="Ingrese la salida">
                                </div>
                                <div class="form-group">
                                    <label >Existencia</label>
                                    <input type="text" class="form-control"  name="existencia" id="existencia" placeholder="Ingrese la existencia">
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

                        <form action="/ligero_colombia" method="POST" id="deleteForm">

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










        </div>
    </div>
</div>
</body>
</html>
