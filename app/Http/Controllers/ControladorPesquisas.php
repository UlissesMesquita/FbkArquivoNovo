<?php

namespace App\Http\Controllers;

use App\Cadastro_Documentos;
use App\Empresas_Destinatarias;
use App\Empresas_Emitentes;
use App\Departamentos;
use App\Pesquisas;
use App\Job;
use App\TipoDocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ControladorPesquisas extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(session()->get('autenticado') == 1) {
            
            
            $emit = Empresas_Emitentes::orderBy('cad_emitentes', 'ASC')->get();
            $dep = Departamentos::orderBy('cad_departamento', 'ASC')->get();
            $dest = Empresas_Destinatarias::orderBy('cad_destinatarias', 'ASC')->get();
            if(session()->get('permissao') == 'Admin' || session()->get('departamento') == 'DIRETORIA') {
                //Query para utilização sem paginação
                    //$dash = Cadastro_Documentos::all()->sortByDesc('id_codigo');
                //Query para apaginação
                $dash = Cadastro_Documentos::orderBy('id_codigo', 'DESC')->Paginate(50);
                //$dash = Cadastro_Documentos::paginate();
                
                
            }
            else {
                //Query para utilização com paginação
                $dash = Cadastro_Documentos::orderBy('id_codigo', 'DESC')->where('Dep' ,'=', session()->get('departamento'))->Paginate(50);

                


                //Query para utilização sem paginação
                //$dash = Cadastro_Documentos::all()->where('Dep' ,'=', session()->get('departamento'))->sortByDesc('id_codigo');
                
            }

            
            $tp_documento = TipoDocumento::orderBy('tp_documento', 'ASC')->get();
            $job = Job::orderBy('nome_job', 'ASC')->get();
            $criado = Cadastro_Documentos::orderBy('criado_por', 'ASC')->distinct()->whereNotNull('criado_por')->get('criado_por'); 
            $editado = Cadastro_Documentos::orderBy('editado_por','ASC')->distinct()->whereNotNull('editado_por')->get('editado_por');

            if(session()->get('permissao') == 'Admin' || session()->get('departamento') == 'DIRETORIA') {
                $contador = Cadastro_Documentos::whereNotNull('id_codigo')->count();
            }
            else {
                $contador = Cadastro_Documentos::where('Dep','=', session()->get('departamento'))->whereNotNull('id_codigo')->count();
            }

            $caixa_departamento_Financeiro = DB::table('caixa__departamentos')
             ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
             ->select('cad_departamento', 'ordem')
             ->where('cad_departamento', '=', 'ADM-FINANCEIRO')
             ->get();

            
            $caixa_departamento_Diretoria = DB::table('caixa__departamentos')
            ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
            ->select('cad_departamento', 'ordem')
            ->where('cad_departamento', '=', 'DIRETORIA')
            ->get();

            
            $caixa_departamento_Producao = DB::table('caixa__departamentos')
            ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
            ->select('cad_departamento', 'ordem')
            ->where('cad_departamento', '=', 'PRODUÇÃO')
            ->get();

            
            $caixa_departamento_Pos_Producao = DB::table('caixa__departamentos')
            ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
            ->select('cad_departamento', 'ordem')
            ->where('cad_departamento', '=', 'PÓS-PRODUÇÃO')
            ->get();

            
            $caixa_departamento_Comercial = DB::table('caixa__departamentos')
            ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
            ->select('cad_departamento', 'ordem')
            ->where('cad_departamento', '=', 'COMERCIAL')
            ->get();

            
            $caixa_departamento_Tecnica = DB::table('caixa__departamentos')
            ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
            ->select('cad_departamento', 'ordem')
            ->where('cad_departamento', '=', 'TÉCNICA')
            ->get();

            
            $caixa_departamento_Copiagem = DB::table('caixa__departamentos')
            ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
            ->select('cad_departamento', 'ordem')
            ->where('cad_departamento', '=', 'COPIAGEM')
            ->get();

            
            $caixa_departamento_Edicao = DB::table('caixa__departamentos')
            ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
            ->select('cad_departamento', 'ordem')
            ->where('cad_departamento', '=', 'EDIÇÃO')
            ->get();

            
            $caixa_departamento_Mam = DB::table('caixa__departamentos')
            ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
            ->select('cad_departamento', 'ordem')
            ->where('cad_departamento', '=', 'MAM')
            ->get();

            
            $caixa_departamento_Nucleo_Conteudo = DB::table('caixa__departamentos')
            ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
            ->select('cad_departamento', 'ordem')
            ->where('cad_departamento', '=', 'NÚCLEO-CONTEÚDO')
            ->get();
 
            
            $caixa_departamento_Campanha_Politica = DB::table('caixa__departamentos')
            ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
            ->select('cad_departamento', 'ordem')
            ->where('cad_departamento', '=', 'CAMPANHA-POLÍTICA')
            ->get();
            
             
             $caixa_departamento_Projetos_Especiais = DB::table('caixa__departamentos')
             ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
             ->select('cad_departamento', 'ordem')
             ->where('cad_departamento', '=', 'PROJETOS-ESPECIAIS')
             ->get();
            
            
            $caixa_departamento_Outros = DB::table('caixa__departamentos')
            ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
            ->select('cad_departamento', 'ordem')
            ->where('cad_departamento', '=', 'OUTROS')
            ->get();    


            
            return view('forms_search/documentos_search', compact(
            'contador',
            'tp_documento',
            'emit', 
            'dest', 
            'dash',
            'job',
            'criado',
            'editado',
            'dep',
            'caixa_departamento_Financeiro',
            'caixa_departamento_Diretoria',
            'caixa_departamento_Producao',
            'caixa_departamento_Pos_Producao',
            'caixa_departamento_Comercial',
            'caixa_departamento_Tecnica',
            'caixa_departamento_Copiagem',
            'caixa_departamento_Edicao',
            'caixa_departamento_Mam',
            'caixa_departamento_Nucleo_Conteudo',
            'caixa_departamento_Campanha_Politica',
            'caixa_departamento_Projetos_Especiais',
            'caixa_departamento_Outros'
        
        ));
            
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
    public function create(Request $request)
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
        //
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Pesquisas  $pesquisas
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        if(session()->get('autenticado') == 1) {
            // Vetificar se tem data_in e data_out 
            if (isset($request['data_in']) && isset($request['data_out'])) {
                if( empty($request->input('data_in')) && !empty($request->input('data_out')))
                    return redirect()->back()->withErrors([
                        'data_in' => 'Sem data inicial'
                    ])->withInput()->paginate(50);

                    if( empty($request->input('data_out')) && ! empty($request->input('data_in')))
                    return redirect()->back()->withErrors([
                        'data_out' => 'Sem data final'
                    ])->withInput()->paginate(50);
                    $data_in =  $request->input('data_in');
                    $data_out = $request->input('data_out');

            }

            //dd($request->attributes);
            $dados = $this->arrayParse($request);
            $emit = Empresas_Emitentes::orderBy('cad_emitentes', 'ASC')->get();
            $dest = Empresas_Destinatarias::orderBy('cad_destinatarias', 'ASC')->get();
            $dep = Departamentos::orderBy('cad_departamento', 'ASC')->get();
            $tp_documento = TipoDocumento::orderBy('tp_documento', 'ASC')->get();
            $job = Job::orderBy('nome_job', 'ASC')->get();
            $contador = Cadastro_Documentos::where($dados)->whereNotNull('id_codigo')->count();
            
            // $dadosData = $this->arrayParseDate($request);
            
                //dd($dados);
                if(isset($data_in) && isset($data_out)){
                    if(session()->get('permissao') == 'Admin ' || session()->get('departamento') == 'DIRETORIA') {
                        $dash = empty($dados) ? Cadastro_Documentos::whereBetween('data', [$data_in, $data_out])->Paginate(50): 
                                Cadastro_Documentos::where($dados)->whereBetween('data', [$data_in, $data_out])->Paginate(50);
                        $contador = $dash->count();
                    }

                    else {
                        $dash = Cadastro_Documentos::where('Dep', '=', session()->get('departamento'))->where($dados)->whereBetween('data', [$data_in, $data_out])->Paginate(50);
                        $contador = $dash->count();
                        dd($dash);
                    }

                }

                elseif (isset($dados) ) {
                    if(session()->get('permissao') == 'Admin' || session()->get('departamento') == 'DIRETORIA'){
                        
                        $dash = Cadastro_Documentos::where($dados)->orderBy('id_codigo', 'DESC')->Paginate(50);
                        $contador = $dash->count();
                    }    
                    else {

                        $dash = Cadastro_Documentos::where('Dep' ,'=', session()->get('departamento'))->where($dados)->Paginate(50);
                        $contador = $dash->count();
                    }
                }
                // else {
                //     $dash = Cadastro_Documentos::where('Dep' ,'=', session()->get('departamento'))->get();
                // }

                
                $caixa_departamento_Financeiro = DB::table('caixa__departamentos')
                ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
                ->select('cad_departamento', 'ordem')
                ->where('cad_departamento', '=', 'ADM-FINANCEIRO')
                ->Paginate(50);
   
               
               $caixa_departamento_Diretoria = DB::table('caixa__departamentos')
               ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
               ->select('cad_departamento', 'ordem')
               ->where('cad_departamento', '=', 'DIRETORIA')
               ->Paginate(50);
   
               
               $caixa_departamento_Producao = DB::table('caixa__departamentos')
               ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
               ->select('cad_departamento', 'ordem')
               ->where('cad_departamento', '=', 'PRODUÇÃO')
               ->Paginate(50);
   
               
               $caixa_departamento_Pos_Producao = DB::table('caixa__departamentos')
               ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
               ->select('cad_departamento', 'ordem')
               ->where('cad_departamento', '=', 'PÓS-PRODUÇÃO')
               ->Paginate(50);
   
               
               $caixa_departamento_Comercial = DB::table('caixa__departamentos')
               ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
               ->select('cad_departamento', 'ordem')
               ->where('cad_departamento', '=', 'COMERCIAL')
               ->simplePaginate(50);
   
               
               $caixa_departamento_Tecnica = DB::table('caixa__departamentos')
               ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
               ->select('cad_departamento', 'ordem')
               ->where('cad_departamento', '=', 'TÉCNICA')
               ->Paginate(50);
   
               
               $caixa_departamento_Copiagem = DB::table('caixa__departamentos')
               ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
               ->select('cad_departamento', 'ordem')
               ->where('cad_departamento', '=', 'COPIAGEM')
               ->Paginate(50);
   
               
               $caixa_departamento_Edicao = DB::table('caixa__departamentos')
               ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
               ->select('cad_departamento', 'ordem')
               ->where('cad_departamento', '=', 'EDIÇÃO')
               ->Paginate(50);
   
               
               $caixa_departamento_Mam = DB::table('caixa__departamentos')
               ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
               ->select('cad_departamento', 'ordem')
               ->where('cad_departamento', '=', 'MAM')
               ->Paginate(50);
   
               
               $caixa_departamento_Nucleo_Conteudo = DB::table('caixa__departamentos')
               ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
               ->select('cad_departamento', 'ordem')
               ->where('cad_departamento', '=', 'NÚCLEO-CONTEÚDO')
               ->Paginate(50);
    
               
               $caixa_departamento_Campanha_Politica = DB::table('caixa__departamentos')
               ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
               ->select('cad_departamento', 'ordem')
               ->where('cad_departamento', '=', 'CAMPANHA-POLÍTICA')
               ->Paginate(50);
               
                
                $caixa_departamento_Projetos_Especiais = DB::table('caixa__departamentos')
                ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
                ->select('cad_departamento', 'ordem')
                ->where('cad_departamento', '=', 'PROJETOS-ESPECIAIS')
                ->Paginate(50);
               
               
               $caixa_departamento_Outros = DB::table('caixa__departamentos')
               ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
               ->select('cad_departamento', 'ordem')
               ->where('cad_departamento', '=', 'OUTROS')
               ->Paginate(50);    

                    

               //dd($dash);

            
                
                    if ($contador == null && $dash == null && $dados == null) {
                        $contador = 0;

                        return view('forms_search/documentos_search', compact(
                            'tp_documento',
                            'dest',
                            'emit',
                            'dash',
                            'job',
                            'contador',
                            'dep',
                            'caixa_departamento_Financeiro',
                            'caixa_departamento_Diretoria',
                            'caixa_departamento_Producao',
                            'caixa_departamento_Pos_Producao',
                            'caixa_departamento_Comercial',
                            'caixa_departamento_Tecnica',
                            'caixa_departamento_Copiagem',
                            'caixa_departamento_Edicao',
                            'caixa_departamento_Mam',
                            'caixa_departamento_Nucleo_Conteudo',
                            'caixa_departamento_Campanha_Politica',
                            'caixa_departamento_Projetos_Especiais',
                            'caixa_departamento_Outros'
                        
                        
                        
                        ));
                    }
                    else {

                        return view('forms_search/documentos_search', compact(
                            'tp_documento',
                            'dest',
                            'emit',
                            'dash',
                            'job',
                            'contador',
                            'dep',
                            'caixa_departamento_Financeiro',
                            'caixa_departamento_Diretoria',
                            'caixa_departamento_Producao',
                            'caixa_departamento_Pos_Producao',
                            'caixa_departamento_Comercial',
                            'caixa_departamento_Tecnica',
                            'caixa_departamento_Copiagem',
                            'caixa_departamento_Edicao',
                            'caixa_departamento_Mam',
                            'caixa_departamento_Nucleo_Conteudo',
                            'caixa_departamento_Campanha_Politica',
                            'caixa_departamento_Projetos_Especiais',
                            'caixa_departamento_Outros'
                        
                        
                        
                        ));
                    }
                }
                
        else {
            return redirect(route('index'));
        }

    
        
    }
    
    public function getPdf(Request $request)
    {
        if(session()->get('autenticado') == 1) {
            if (isset($request['id_codigo']) && !empty($request->input('id_codigo')) )
            {
                $cad_doc = Cadastro_documentos::where('id_codigo', '=', $request->input('id_codigo'))->first();
                if($cad_doc)
                {
                    $file_name = $cad_doc->id_codigo .'_'. $cad_doc->Tit_Doc .'.pdf';
                    $header =  [
                        'Content-Type' => 'application/pdf',
                        'Content-Disposition' => 'inline; filename="'.$file_name.'"'
                    ];
                    // dd(asset('storage/pdfs'));
                    $path = storage_path('anexo/'.$cad_doc->id_codigo.'_'. $cad_doc->Tit_Doc .'.pdf');
                    if(!file_exists($path))
                    {
                        return '<h1>Arquivo não encontrado</h1>';
                    }
                    return response()->file($path, $header);
                }
            }
        }
        else {
            return redirect(route('index'));
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pesquisas  $pesquisas
     * @return \Illuminate\Http\Response
     */
    public function edit(Pesquisas $pesquisas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pesquisas  $pesquisas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pesquisas $pesquisas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pesquisas  $pesquisas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pesquisas $pesquisas)
    {
        //
    }


    //Funções Helpers
    private function arrayParse(Request $request) {
        
    
        $dados = [];
        $data = $request->all();
        foreach($data as $key => $valor) {
            if ($valor <> NULL && $valor <> '' && $key <> '_token' && $key <> 'data_in' && $key <> 'data_out' && $key != 'Loc_Box_Eti') {
                $dados[] = [DB::raw('UPPER('.$key.')'), 'LIKE', '%'. strtoupper($valor). '%'];
            }

            if ($key == 'Loc_Box_Eti' && isset($data['Dep']) && !is_null($data['Dep'])) {
                $dados[] = [DB::raw('UPPER('.$key.')'), 'LIKE', '%'. strtoupper($valor). '%'];
            }
            

        }

         //dd($dados);
            return isset($dados)? $dados:[];
    }





}
