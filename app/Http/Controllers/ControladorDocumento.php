<?php

namespace App\Http\Controllers;

use App\Cadastro_Documentos;
use App\Departamentos;
use App\Empresas_Destinatarias;
use App\Empresas_Emitentes;
use App\Origens;
use App\Upload;
use App\TipoDocumento;
use App\Job;
use App\Caixa_Departamento;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class ControladorDocumento extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if(session()->get('autenticado') == 1) {
            $documentos = Cadastro_Documentos::all()->sortByDesc('id_codigo')->last();

            return view('forms_create/dashboard', compact('documentos'));
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
        if(session()->get('autenticado') == 1) {
            $emit = Empresas_Emitentes::orderBy('cad_emitentes', 'ASC')->get();
            $dest = Empresas_Destinatarias::orderBy('cad_destinatarias', 'ASC')->get();
            $ori = Origens::orderBy('cad_origem', 'ASC')->get();
            $dep = Departamentos::orderBy('cad_departamento', 'ASC')->get();
            $tp_documentos = TipoDocumento::orderBy('tp_documento', 'ASC')->get();
            $job = Job::orderBy('nome_job', 'ASC')->get();


            $caixa_departamento_Financeiro = DB::table('caixa__departamentos')
             ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
             ->select('cad_departamento', 'ordem')
             ->where('cad_departamento', '=', 'ADM-FINANCEIRO')->where('status', '=', 'Aberta')
             ->get();


            $caixa_departamento_Diretoria = DB::table('caixa__departamentos')
            ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
            ->select('cad_departamento', 'ordem')
            ->where('cad_departamento', '=', 'DIRETORIA')->where('status', '=', 'Aberta')
            ->get();


            $caixa_departamento_Producao = DB::table('caixa__departamentos')
            ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
            ->select('cad_departamento', 'ordem')
            ->where('cad_departamento', '=', 'PRODUÇÃO')->where('status', '=', 'Aberta')
            ->get();


            $caixa_departamento_Pos_Producao = DB::table('caixa__departamentos')
            ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
            ->select('cad_departamento', 'ordem')
            ->where('cad_departamento', '=', 'PÓS-PRODUÇÃO')->where('status', '=', 'Aberta')
            ->get();


            $caixa_departamento_Comercial = DB::table('caixa__departamentos')
            ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
            ->select('cad_departamento', 'ordem')
            ->where('cad_departamento', '=', 'COMERCIAL')->where('status', '=', 'Aberta')
            ->get();


            $caixa_departamento_Tecnica = DB::table('caixa__departamentos')
            ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
            ->select('cad_departamento', 'ordem')
            ->where('cad_departamento', '=', 'TÉCNICA')->where('status', '=', 'Aberta')
            ->get();


            $caixa_departamento_Copiagem = DB::table('caixa__departamentos')
            ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
            ->select('cad_departamento', 'ordem')
            ->where('cad_departamento', '=', 'COPIAGEM')->where('status', '=', 'Aberta')
            ->get();


            $caixa_departamento_Edicao = DB::table('caixa__departamentos')
            ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
            ->select('cad_departamento', 'ordem')
            ->where('cad_departamento', '=', 'EDIÇÃO')->where('status', '=', 'Aberta')
            ->get();


            $caixa_departamento_Mam = DB::table('caixa__departamentos')
            ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
            ->select('cad_departamento', 'ordem')
            ->where('cad_departamento', '=', 'MAM')->where('status', '=', 'Aberta')
            ->get();


            $caixa_departamento_Nucleo_Conteudo = DB::table('caixa__departamentos')
            ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
            ->select('cad_departamento', 'ordem')
            ->where('cad_departamento', '=', 'NÚCLEO-CONTEÚDO')->where('status', '=', 'Aberta')
            ->get();


            $caixa_departamento_Campanha_Politica = DB::table('caixa__departamentos')
            ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
            ->select('cad_departamento', 'ordem')
            ->where('cad_departamento', '=', 'CAMPANHA-POLÍTICA')->where('status', '=', 'Aberta')
            ->get();


             $caixa_departamento_Projetos_Especiais = DB::table('caixa__departamentos')
             ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
             ->select('cad_departamento', 'ordem')
             ->where('cad_departamento', '=', 'PROJETOS-ESPECIAIS')->where('status', '=', 'Aberta')
             ->get();


            $caixa_departamento_Outros = DB::table('caixa__departamentos')
            ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
            ->select('cad_departamento', 'ordem')
            ->where('cad_departamento', '=', 'OUTROS')->where('status', '=', 'Aberta')
            ->get();

            $documentos = Cadastro_Documentos::all();
            $dash = Cadastro_Documentos::all()->sortByDesc('id_codigo')->take(1);


            return view('forms_create/documentos', compact(
                'emit',
                'dest',
                'ori',
                'dep',
                'documentos',
                'dash',
                'tp_documentos',
                'job',
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


public function edit_clone(Request $request, $id) {
    if(session()->get('autenticado') == 1) {

    $emit  = Empresas_Emitentes::orderBy('cad_emitentes', 'ASC')->get();
    $dest = Empresas_Destinatarias::orderBy('cad_destinatarias', 'ASC')->get();
    $ori = Origens::orderBy('cad_origem', 'ASC')->get();
    $dep = Departamentos::orderBy('cad_departamento', 'ASC')->get();
    $edit = Cadastro_Documentos::find($id);
    $tp_documento = TipoDocumento::orderBy('tp_documento', 'ASC')->get();
    $job = Job::orderBy('nome_job', 'ASC')->get();

    $caixa_departamento_Financeiro = DB::table('caixa__departamentos')
    ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
    ->select('cad_departamento', 'ordem')
    ->where('cad_departamento', '=', 'ADM-FINANCEIRO')->where('status', '=', 'Aberta')
    ->get();


   $caixa_departamento_Diretoria = DB::table('caixa__departamentos')
   ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
   ->select('cad_departamento', 'ordem')
   ->where('cad_departamento', '=', 'DIRETORIA')->where('status', '=', 'Aberta')
   ->get();


   $caixa_departamento_Producao = DB::table('caixa__departamentos')
   ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
   ->select('cad_departamento', 'ordem')
   ->where('cad_departamento', '=', 'PRODUÇÃO')->where('status', '=', 'Aberta')
   ->get();


   $caixa_departamento_Pos_Producao = DB::table('caixa__departamentos')
   ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
   ->select('cad_departamento', 'ordem')
   ->where('cad_departamento', '=', 'PÓS-PRODUÇÃO')->where('status', '=', 'Aberta')
   ->get();


   $caixa_departamento_Comercial = DB::table('caixa__departamentos')
   ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
   ->select('cad_departamento', 'ordem')
   ->where('cad_departamento', '=', 'COMERCIAL')->where('status', '=', 'Aberta')
   ->get();


   $caixa_departamento_Tecnica = DB::table('caixa__departamentos')
   ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
   ->select('cad_departamento', 'ordem')
   ->where('cad_departamento', '=', 'TÉCNICA')->where('status', '=', 'Aberta')
   ->get();


   $caixa_departamento_Copiagem = DB::table('caixa__departamentos')
   ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
   ->select('cad_departamento', 'ordem')
   ->where('cad_departamento', '=', 'COPIAGEM')->where('status', '=', 'Aberta')
   ->get();


   $caixa_departamento_Edicao = DB::table('caixa__departamentos')
   ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
   ->select('cad_departamento', 'ordem')
   ->where('cad_departamento', '=', 'EDIÇÃO')->where('status', '=', 'Aberta')
   ->get();


   $caixa_departamento_Mam = DB::table('caixa__departamentos')
   ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
   ->select('cad_departamento', 'ordem')
   ->where('cad_departamento', '=', 'MAM')->where('status', '=', 'Aberta')
   ->get();


   $caixa_departamento_Nucleo_Conteudo = DB::table('caixa__departamentos')
   ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
   ->select('cad_departamento', 'ordem')
   ->where('cad_departamento', '=', 'NÚCLEO-CONTEÚDO')->where('status', '=', 'Aberta')
   ->get();


   $caixa_departamento_Campanha_Politica = DB::table('caixa__departamentos')
   ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
   ->select('cad_departamento', 'ordem')
   ->where('cad_departamento', '=', 'CAMPANHA-POLÍTICA')->where('status', '=', 'Aberta')
   ->get();


    $caixa_departamento_Projetos_Especiais = DB::table('caixa__departamentos')
    ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
    ->select('cad_departamento', 'ordem')
    ->where('cad_departamento', '=', 'PROJETOS-ESPECIAIS')->where('status', '=', 'Aberta')
    ->get();


   $caixa_departamento_Outros = DB::table('caixa__departamentos')
   ->join('departamentos', 'departamentos.id_departamento', '=', 'caixa__departamentos.id_departamento')
   ->select('cad_departamento', 'ordem')
   ->where('cad_departamento', '=', 'OUTROS')->where('status', '=', 'Aberta')
   ->get();

    return view('forms_edit/documentos_clone', compact(
        'emit',
        'dest',
        'ori',
        'dep',
        'edit',
        'tp_documento',
        'job',
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

    public function clone(Request $request) {
        if(session()->get('autenticado') == 1) {

            $doc = new Cadastro_Documentos();

            $doc->data = $request->input('data');
            $doc->Assunto = $request->input('Assunto');
            $doc->Emp_Emit = $request->input('Emp_Emit');
            $doc->Emp_Dest = $request->input('Emp_Dest');
            $doc->Formato_Doc = $request->input('Formato_Doc');
            $doc->Tp_Projeto = $request->input('Tp_Projeto');
            $doc->nome_job = $request->input('nome_job');
            $doc->Nome_Doc = $request->input('Nome_Doc');
            $doc->Valor_Doc = $request->input('Valor_Doc');

            $doc->Valor_Doc = str_replace('.', '', $doc->Valor_Doc); // Remover separador de milhar
            $doc->Valor_Doc = str_replace(',', '.', $doc->Valor_Doc); // Substituir vírgula por ponto
            $doc->Valor_Doc = floatval($doc->Valor_Doc);

            $doc->Dt_Ref = $request->input('Dt_Ref');
            $doc->Desfaz = $request->input('Desfaz');
            $doc->Loc_Arquivo = $request->input('Loc_Arquivo');
            $doc->tp_documento = $request->input('tp_documento');
            $doc->Palavra_Chave = $request->input('Palavra_Chave');
            $doc->Desc = $request->input('Desc');
            $doc->Dep = $request->input('Dep');
            $doc->Origem = $request->input('Origem');
            $doc->Loc_Cor = $request->input('Loc_Cor');
            $doc->Loc_Est = $request->input('Loc_Est');

            $doc->Loc_Box_Eti = $request->input('Loc_Box_Eti') ? null: 'N/A';
            
            $doc->Loc_Maco = $request->input('Loc_Maco');
            $doc->Loc_Status = $request->input('Loc_Status');
            $doc->Loc_Obs = $request->input('Loc_Obs');
            $doc->criado_por = $request->input('criado_por');
            $doc->save();

            //dd($doc);

            //Multiplos Uploads
            foreach($request->allFiles()['anexo'] as $file) {
                //dd($file->getClientOriginalName());

                $fileUpload = new Upload();
                $fileUpload->id_upload_codigo = $doc->id_codigo;

                try {
                    $fileUpload->path = $file->getClientOriginalName();
                    $file->storeAs('anexos/'.$fileUpload->id_upload_codigo.'/', $file->getClientOriginalName());
                    //dd($file->store('anexos'));
                    //dd($fileUpload);
                    $fileUpload->save();
                    unset($fileUpload);

                } catch (\Exception $e) {
                    return redirect()->back()->withErrors(['erro' => 'Erro:'. $e->getMessage() ]);
                }

            return redirect(route('pesquisa_index'));
        }
    }

        else {
            return redirect(route('index'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        if(session()->get('autenticado') == 1) {
            $doc = new Cadastro_Documentos();

            $doc->data = $request->input('data');
            $doc->Assunto = $request->input('Assunto');
            $doc->Emp_Emit = $request->input('Emp_Emit');
            $doc->Emp_Dest = $request->input('Emp_Dest');
            $doc->Formato_Doc = $request->input('Formato_Doc');
            $doc->Tp_Projeto = $request->input('Tp_Projeto');
            $doc->nome_job = $request->input('nome_job');
            $doc->Nome_Doc = $request->input('Nome_Doc');
            $doc->Valor_Doc = $request->input('Valor_Doc');
        
            //dd(floatval($doc->Valor_Doc), 2);

            $doc->Valor_Doc = str_replace('.', '', $doc->Valor_Doc); // Remover separador de milhar
            $doc->Valor_Doc = str_replace(',', '.', $doc->Valor_Doc); // Substituir vírgula por ponto
            $doc->Valor_Doc = floatval($doc->Valor_Doc);
            
            $doc->Dt_Ref = $request->input('Dt_Ref');
            $doc->Desfaz = $request->input('Desfaz');
            $doc->Loc_Arquivo = $request->input('Loc_Arquivo');
            $doc->tp_documento = $request->input('tp_documento');
            $doc->Palavra_Chave = $request->input('Palavra_Chave');
            $doc->Desc = $request->input('Desc');
            $doc->Dep = $request->input('Dep');
            $doc->Origem = $request->input('Origem');
            $doc->Loc_Cor = $request->input('Loc_Cor');
            $doc->Loc_Est = $request->input('Loc_Est');
            $doc->Loc_Box_Eti = $request->input('Loc_Box_Eti') ? null: 'N/A';
            // $doc->Loc_Box_Eti_ADM = $request->input('Loc_Box_Eti_ADM');
            // $doc->Loc_Box_Eti_Diretoria = $request->input('Loc_Box_Eti_Diretoria');
            // $doc->Loc_Box_Eti_Producao = $request->input('Loc_Box_Eti_Producao');
            // $doc->Loc_Box_Eti_Pos_Producao = $request->input('Loc_Box_Eti_Pos_Producao');
            // $doc->Loc_Box_Eti_Comercial = $request->input('Loc_Box_Eti_Comercial');
            // $doc->Loc_Box_Eti_Tecnica = $request->input('Loc_Box_Eti_Tecnica');
            // $doc->Loc_Box_Eti_Copiagem = $request->input('Loc_Box_Eti_Copiagem');
            // $doc->Loc_Box_Eti_Edicao = $request->input('Loc_Box_Eti_Edicao');
            // $doc->Loc_Box_Eti_MAM = $request->input('Loc_Box_Eti_MAM');
            // $doc->Loc_Box_Eti_Nucleo = $request->input('Loc_Box_Eti_Nucleo');
            // $doc->Loc_Box_Eti_Campanha = $request->input('Loc_Box_Eti_Campanha');
            // $doc->Loc_Box_Eti_Projetos = $request->input('Loc_Box_Eti_Projetos');
            // $doc->Loc_Box_Eti_Outros = $request->input('Loc_Box_Eti_Outros');

            $doc->Loc_Maco = $request->input('Loc_Maco');
            // $doc->Loc_Status = $request->input('Loc_Status');

            $doc->Loc_Obs = $request->input('Loc_Obs');
            $doc->criado_por = $request->input('criado_por');


            //Verifica se "null" ou "vazio"
            //Se verdadeiro = salva como processamento e salva
            if (is_null($request->anexo) || empty($request->anexo)) {
                $doc->Loc_Status = 'Em Processamento';
                $doc->save();
            }
            else {
            //Senão = Salva como arquivado e salva
                $doc->Loc_Status = 'Arquivado';
                $doc->save();
                //Multiplos Uploads
                foreach($request->allFiles()['anexo'] as $file) {
                    $fileUpload = new Upload();
                    $fileUpload->id_upload_codigo = $doc->id_codigo;
                    try {
                        //Obtém o nome da variável e atribui ao nome do arquivo
                        $fileUpload->path = $file->getClientOriginalName();
                        //$file->storeAs('anexos/'.$fileUpload->id_upload_codigo.'/', $file->getClientOriginalName());
                        $file->storeAs('anexos/'.$fileUpload->id_upload_codigo.'/', $file->getClientOriginalName());
                        //salva pdf no storage
                        $fileUpload->save();
                        //esvazia a variável
                        unset($fileUpload);
                    } 
                    catch (\Exception $e) {
                        Log::info('UPLOAD:' + $e->getMessage());
                        return redirect()->back()->withErrors(['erro' => 'Erro:'. $e->getMessage() ]);
                    //Fim Catch
                    }
                //Fim Foreach
                }
                //Atualiza
                $doc->refresh();
            //Fim Método   
            }


            return redirect(route('documentos_create'));
        //Fim IF
        }
        else {
            return redirect(route('index'));
        //Fim Else
        }


    //Fim Método - Store
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id_codigo)
    {

        if(session()->get('autenticado') == 1) {
            $files = Upload::where('id_upload_codigo', '=', $id_codigo)->get();

            return view('forms_create/visualizar_anexo', compact('files'));
        }
        else {
            return redirect(route('index'));
        }


    }

    public function deleteAnexo(Request $request, $id_upload){
        
        //dd($id_upload);
        $deleteFiles = Upload::where('id_upload', '=', $id_upload)->delete();

        $codigo = Upload::where('id_upload', '=', $id_upload)->first();
        if(is_null($codigo)){
            //Atualiza e volta a pagina anterior
            return header("Location: ".$_SERVER['HTTP_REFERER'].""); 
        }
        else{
            return redirect("/dashboard/documentos_edit/". $codigo->id_upload_codigo);
        }

        

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
