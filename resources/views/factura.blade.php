
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>


<body >

    @foreach($home as $homedata)



    <table class="table">

        <thead>
        <tr></tr>
        <tr>
        <th> {{$homedata->nombreempresa}}</th>
        </tr>
        <tr></tr>
        <tr>
            <th scope="col">N° de Pedido</th>
            <th scope="col">Codigo de Unidad</th>
            <th scope="col">Descripción</th>
            <th scope="col">Nota</th>
            <th scope="col">Fecha Pedido</th>
            <th scope="col">Cantidad Entregada</th>
            <th scope="col">Cantidad Pendiente</th>
        </tr>
        </thead>
        <tbody>


            <tr>
                <td>{{$homedata->pedido}}</td>
                <td>{{$homedata->codigo}}</td>
                <td>{{$homedata->descripcion}}</td>
                <td>{{$homedata->nota}}</td>
                <td>{{$homedata->fecha_pedido}}</td>
                <td>{{$cantidad}}</td>
                <td>{{$homedata->cantidad_pendiente - $cantidad }}</td>
            </tr>



        </tbody>

    </table>
    @endforeach

</body>

</html>


