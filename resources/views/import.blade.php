<!Doctype html>
<html>
<body  style="background-image: url('image/background.jpg')">
<script scr="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.mi.js"></script>
    <div class="container">
<br><br><br><br>
        <h2 align="center">Importar Pedidos</h2>
<div align="center">
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            Upload Validate Error <br><br>
            <ul>
                @foreach($error->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{$message}}</strong></div>
        @endif
    <form method="post" action="{{route('importData')}}" enctype="multipart/form-data">
{{csrf_field()}}
<div class="row">
    <br><br>
    <div class="col">
        <input type="file" name="excel" class="form-group btn-success" accept=".xlsx, .xls">
    </div>
    <br><br><br>
    <div class="col">
        <input type="submit" value="Importar" class="btn btn-success">
    </div>

</div>
</form>
</div>
    </div>
</body>
</html>
