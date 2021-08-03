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
        $data = [];
        foreach ($rows as $row) {
            $data::Create([
                'pedido' => $row[0],
                'codigo' => $row[1],
                'descripcion' => $row[2],
                'fabrica' => $row[3],
                'nota' => $row[4],
                'fecha_pedido' => $row[5],
                'fecha_requerida' => $row[6],
                'empaque' => $row[7],
                'cantidad_original' => $row[8],
                'cantidad_recibida' => $row[9],
                'cantidad_pendiente' => $row[10],
            ]);

        }
        DB::table('home')->insert($data);
    }

}
