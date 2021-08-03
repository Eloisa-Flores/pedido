<?php

namespace App\Http\Controllers;




use App\Exports\DashboardExport;
use App\Exports\PedidoExport;
use App\Imports\PedidoImport;
use App\Pedido;
use App\PrestarLibro;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $
     * @return \Illuminate\Http\Response
     */


   public function index()
    {
        $home2 = Pedido::all();

        foreach ($home2 as $homes) {

            $home = DB::table("home")
                ->select("home.id"
                    , "home.dias"
                    , "home.fecha_requerida")
                ->where("home.id", "=", "$homes->id")->get();

            foreach ($home as $lib) {

//comparo las fechas que tiene que ser devuleto con la actual
                if ($lib->fecha_requerida >= Carbon::now()->format('Y-m-d')) {

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
        $home3 = Pedido::all();

         return view('home')->with('home3',$home3);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'pedido'=>'required',
            'codigo'=>'required',
            'descripcion'=>'required',
            'fabrica'=>'required',
            'nota'=>'required',
            'fecha_pedido'=>'required',
            'fecha_requerida'=>'required',
            'empaque'=>'required',
            'cantidad_original'=>'required',
            'cantidad_recibida'=>'required',
            'cantidad_pendiente'=>'required',
        ]);

        $home = new Pedido();
        $home->pedido = $request->input('pedido');
        $home->codigo = $request->input('codigo');
        $home->descripcion = $request->input('descripcion');
        $home->fabrica = $request->input('fabrica');
        $home->nota = $request->input('nota');
        $home->fecha_pedido = $request->input('fecha_pedido');
        $home->fecha_requerida = $request->input('fecha_requerida');
        $home->empaque = $request->input('empaque');
        $home->cantidad_original = $request->input('cantidad_original');
        $home->cantidad_recibida = $request->input('cantidad_recibida');
        $home->cantidad_pendiente = $request->input('cantidad_pendiente');
        $home->dias ='0';

        $home->save();

        return redirect('/home')->with('success', 'Datos Guardados') ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'pedido'=>'required',
            'codigo'=>'required',
            'descripcion'=>'required',
            'fabrica'=>'required',
            'nota'=>'required',
            'fecha_pedido'=>'required',
            'fecha_requerida'=>'required',
            'empaque'=>'required',
            'cantidad_original'=>'required',
            'cantidad_recibida'=>'required',
            'cantidad_pendiente'=>'required',
        ]);

        $home = new Pedido();
        $home->pedido = $request->input('pedido');
        $home->codigo = $request->input('codigo');
        $home->descripcion = $request->input('descripcion');
        $home->fabrica = $request->input('fabrica');
        $home->nota = $request->input('nota');
        $home->fecha_pedido = $request->input('fecha_pedido');
        $home->fecha_requerida = $request->input('fecha_requerida');
        $home->empaque = $request->input('empaque');
        $home->cantidad_original = $request->input('cantidad_original');
        $home->cantidad_recibida = $request->input('cantidad_recibida');
        $home->cantidad_pendiente = $request->input('cantidad_pendiente');


        $home->save();

        return redirect('/home')->with('success', 'Datos Actualizados') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $home= Pedido::find($id);
        $home->delete();

        return redirect('/home')->with('success', 'Datos Eliminados') ;

    }
    public function exportar(Request  $request)
    {
        return Excel::download(new PedidoExport, 'users.xlsx');



    }

    public function import()
    {
       return view('import');
    }
    public function importData(Request $request){
      $this->validate($request,[
          'excel'=>'required|mimes:xls,xlsx'
      ]);
      $path = $request->file('excel')->getRealPath();
       $data = Excel::import(new PedidoImport, $path)->get();
       if ($data->count() > 0 )
       {
           foreach ($data->toArray() as $key => $value)
           {
               foreach ($value as $homedata) {
                   $insert_data[] = array (

                       'pedido' => $homedata['pedido'],
                       'codigo' => $homedata['codigo'],
                       'descripcion' => $homedata['descripcion'],
                       'fabrica' => $homedata['fabrica'],
                       'nota' => $homedata ['nota'],
                       'fecha_pedido' => $homedata['fecha_pedido'],
                       'fecha_requerida' => $homedata['fecha_requerida'],
                       'empaque' => $homedata['empaque'],
                       'cantidad_original' => $homedata['cantidad_original'],
                       'cantidad_recibida' => $homedata['cantidad_recibida'],
                       'cantidad_pendiente' => $homedata['cantidad_pendiente '],


               );

                   $homedata->home()->create([
                       'id' =>$request->id,
                   ]);
               }
           }
           if (!empty($insert_data)){
               DB::table('home')->insert($insert_data);
           }
       }
       return back()->with('success', 'Excel Data Imported successfully.');
    }


    }
