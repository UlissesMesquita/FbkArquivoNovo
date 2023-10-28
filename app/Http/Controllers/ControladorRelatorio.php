<?php

namespace App\Http\Controllers;

use App\Cadastro_Documentos;
use App\Empresas_Destinatarias;
use App\Empresas_Emitentes;
use App\Departamentos;
use App\Pesquisas;
use App\Job;
use App\TipoDocumento;
use App\Upload;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\isNull;

class ControladorRelatorio extends Controller
{

    public function index(Request $request)
    {

        if(session()->get('autenticado') == 1) {
            
            
            $emit = Empresas_Emitentes::select('id_empresa_emitente', 'cad_emitentes')->orderBy('cad_emitentes', 'ASC')->get();
            $dep = Departamentos::select('id_departamento', 'cad_departamento')->orderBy('cad_departamento', 'ASC')->get();
            $dest = Empresas_Destinatarias::select('id_empresa_destinataria', 'cad_destinatarias')->orderBy('cad_destinatarias', 'ASC')->get();
            if(session()->get('permissao') == 'Admin' || session()->get('departamento') == 'DIRETORIA') {
                //Query para utilização sem paginação
                    //$dash = Cadastro_Documentos::all()->sortByDesc('id_codigo');
                //Query para apaginação
                $dash = Cadastro_Documentos::select('data', 'id_codigo', 'Emp_Emit', 'Emp_Dest', 'Dep', 'tp_documento', 'Nome_Doc', 'Palavra_Chave', 'Tp_Projeto', 'Assunto', 'nome_job', 'Loc_Arquivo','Loc_Est', 'Loc_Box_Eti', 'Loc_Maco','Dt_Ref', 'Desfaz', 'Valor_Doc'
                )->orderBy('id_codigo', 'DESC')->Paginate(100);
                //dd($dash);
                //$dash = Cadastro_Documentos::paginate();

                
            }
            else {
                //Query para utilização com paginação
                $dash = Cadastro_Documentos::select('data', 'id_codigo', 'Emp_Emit', 'Emp_Dest', 'Dep', 'tp_documento', 'Nome_Doc', 'Palavra_Chave', 'Tp_Projeto', 'Assunto', 'nome_job', 'Loc_Arquivo','Loc_Est', 'Loc_Box_Eti', 'Loc_Maco','Dt_Ref', 'Desfaz', 'Valor_Doc'
                )->orderBy('id_codigo', 'DESC')->where('Dep' ,'=', session()->get('departamento'))->Paginate(100);

                


                //Query para utilização sem paginação
                //$dash = Cadastro_Documentos::all()->where('Dep' ,'=', session()->get('departamento'))->sortByDesc('id_codigo');
                
            }
            
            $tp_documento = TipoDocumento::select('id_tp_documento', 'tp_documento')->orderBy('tp_documento', 'ASC')->get();
            $job = Job::select('id_job', 'nome_job')->orderBy('nome_job', 'ASC')->get();


            // $criado = Cadastro_Documentos::orderBy('criado_por', 'ASC')->distinct()->whereNotNull('criado_por')->get('criado_por');
            // $editado = Cadastro_Documentos::orderBy('editado_por','ASC')->distinct()->whereNotNull('editado_por')->get('editado_por');

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

            $anexos = Upload::select('id_upload_codigo')->groupBy('id_upload_codigo')->paginate(100);
            dd($anexos);
            return view('forms_reports/documentos_search_reports', compact(
            'contador',
            'anexos',
            'tp_documento',
            'emit', 
            'dest', 
            'dash',
            'job',
            // 'criado',
            // 'editado',
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


    public function gerarRelatorio(Request $request){

        Log::alert("Erro 500");
        Log::info("Erro");
        //($request);
        if(session()->get('autenticado') == 1) {
            // Vetificar se tem data_in e data_out 
            if (isset($request['data_in']) && isset($request['data_out'])) {
                if( empty($request->input('data_in')) && !empty($request->input('data_out')))
                    return redirect()->back()->withErrors([
                        'data_in' => 'Sem data inicial'
                    ])->withInput()->paginate(200);

                    if( empty($request->input('data_out')) && ! empty($request->input('data_in')))
                    return redirect()->back()->withErrors([
                        'data_out' => 'Sem data final'
                    ])->withInput()->paginate(200);
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
                        $dash = empty($dados) ? Cadastro_Documentos::whereBetween('data', [$data_in, $data_out])->Paginate(200): 
                                Cadastro_Documentos::where($dados)->whereBetween('data', [$data_in, $data_out])->Paginate(200);
                        $contador = $dash->count();
                    }

                    else {
                        $dash = Cadastro_Documentos::where('Dep', '=', session()->get('departamento'))->where($dados)->whereBetween('data', [$data_in, $data_out])->Paginate(200);
                        $contador = $dash->count();
				//dd($dash);
                    }

                }

                elseif (isset($dados) ) {
                    if(session()->get('permissao') == 'Admin' || session()->get('departamento') == 'DIRETORIA'){
                        
                        $dash = Cadastro_Documentos::where($dados)->orderBy('id_codigo', 'DESC')->Paginate(200);
                        $contador = $dash->count();
                    }    
                    else {

                        $dash = Cadastro_Documentos::where('Dep' ,'=', session()->get('departamento'))->where($dados)->Paginate(200);
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
                ->Paginate(200);
   
               
               $caixa_departamento_Diretoria = DB::table('caixa__departamentos')
               ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
               ->select('cad_departamento', 'ordem')
               ->where('cad_departamento', '=', 'DIRETORIA')
               ->Paginate(200);
   
               
               $caixa_departamento_Producao = DB::table('caixa__departamentos')
               ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
               ->select('cad_departamento', 'ordem')
               ->where('cad_departamento', '=', 'PRODUÇÃO')
               ->Paginate(200);
   
               
               $caixa_departamento_Pos_Producao = DB::table('caixa__departamentos')
               ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
               ->select('cad_departamento', 'ordem')
               ->where('cad_departamento', '=', 'PÓS-PRODUÇÃO')
               ->Paginate(200);
   
               
               $caixa_departamento_Comercial = DB::table('caixa__departamentos')
               ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
               ->select('cad_departamento', 'ordem')
               ->where('cad_departamento', '=', 'COMERCIAL')
               ->simplePaginate(200);
   
               
               $caixa_departamento_Tecnica = DB::table('caixa__departamentos')
               ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
               ->select('cad_departamento', 'ordem')
               ->where('cad_departamento', '=', 'TÉCNICA')
               ->Paginate(200);
   
               
               $caixa_departamento_Copiagem = DB::table('caixa__departamentos')
               ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
               ->select('cad_departamento', 'ordem')
               ->where('cad_departamento', '=', 'COPIAGEM')
               ->Paginate(200);
   
               
               $caixa_departamento_Edicao = DB::table('caixa__departamentos')
               ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
               ->select('cad_departamento', 'ordem')
               ->where('cad_departamento', '=', 'EDIÇÃO')
               ->Paginate(200);
   
               
               $caixa_departamento_Mam = DB::table('caixa__departamentos')
               ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
               ->select('cad_departamento', 'ordem')
               ->where('cad_departamento', '=', 'MAM')
               ->Paginate(200);
   
               
               $caixa_departamento_Nucleo_Conteudo = DB::table('caixa__departamentos')
               ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
               ->select('cad_departamento', 'ordem')
               ->where('cad_departamento', '=', 'NÚCLEO-CONTEÚDO')
               ->Paginate(200);
    
               
               $caixa_departamento_Campanha_Politica = DB::table('caixa__departamentos')
               ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
               ->select('cad_departamento', 'ordem')
               ->where('cad_departamento', '=', 'CAMPANHA-POLÍTICA')
               ->Paginate(200);
               
                
                $caixa_departamento_Projetos_Especiais = DB::table('caixa__departamentos')
                ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
                ->select('cad_departamento', 'ordem')
                ->where('cad_departamento', '=', 'PROJETOS-ESPECIAIS')
                ->Paginate(200);
               
               
               $caixa_departamento_Outros = DB::table('caixa__departamentos')
               ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
               ->select('cad_departamento', 'ordem')
               ->where('cad_departamento', '=', 'OUTROS')
               ->Paginate(200);    

                    

               //dd($request);

               $anexos = Upload::select('id_upload_codigo')->distinct()->limit(100)->get();
                    if ($contador == null && $dash == null && $dados == null) {
                        $contador = 0;

                        $dados = [
                            'tp_documento',
                             'dest',
                             'emit',
                             'anexos',
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
                        ];

                        
                         return view('forms_reports.documentos_search_reports', compact([
                             'dados',
                             'tp_documento',
                             'dest',
                             'anexos',
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
                        

                        
                        ]));
                    }
                    else {

                        //Visualização em PDF
                        return view('forms_reports.documentos_search_reports', compact([
                            'dados',
                            'tp_documento',
                            'dest',
                            'anexos',
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
                        
                        
                        
                        ]));
                    }
                }
                
        else {
            return redirect(route('index'));
        }
    }

    public function exportPdf(Request $request){
        

        $dashIds = $request->dash_id;
    
        try{
            $cadastros = Cadastro_Documentos::wherein('id_codigo', $dashIds)->get();
            //valorTotal = Cadastro_Documentos::selectRaw('SUM(Valor_Doc) as valorTotal')->wherein('id_codigo', $dashIds)->first();

            //return view('pdfs.pdf', compact('cadastros', 'soma'));
            return $pdf = Pdf::set_option('isHtml5ParserEnabled', false)
                              ->setPaper('a4', 'landscape')
                              ->loadview('pdfs.pdf', 
                                   ['cadastros' => $cadastros]
                                //    ['valorTotal' => $valorTotal]
                              )
                              ->download('Relatorio_de_Conferencia_'.date("d-m-Y__H-i").'.pdf');

        }
        catch (\Exception $e){
            echo "Error: ". $e;
        }
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
