<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\Exports\HistorialExport;
use App\Exports\PedidoExport;
use App\Pedido;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class HistorialController extends Controller
{ public function index(Request $request)
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
        ->where('estado','=','Entregado')->get();

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
        ->where('estado','=','Entregado')
        ->where("pedido","Like","%".$query."%")->get();

    $empresas = Empresa::all();
    return view('historial')->with('home3',$home3)->with('empresa',$empresas);
}

    public function destroy($id)
    {
        $home= Pedido::find($id);
        $home->delete();

        return redirect('/')->with('success', 'Datos Eliminados') ;

    }

    public function exportar(Request  $request)
    {
        return Excel::download(new HistorialExport, 'Historial-Pedidos.xlsx');



    }

}
