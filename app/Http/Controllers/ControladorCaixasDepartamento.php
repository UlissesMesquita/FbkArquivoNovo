<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Departamentos;
use App\Caixa_Departamento;
use Illuminate\Support\Facades\DB;

class ControladorCaixasDepartamento extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session()->get('autenticado') == 1) {



            $departamentos = Departamentos::orderBy('cad_departamento', 'ASC')->get();

            
            return view('forms_create.caixas', compact('departamentos'));
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



            
            $caixa = new Caixa_Departamento();

            
            $ordem_Lastcaixa = Caixa_Departamento::where('id_departamento', '=', $request->input('id_departamento'))->max('ordem');
            //dd($ordem_Lastcaixa);

            $caixa->id_departamento = $request->input('id_departamento');
            
            $caixa->id_departamento = $caixa->id_departamento;
            $caixa->ordem = $ordem_Lastcaixa + 1;


            Caixa_Departamento::where('id_departamento', $request->input('id_departamento'))->update(['status' => 'Fechada']);


            $caixa->save();

        return redirect(route('caixas'));
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
            

        $caixa = DB::table('caixa__departamentos')
            ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
            ->select('id_caixa', 'cad_departamento')
            ->where('id_caixa', '=', $id)
            ->orderBy('cad_departamento', 'ASC')
            ->get();

            
 
            $dep = Departamentos::all();

    
            return view('forms_edit/caixa_update', compact('caixa', 'id', 'dep'));
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


            $dep = new Departamentos();
            $dep->id_departamento = $request->input('Dep');

            Caixa_Departamento::where('id_caixa', $id)->update(['id_departamento' => $dep->id_departamento]);
            return redirect(route('caixas'));
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
       
    }

     public function fecharCaixa($id_caixa) {
        // dd($id_caixa);
        if(session()->get('autenticado') == 1) {
             Caixa_Departamento::where('id_caixa', $id_caixa)->update(['status' => 'Fechada']);
             return redirect(route('caixas'));
        }
        else {
             return redirect(route('index'));
         }
     }

     public function abrirCaixa($id_caixa) {
         if(session()->get('autenticado') == 1) {
            //  $caixa_aberta = Caixa_Departamento::where('status', '=', 'Aberta')->get();
            //  //dd($caixa_aberta->count());

            //  if ($caixa_aberta->count() >= 1) {
            //      echo "Feche a caixa que está aberta para poder abrir outra caixa";
            //      return redirect(route('caixas'));
            //  }
            //  else {
                 Caixa_Departamento::where('id_caixa', $id_caixa)->update(['status' => 'Aberta']);
                 return redirect(route('caixas'));
            //  }
          }
         else {
             return redirect(route('index'));
         }
          
     }

}


