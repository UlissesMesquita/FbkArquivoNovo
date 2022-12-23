<?php

namespace App\Http\Controllers;

use App\Empresas_Destinatarias;
use Illuminate\Http\Request;

class ControladorDestinataria extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session()->get('autenticado') == 1) {

            $destinatarias = Empresas_Destinatarias::orderBy('cad_destinatarias', 'ASC')->get();
            return view('forms_create/empresas_destinatarias', compact('destinatarias'));
        }
        else {
            return redirect(route('index'));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(session()->get('autenticado') == 1) {
            $dest = new Empresas_Destinatarias();
            $dest->cad_destinatarias = $request->input('cad_destinatarias');
            $dest->save();

                if ($dest->save() == TRUE) {

                    echo "<div class='alert-success' align='center'> Empresa Cadastrada com sucesso</div> ";
                    return redirect(route('destinataria_index'));
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
        if(session()->get('autenticado') == 1) {
            $edit = Empresas_Destinatarias::find($id);
            return view('forms_edit/destinatarias_update', compact('edit'));
        }
        else {
            return redirect(route('index'));
        }
        
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
        if(session()->get('autenticado') == 1) {
            $dest = new Empresas_Destinatarias();
            $dest->cad_destinatarias = $request->input('cad_destinatarias');

            Empresas_Destinatarias::where('id_empresa_destinataria', $id)->update(['cad_destinatarias' => $dest->cad_destinatarias]);
            return redirect(route('destinataria_index'));
        }
        else {
            return redirect(route('index'));
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(session()->get('autenticado') == 1) {
            $destinataria = Empresas_Destinatarias::find($id);
            $destinataria->delete();

            return redirect(route('destinataria_index'));
        }
        else {
            return redirect(route('index'));
        }
        
    }
}
