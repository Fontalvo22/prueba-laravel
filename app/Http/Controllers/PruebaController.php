<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prueba;

class PruebaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataSet=Prueba::all();
        return view('prueba.index', ['data' => $dataSet]);
    }

    public function store(Request $request)
    {
        $prueba = new Prueba;

        $prueba->email=$request->email;
        $prueba->first_name=$request->first_name;
        $prueba->last_name=$request->last_name;
        $prueba->n_document=$request->n_document;
        $prueba->phone_number=$request->phone_number;

        $validation = $request->validate([
            'email' => 'required|unique:pruebas',
            'first_name' => 'required',
            'last_name' => 'required',
            'n_document' => 'required|unique:pruebas',
            'phone_number' => 'required|unique:pruebas',
        ]);

        try {
        
            $prueba->save();
        
            return redirect()->back()->with('message', 'registro creado con exito');
        
        } catch (Exception $e) {
            return redirect()->back()->with('errorMessage', 'Ha habido un error: '. $e->getMessage());

        }
    }

    public function update(Request $request, $id)
    {
        $prueba = Prueba::find($id);
        if (isset($request->email)) {
            $prueba->email = $request->email;
        }

        if (isset($request->first_name)) {
            $prueba->first_name = $request->first_name;
        }
        
        if (isset($request->last_name)) {
            $prueba->last_name = $request->last_name;
        }
        
        if (isset($request->n_document)) {
            $prueba->n_document = $request->n_document;
        }
        
        if (isset($request->phone_number)) {
            $prueba->phone_number = $request->phone_number;
        }

        try {
        
            $prueba->update();
        
            return redirect()->back()->with('message', 'registro actualizado con exito');
        
        } catch (Exception $e) {
            return redirect()->back()->with('errorMessage', 'Ha habido un error: '. $e->getMessage());

        }
    }

    public function destroy($id)
    {
        $prueba=Prueba::find($id);
        $prueba->delete();

        return redirect()->back()->with('message', 'registro eliminado con exito');
    }
}
