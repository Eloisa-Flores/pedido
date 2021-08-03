<?php

namespace App\Imports;

use App\Pedido;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;

class PedidosImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pedido([
            'pedido' => $row[0],
            'codigo' => $row[1],
            'descripcion' => $row[2],
            'fabrica' => $row[3],
            'nota' => $row[4],
            'fecha_pedido' => Carbon::parse($row[5])->format('Y-m-d'),
            'fecha_requerida' => Carbon::parse($row[6])->format('Y-m-d'),
            'empaque' => $row[7],
            'cantidad_original' => $row[8],
            'cantidad_recibida' => $row[9],
            'cantidad_pendiente' => $row[10],
        ]);
    }
}
