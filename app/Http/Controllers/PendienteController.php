<?php

namespace App\Http\Controllers;

use App\Exports\LibrosPendientesExports;
use App\Libro;
use App\PrestarLibro;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendienteController extends Controller
{
    public function index2(Request $request)
    {
        if ($request){
            $query = trim($request->get("search"));
            $fecha1 = trim($request->get("fecha1"));
            $fecha2 = trim($request->get("fecha2"));

        }
        $prestalibro=DB::table("home")
            ->leftJoin("home","home.id_pendientes","=","pendientes.id")
            ->leftJoin("users","prestar_libros.id_user","=","users.id")
            ->select("home.id","pendientes.name AS nombre_pendiente",
                "home.pedido",
                "home.codigo",
                "home.descripcion "
                ,"home.fabrica"
                ,"home.cantidad_pendiente"
                ,"home.dias")
            ->where("home.name","Like","%".$query."%")
            ->where("home.estado","=","Pendientes")
            ->orderBy("nombre_pendiente")
            ->paginate(1000);


        foreach ($prestalibro as $presta) {
            $prestalibros = DB::table("prestar_libros")
                ->leftJoin("libros", "prestar_libros.id_libro", "=", "libros.id")
                ->leftJoin("users", "prestar_libros.id_user", "=", "users.id")
                ->select("prestar_libros.id", "libros.name AS nombre_libro",
                    "prestar_libros.id_libro",
                    "prestar_libros.id_user", "users.name as nombre_usuario",
                    "users.email as email_usuario", "users.codigo as codigo_usuario", "users.genero as genero_usuario",
                    "users.telefono as telefono_usuario", "users.foto as foto_usuario",
                    "libros.tema AS tema_libro","libros.foto AS foto_libro","libros.autor AS autor_libro",
                    "prestar_libros.fechadevolucion"
                    , "prestar_libros.total"
                    , "prestar_libros.diasf")
                ->where("prestar_libros.id", "=", "$presta->id")->get();
            foreach ($prestalibros as $lib) {

//comparo las fechas que tiene que ser devuleto con la actual
                if ($presta->fechadevolucion >= Carbon::now()->format('Y-m-d')) {

                    $cantidadDias = Carbon::parse($presta->fechadevolucion)->diffInDays();


                    //y la inserto en los dias de diferencia
                    $diferenciadias = PrestarLibro::findOrFail($lib->id);
                    $diferenciadias->diasf = -($cantidadDias+1);
                    $diferenciadias->save();

                }else{
                    $cantidadDias = Carbon::parse($presta->fechadevolucion)->diffInDays();


                    //y la inserto en los dias de diferencia
                    $diferenciadias = PrestarLibro::findOrFail($lib->id);
                    $diferenciadias->diasf = $cantidadDias+1;
                    $diferenciadias->estado = "Pendientes";
                    $diferenciadias->save();
                }
            }
        }
        $prestalibro=DB::table("prestar_libros")
            ->leftJoin("libros","prestar_libros.id_libro","=","libros.id")
            ->leftJoin("users","prestar_libros.id_user","=","users.id")
            ->select("prestar_libros.id","libros.name AS nombre_libro",
                "prestar_libros.id_libro",
                "prestar_libros.id_user","users.name as nombre_usuario",
                "users.email as email_usuario", "users.codigo as codigo_usuario", "users.genero as genero_usuario",
                "users.telefono as telefono_usuario", "users.foto as foto_usuario",
                "libros.tema AS tema_libro","libros.foto AS foto_libro","libros.autor AS autor_libro",
                "prestar_libros.fechadevolucion"
                ,"prestar_libros.total"
                ,"prestar_libros.estado"
                ,"prestar_libros.diasf")
            ->where("users.name","Like","%".$query."%")
            ->where("prestar_libros.estado","=","Pendientes")
            ->when($fecha1 && $fecha2, function ($query) use ($fecha1, $fecha2) {
                $query->whereBetween('prestar_libros.created_at', [$fecha1, $fecha2]);})
            ->orderBy("nombre_libro")
            ->paginate(1000);
        $libros= Libro::all()->where("total",">","0");
        $user= User::all()->where("activo","=","1");

        $entregaCapass=DB::table("prestar_libros")
            ->leftJoin("libros","prestar_libros.id_libro","=","libros.id")
            ->leftJoin("users","prestar_libros.id_user","=","users.id")
            ->selectRaw("SUM(prestar_libros.total) as total_capa")
            ->where("libros.name","Like","%".$query."%")
            ->where("prestar_libros.estado","=","Pendientes")
            ->when($fecha1 && $fecha2, function ($query) use ($fecha1, $fecha2) {
                $query->whereBetween('prestar_libros.created_at', [$fecha1, $fecha2]);})
            ->get();

        return view("PrestarLibro.pendientelibro")
            ->withNoPagina(1)
            ->withTotal($entregaCapass)
            ->withPrestalibro($prestalibro)
            ->withUser($user)
            ->withLibro($libros);



        //
    }

    public function destroy2(Request $request)
    {


        $id = $request->input('id');
        $borrar = PrestarLibro::findOrFail($id);
        $ids =$borrar->id_libro;
        $total = $borrar->total;
        DB::table('libros')->where("libros.id", "=",$ids)->increment('total',$total);
        $borrar->estado = 'Devuelto';
        $borrar->save();
        return redirect()->route("LibroPendiente")->withExito("Se recibio  la entrega satisfactoriamente");
    }


    public function export2(Request $request)
    {
        $fecha1 = $request->get("fecha1");
        $fecha2 = $request->get("fecha2");
        return (new LibrosPendientesExports($fecha1,$fecha2))->download('Listado de Libros Pendientes'.$fecha1.'a'.$fecha2.'.xlsx', \Maatwebsite\Excel\Excel::XLSX);

    }


}
