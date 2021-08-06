<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\Exports\HistorialExport;
use App\Exports\LibrosPendientesExports;
use App\Exports\PendienteExport;
use App\Libro;
use App\Pedido;
use App\PrestarLibro;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PendienteController extends Controller
{

    public function index(Request $request)
    {

        if ($request){
            $query = trim($request->get("search"));
        }
        $home2 = DB::table("home")
            ->leftJoin("empresas","home.codigo","=","empresas.codigo")
            ->select("home.id",
                "home.estado",
                "home.pedido",
                "home.codigo",
                "home.descripcion",
                "home.fabrica",
                "home.nota",
                "home.fecha_pedido",
                "home.fecha_requerida",
                "home.empaque",
                "home.cantidad_original",
                "home.cantidad_recibida",
                "home.cantidad_pendiente",
                "home.dias")
            ->where('estado','=','Pendiente')->get();

        foreach ($home2 as $homes) {

            $home = DB::table("home")
                ->select("home.id"
                    , "home.dias"
                    , "home.fecha_requerida")
                ->where("home.id", "=", "$homes->id")->get();

            foreach ($home as $lib) {

//comparo las fechas que tiene que ser devuleto con la actual
                if ($lib->fecha_requerida >= Carbon::now()) {

                    $cantidadDias = Carbon::parse($lib->fecha_requerida)->diffInDays();


                    //y la inserto en los dias de diferencia
                    $diferenciadias = Pedido::findOrFail($lib->id);
                    $diferenciadias->dias = -($cantidadDias + 1);
                    $diferenciadias->save();

                } else {
                    $cantidadDias = Carbon::parse($lib->fecha_requerida)->diffInDays();


                    //y la inserto en los dias de diferencia
                    $diferenciadias = Pedido::findOrFail($lib->id);
                    $diferenciadias->dias = $cantidadDias + 1;
                    $diferenciadias->save();
                }
            }
        }
        $home3 = DB::table("home")
            ->leftJoin("empresas","home.codigo","=","empresas.codigo")
            ->select("home.id",
                "home.estado",
                "home.pedido",
                "home.codigo",
                "home.descripcion",
                "home.fabrica",
                "home.nota",
                "home.fecha_pedido",
                "home.fecha_requerida",
                "home.empaque",
                "home.cantidad_original",
                "home.cantidad_recibida",
                "home.cantidad_pendiente",
                "home.dias")
            ->where('estado','=','Pendiente')
            ->where("pedido","Like","%".$query."%")->get();

        $empresas = Empresa::all();
        return view('pendientes')->with('home3',$home3)->with('empresa',$empresas);
    }

    public function entrega (Request $request){
        $cantidad = $request->input('cantidad');

        $id = $request->input('id');

        $home3 = DB::table("home")
            ->leftJoin("empresas","home.codigo","=","empresas.codigo")
            ->select("home.id",
                "home.estado", "home.pedido", "home.codigo", "home.descripcion", "home.fabrica", "home.nota", "home.fecha_pedido",
                "home.fecha_requerida", "home.empaque", "home.cantidad_original", "home.cantidad_recibida", "home.cantidad_pendiente",
                "home.dias",   "home.estado")
            ->where('home.id','=',$id)->get();

        foreach ($home3 as $h){
            if ($h->cantidad_pendiente == $cantidad){
                $home =  Pedido::findOrFail($id);
                $home->cantidad_recibida =+ $cantidad;
                $home->cantidad_pendiente = 0;
                $home->estado = 'Entregado';
                $home->save();

                return redirect('/pendientes')->withExito( 'Entrega Realizada Exitosamente ') ;
            }


            if ($h->cantidad_pendiente > $cantidad) {
                $home = Pedido::findOrFail($id);

                $home->cantidad_original = $h->cantidad_original ;
                $home->cantidad_recibida =+$cantidad;
                $home->cantidad_pendiente =($h->cantidad_original - $cantidad);
                $home->estado = 'Pendiente';
                $home->save();

                return redirect('/pendientes')->withExito('Una Parte de la entrega fue realizada exitosamente ');
            }
            if ($h->cantidad_pendiente < $cantidad) {

                return redirect('/pendientes')->withError('La cantidad no puede ser mayor a la Pendiente');
            }
        }




    }

    public function exportar(Request  $request)
    {
        return Excel::download(new PendienteExport, 'Pedidos-Pendientes.xlsx');

    }


}
