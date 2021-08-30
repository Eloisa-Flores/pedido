
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
        <tr align="left">
            <th colspan="3"></th>
            <th colspan="2" align="left">Factura:</th>
            <tr>
            <th colspan="3"></th>
            <th colspan="2" align="left">Invoce:</th> </tr>
        <tr>
            <th colspan="3" rowspan="3" align="center" style="font-weight: bold" size="15px"> {{$homedata->nombreempresa}} </th>
        </tr>
        <tr></tr>
        <tr>
            <tr> <th colspan="2" align="center">Dirección:               </th> </tr>
            <tr> <th colspan="2" align="center">Address:                 </th> </tr>
            <tr> <th colspan="2" align="center">Phone &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tel. (504) 2763-2906</th> </tr>
            <tr> <th colspan="2" align="center">Fax. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fax. (504) 2763-2239  </th> </tr>
        <tr></tr>
        <tr align="rigth">
            <th colspan="2" align="rigth">Vendido a:</th>

            <tr align="rigth">
            <th colspan="2" align="rigth">Sold to: </th>
            <th colspan="2">Fecha: </th>
            <tr align="rigth">
            <th colspan="2" align="rigth">Dirección:</th>
            <th colspan="2" >Date: </th>
            <tr align="rigth">
            <th colspan="2" align="rigth">Address:</th>
            <th colspan="2" >Su Orden N°: </th>

       <tr> <th colspan="2"></th>
            <th colspan="2" >Your Order N°: </th>          </tr>
        <tr> <th colspan="2"></th>
            <th colspan="2" >Instrucciones de Embarque: </th>  </tr>

        <tr> <th colspan="2"></th>
            <th colspan="2" >Shipping instructions:  </th> </tr>

        <tr> <th colspan="2"></th>
            <th colspan="2" >Notificar a:</th>  </tr>

        <tr> <th colspan="2"></th>
            <th colspan="2" >Notify to: </th>   </tr>

        <tr> <th colspan="2"></th>
            <th colspan="2" >Consignado a: </th> </tr>

        <tr> <th colspan="2"></th>
            <th colspan="2" >Consigned to: </th>  </tr>

      <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr >
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
                <td>{{$homedata->cantidad_recibida}}</td>
                <td>{{$homedata->cantidad_pendiente  }}</td>
            </tr>



        </tbody>

    </table>
    @endforeach

</body>

</html>


