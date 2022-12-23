<?php

namespace App\Http\Controllers;

use App\Cadastro_Documentos;
use App\Empresas_Emitentes;
use App\Origens;
use http\Header;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ControladorEmitente extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function index()
    {
        

    if(session()->get('autenticado') == 1) {
        $emit = Empresas_Emitentes::orderBy('cad_emitentes', 'ASC')->get();
        return view('forms_create/empresas_emitentes', compact('emit'));
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
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function store(Request $request)
    {


        if(session()->get('autenticado') == 1) {
            $emi = new Empresas_Emitentes();
            $emi->cad_emitentes = $request->input('cad_emitentes');
            $emi->save();
    
            if ($emi->save() == TRUE) {
                echo "<div class='alert-success' align='center'> Empresa Emitente cadastrada com sucesso</div> ";
                return redirect(route('emitente_index'));
            }
        }
        else {
            return redirect(route('index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
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
            $edit = Empresas_Emitentes::find($id);
            return view('forms_edit/empresas_emitentes_update', compact('edit'));
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
            $emi = new Empresas_Emitentes();
            $emi->cad_emitentes = $request->input('cad_emitentes');
            Empresas_Emitentes::where('id_empresa_emitente', $id)->update(['cad_emitentes' => $emi->cad_emitentes]);
            return redirect(route('emitente_index'));
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
            $emitente = Empresas_Emitentes::find($id);
            $emitente->delete();
    
            return redirect(route('emitente_index'));
        }
        else {
            return redirect(route('index'));
        }
    }
}
