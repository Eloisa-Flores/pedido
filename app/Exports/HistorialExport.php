<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HistorialExport implements FromCollection ,ShouldAutoSize,  WithHeadings
{
    use \Maatwebsite\Excel\Concerns\Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $home=DB::table("home")

            ->select("home.pedido",
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
            ->where('home.estado','=','Entregado')
            ->orderBy("pedido")->get();

        return $home;
    }


    public function headings():array
    {
        return [
            [

                'pedido',
                'codigo',
                'descripcion',
                'fabrica',
                'nota',
                'fecha_pedido',
                'fecha_requerida',
                'empaque',
                'cantidad_original',
                'cantidad_recibida',
                'cantidad_pendiente',
                'Fecha Creacion',

            ] ]  ;
    }
}
