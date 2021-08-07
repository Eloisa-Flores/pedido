<?php

namespace App\Http\Controllers;

use App\Area;
use App\Empresa;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function index(Request $request)
    {
        if ($request){
            $query  = trim($request->get('search'));
            $area = Empresa::where("name","like","%".$query."%")->orderby("name")->get();

            return view('General.empresa')
                ->withArea($area)
                ->withNoPagina(1);
        }
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //crear
    public function store(Request $request)
    {
        $area = new Empresa();
        $area->name =$request->input("name");
        $area->codigo =$request->input("codigo");

        $name = $request->input("name");

        $area->save();
        return redirect()->route("verarea")->withExito("Empresa creada correctamente");
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //editar
    public function edit(Request $request)
    {
        $name=Empresa::where("name",$request->input("name"))->Where("id","!=",$request->input("id"))->first();


        if ($name!=null){
            try {
                $this->validate($request,[
                    'name'=>'required',
                ],$messages=[

                ]);
                $id=$request->input("id");
                $editar = Empresa::findOrFail($id);
                $editar->name=$request->input("name");
                $editar->codigo=$request->input("codigo");
                $editar->save();
                return redirect()->route("verarea")->withExito("Empresa editada correctamente");
            }catch (ValidationException $exception){
                return redirect()->route("verarea")->with('errores','errores')->with('id',$request->input("id"))->winthErrors($exception->errors());
            }
        }else {
            try {
                $this->validate($request, [
                    'name' => 'required',
                ], $messages = [
                    'name.required' => 'El nombre es Requerida',
                    'name.unique' => 'El nombre debe ser unico',
                    'name.max:40' => 'El nombre no puede exceder 40 caracteres',
                    'name.string' => 'El nombre no deben ser solamente numero',
                ]);
                $id = $request->input("id");
                $editar = Empresa::findOrFail($id);
                $editar->name = $request->input("name");
                $editar->codigo = $request->input("codigo");

                $editar->save();
                return redirect()->route("verarea")->withExito("Empresa editada correctamente");
            } catch (ValidationException $exception) {
                return redirect()->route("verarea")->with('errores', 'errores')->with('id', $request->input("id"))->winthErrors($exception->errors());
            }
        }//
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    //borar
    public function destroy (Request $request)
    {
        $id=$request->input("id");
        $borrar = Empresa::findOrFail($id);

        $borrar->delete();
        return redirect()->route("verarea")->withExito("Empresa borrada con exito");
        //
    }
}
