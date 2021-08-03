<?php

namespace App\Imports;

use App\Pedido;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;



class PedidoImport implements  ToCollection,ToModel,WithHeadingRow

{

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {

        return new Pedido([
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
            //
        ]);
    }

    public function Collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Pedido::Create([

            ]);

        }
    }

}
