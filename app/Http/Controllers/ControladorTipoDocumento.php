<?php

namespace App\Http\Controllers;


use App\TipoDocumento;
use http\Header;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ControladorTipoDocumento extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function index()
    {
        if(session()->get('autenticado') == 1) {
            $tp_documento = TipoDocumento::orderBy('tp_documento', 'ASC')->get();
            return view('forms_create/tp_documento', compact('tp_documento'));
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
            $tp_documento = new TipoDocumento();
            $tp_documento->tp_documento = $request->input('tp_documento');
            $tp_documento->save();

            if ($tp_documento->save() == TRUE) {
                echo "<div class='alert-success' align='center'> O Tipo de Documento foi cadastrado com sucesso</div> ";
                return redirect(route('tp_documento_index'));
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
            $edit = TipoDocumento::find($id);
            return view('forms_edit/tp_documento_update', compact('edit'));
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
            $tp_documento = new TipoDocumento();
            $tp_documento->tp_documento = $request->input('tp_documento');
            TipoDocumento::where('id_tp_documento', $id)->update(['tp_documento' => $tp_documento->tp_documento]);
            return redirect(route('tp_documento_index'));
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
            $tp_documento = TipoDocumento::find($id);
            $tp_documento->delete();
            return redirect(route('tp_documento_index'));
        }
        else {
            return redirect(route('index'));
        }
    }
}
