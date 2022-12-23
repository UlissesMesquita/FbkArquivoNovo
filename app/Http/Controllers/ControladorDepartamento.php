<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departamentos;
use Illuminate\Http\Response;

class ControladorDepartamento extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(){

        if(session()->get('autenticado') == 1) {
            $departamentos = Departamentos::orderBy('cad_departamento', 'ASC')->get();
            return view('forms_create.departamentos', compact('departamentos'));
        }
        else {
            return redirect(route('index'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        if(session()->get('autenticado') == 1) {
            $dep = new Departamentos();
            $dep->cad_departamento = $request->input('cad_departamento');
            $dep->save();

        return redirect(route('departamento_index'));
        }
        else {
            return redirect(route('index'));
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if(session()->get('autenticado') == 1) {
            $dep_edit = Departamentos::find($id);
            return view('forms_edit/departamentos_update', compact('dep_edit'));
        }
        else {
            return redirect(route('index'));
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        if(session()->get('autenticado') == 1) {
            $dep = new Departamentos();
            $dep->cad_departamento = $request->input('cad_departamento');

            Departamentos::where('id_departamento', $id)->update(['cad_departamento' => $dep->cad_departamento]);
            return redirect(route('departamento_index'));
        }
        else {
            return redirect(route('index'));
        }

        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if(session()->get('autenticado') == 1) {
            $departament = Departamentos::find($id);
            $departament->delete();
            return redirect(route('departamento_index'));
        }
        else {
            return redirect(route('index'));
        }
        
    }
}
