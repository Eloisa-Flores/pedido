<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class FacturaPendienteExport implements FromView ,ShouldAutoSize
{

    use Exportable;
    public  $id;

    public function __construct(  string $id)
    {

        $this->id = $id;
    }

    public function view(): View
    {
        $home=DB::table("home")
            ->leftJoin("empresas","home.fabrica","=","empresas.codigo")
            ->select("empresas.name as nombreempresa",
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
                "home.created_at")
            ->where('home.id','=',$this->id)->get();
        return view('facturaP')->withHome($home);
    }

}
