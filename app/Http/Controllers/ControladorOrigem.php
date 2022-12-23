<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Origens;

class ControladorOrigem extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response    
     */
    public function index()
    {
        

        if(session()->get('autenticado') == 1) {
            
            $origem = Origens::orderBy('cad_origem', 'ASC')->get();
            return view('forms_create/origens', compact('origem'));
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
            $ori = new Origens();
            $ori->cad_origem = $request->input('cad_origem');
            $ori->save();

            if ($ori->save() == TRUE) {
                echo "<div class='alert-success' align='center'> Origens cadastrada com sucesso</div> ";
                return redirect(route('origem_index'));
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
            $edit = Origens::find($id);
            return view('forms_edit/origens_update', compact('edit'));

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
            $ori = new Origens();
            $ori->cad_origem = $request->input('cad_origem');
            Origens::where('id_origem', $id)->update(['cad_origem' => $ori->cad_origem]);
            return redirect(route('origem_index'));
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
            $origen = Origens::find($id);
            $origen->delete();
            return redirect(route('origem_index'));
        }
        else {
            return redirect(route('index'));
        }
    }
}
