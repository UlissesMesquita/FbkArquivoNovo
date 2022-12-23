@extends('layout.cabecalho')

@section('titulo_pagina')
    Editando: {{$edit->Assunto}}
@endsection


@section('titulo')

@endsection

@section('conteudo')

<h2 style="text-align: left">Clone de: {{$edit->Assunto}}</h2>

    <form class="form-horizontal" name="form" method="POST" action="{{route('clone')}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

        <!-- Linha 1 -->
        <div class="row">
                <div class="col-md-2">
                    <label><b>Código: </b></label>   <a href="#"><i class="fas fa-search" id="fas fa-search"></i></a>
                    <label for="id_codigo"></label><input type="text" class="form-control" id="id_codigo" name="id_codigo" placeholder="" value="{{$edit->id_codigo + 1}}"  disabled >
                </div>

                <div class="col-md-2">
                    <label><b>Data: </b></label>
                    <label for="data"></label><input type=date class="form-control" id="data" name="data" placeholder="" value="{{$edit->data}}">
                </div>

                <div class="col-md-4">
                    <label><b>Empresa Emitente </b></label>
                    <label for="Emp_Dest"></label>
                        <select id="Emp_Emit" name="Emp_Emit" class="form-control"  required>
                            <option selected>{{$edit->Emp_Emit}}</option>
                                @foreach($emit as $emitente)
                                    <option value ="{{ $emitente->cad_emitentes }}">{{ $emitente->cad_emitentes }}</option>
                                @endforeach
                        </select>
                </div>
    
                <div class="col-md-4">
                    <label><b>Empresa Destinatária: </b></label>
                    <label for="Emp_Dest"></label>
                        <select id="Emp_Dest" name="Emp_Dest" class="form-control"  required>
                            <option selected>{{$edit->Emp_Dest}}</option>
                                @foreach($dest as $destinataria)
                                    <option value ="{{ $destinataria->cad_destinatarias }}">{{ $destinataria->cad_destinatarias }}</option>
                                @endforeach
                        </select>
                </div>

        </div>

        <!-- Linha 2 -->
        <div class="row">

            <div class="col-md-3">
                <label><b>Tipo de Documento: </b></label>
                <label for="tp_documento"></label>
                    <select id="tp_documento" name="tp_documento" class="form-control" required onkeyup="maiuscula(this)">
                    <option selected>{{$edit->tp_documento}}</option>
                            @foreach($tp_documento as $tp_documentos)
                                <option value="{{$tp_documentos->tp_documento}}">{{$tp_documentos->tp_documento}}</option>
                            @endforeach
                        </select>
                    </select>
            </div>
            
            <div class="col-md-3">
                <label><b>Número Documento: </b></label>
                <label for="Nome_Doc"></label><input type="text" class="form-control" id="Nome_Doc" name="Nome_Doc" placeholder="" value="{{$edit->Nome_Doc}}" required onkeyup="maiuscula(this)">
            </div>

            <div class="col-md-4">
                <label><b>Assunto: </b></label>
                <label for="Assunto"></label><input type="text" autofocus class="form-control" id="Assunto" name="Assunto" placeholder="" value="{{$edit->Assunto}}" required onkeyup="maiuscula(this)">
            </div>

            <div class="col-md-2">
                <label><b>Valor: </b></label>
                <label for="Valor_Doc"></label><input type="text" class="form-control" id="Valor_Doc" name="Valor_Doc" placeholder="" value="{{$edit->Valor_Doc}}" onKeyPress="return(moeda(this,'.',',',event))">
            </div>

        </div>

        <!-- Linha 3 -->
        <div class="row">
            <div class="col-md-3">
                <label><b>Form. do Documento Arquivado: </b></label>
                <label for="Formato_Doc"></label>
                    <select id="Formato_Doc" name="Formato_Doc" class="form-control" required>
                        <option>{{$edit->Formato_Doc}}</option>
                        <option>Original Físico</option>
                        <option>Original Digital</option>
                        <option>Cópia</option>
                    </select>
            </div>

            <div class="col-md-2">
                <label><b>Data Referência: </b></label>
                <label for="Dt_Ref"></label><input placeholder= "Mês/Ano" type="text"class="form-control" maxlength="7" name="Dt_Ref" value= "{{$edit->Dt_Ref}}" id="Dt_Ref" onkeyup="maiuscula(this)">
            </div>

            <div class="col-md-4">
                <label><b>Palavra-Chave: </b></label>
                <label for="Palavra_Chave"></label><input type="text" class="form-control" id="Palavra_Chave" name="Palavra_Chave" placeholder="" value="{{$edit->Palavra_Chave}}" onkeyup="maiuscula(this)">
            </div>


        </div>

        <!-- Linha 4 -->
        <div class="row">
            <div class="col-md-4">
                <label><b>Descrição: </b></label>
                <label for="Desc"></label><input type="text" class="form-control" id="Desc" name="Desc" placeholder="" value="{{$edit->Desc}}" required onkeyup="maiuscula(this)">
            </div>

            <div class="col-md-4">
                <label><b>Departamento: </b></label>
                <label for="Dep"></label>
                    <select id="Dep" name="Dep" class="form-control" required onkeyup="maiuscula(this)">
                        <option selected>{{$edit->Dep}}</option>
                            @if(isset($dep))
                                @foreach($dep as $departamento)
                                    <option value="{{$departamento->cad_departamento}}">{{$departamento->cad_departamento}}</option>
                                @endforeach
                            @endif
                    </select>

            </div>

            <div class="col-md-4">
                <label><b>Origem: </b></label>
                    <label for="Origem"></label>
                        <select id="Origem" name="Origem" class="form-control" required onkeyup="maiuscula(this)">
                        <option selected>{{$edit->Origem}}</option>
                            @if(isset($ori))
                                @foreach($ori as $origem)
                                    <option value="{{$origem->cad_origem}}">{{$origem->cad_origem}}</option>
                                @endforeach
                            @endif    
                        </select>
            </div>
                
        </div>

         <!-- Linha 5 -->
         <div class="row">
            <div class="col-md-2">
                <label><b>Tipo de Projeto: </b></label>
                <label for="Tp_Projeto"></label>
                <select id="Tp_Projeto" name="Tp_Projeto" class="form-control" onselect="mostra(Tp_Projeto)" required>
                    <option selected>{{$edit->Tp_Projeto}}</option>
                    <option>ADM</option>
                    <option>JOB</option>
                </select>
            </div>

            <div class="col-md-10" id="drop_job" style="display: block">
                <label><b>Nome do Projeto: </b></label>
                <label for="nome_job"></label>
                <select id="nome_job" name="nome_job" class="form-control" >
                    <option selected>{{$edit->nome_job}}</option>
                    @if(isset($job))
                        @foreach($job as $jobs)
                            <option value="{{$jobs->nome_job}}">{{$jobs->nome_job}}</option>
                        @endforeach
                    @endif    
                </select>
            </div>
     
        </div>

<br>
    <h2 style="text-align: left">Localização</h2>

        <!-- Linha 7 -->
        <div class="row">

            <div class="col-md-2">
                <label><b>Local Arquivo: </b></label>
                <label for="Loc_Arquivo"></label><input type="text" class="form-control" value="{{$edit->Loc_Arquivo}}" id="Loc_Arquivo" name="Loc_Arquivo" placeholder="" onkeyup="maiuscula(this)">
            </div>

            <div class="col-md-2">
                <label><b>Corredor:</b></label>
                <label for="Loc_Cor"></label>
                <select id="Loc_Cor" name="Loc_Cor" class="form-control" required>
                    <option selected>{{$edit->Loc_Cor}}</option>
                    <option>Digital</option>
                    <?php
                    for ($i=1; $i<31; $i++) {
                        echo "<option value='" .$i."'>". $i ."</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-2">
                <label><b>Estante:</b></label>
                <label for="Loc_Est"></label>
                <select id="Loc_Est" name="Loc_Est" class="form-control" required>
                <option selected>{{$edit->Loc_Est}}</option>
                <option>Digital</option>   
                   <?php
                    for ($i=1; $i<31; $i++) {
                        echo "<option value='".$i."'>". $i ."</option>";
                    }
                    ?>

                </select>
            </div>

            <div class="col-md-1">

                <div class="DivPai">
                    <div class="Escolha">
                        <label><b>Caixa:*</b></label>
                        <label for="Loc_Box_Eti"></label>
                        <select name="Loc_Box_Eti" id="Loc_Box_Eti" class="form-control" >
                        <option value="{{$edit->Loc_Box_Eti}}">{{$edit->Loc_Box_Eti}}</option>
                        </select>
                    </div>     
                
                    <div class="ADM-FINANCEIRO">
                        <label><b>Caixa:*</b></label>
                        <label for="Loc_Box_Eti"></label>
                        <select name="Loc_Box_Eti" id="Loc_Box_Eti" class="form-control" disabled>
                            <option>Escolha..</option>
                            <option>DIGITAL</option>
                            @foreach($caixa_departamento_Financeiro as $caixa_aberta)
                                <option value="{{$caixa_aberta->ordem}}">{{$caixa_aberta->ordem}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="DIRETORIA">
                        <label><b>Caixa:*</b></label>
                        <label for="Loc_Box_Eti"></label>
                        <select name="Loc_Box_Eti" id="Loc_Box_Eti" class="form-control" disabled>
                            <option>Escolha..</option>
                            <option>DIGITAL</option>
                            @foreach($caixa_departamento_Diretoria as $caixa_aberta)
                                <option style="display: block" value="{{$caixa_aberta->ordem}}">{{$caixa_aberta->ordem}}</option>
                            @endforeach
                        </select>
                    </div> 

                    <div class="PRODUÇÃO">
                        <label><b>Caixa:*</b></label>
                        <label for="Loc_Box_Eti"></label>
                        <select name="Loc_Box_Eti" id="Loc_Box_Eti" class="form-control"disabled >
                            <option>Escolha..</option>
                            <option>DIGITAL</option>
                            @foreach($caixa_departamento_Producao as $caixa_aberta)
                                <option  value="{{$caixa_aberta->ordem}}">{{$caixa_aberta->ordem}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="PÓS-PRODUÇÃO">
                        <label><b>Caixa:*</b></label>
                        <label for="Loc_Box_Eti"></label>
                        <select name="Loc_Box_Eti" id="Loc_Box_Eti" class="form-control" disabled>
                            <option>Escolha..</option>
                            <option>DIGITAL</option>
                            @foreach($caixa_departamento_Pos_Producao as $caixa_aberta)
                                <option style="display: block" value="{{$caixa_aberta->ordem}}">{{$caixa_aberta->ordem}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="COMERCIAL">
                        <label><b>Caixa:*</b></label>
                        <label for="Loc_Box_Eti"></label>
                        <select name="Loc_Box_Eti" id="Loc_Box_Eti" class="form-control" disabled>
                            <option>Escolha..</option>
                            <option>DIGITAL</option>
                            @foreach($caixa_departamento_Comercial as $caixa_aberta)
                                <option style="display: block" value="{{$caixa_aberta->ordem}}">{{$caixa_aberta->ordem}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="TÉCNICA">
                        <label><b>Caixa:*</b></label>
                        <label for="Loc_Box_Eti"></label>
                        <select name="Loc_Box_Eti" id="Loc_Box_Eti" class="form-control" disabled>
                            <option>Escolha..</option>
                            <option>DIGITAL</option>
                            @foreach($caixa_departamento_Tecnica as $caixa_aberta)
                                <option style="display: block" value="{{$caixa_aberta->ordem}}">{{$caixa_aberta->ordem}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="COPIAGEM">
                        <label><b>Caixa:*</b></label>
                        <label for="Loc_Box_Eti"></label>
                        <select name="Loc_Box_Eti" id="Loc_Box_Eti" class="form-control" disabled>
                            <option>Escolha..</option>
                            <option>DIGITAL</option>
                            @foreach($caixa_departamento_Copiagem as $caixa_aberta)
                                <option style="display: block" value="{{$caixa_aberta->ordem}}">{{$caixa_aberta->ordem}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="EDIÇÃO">
                        <label><b>Caixa:*</b></label>
                        <label for="Loc_Box_Eti"></label>
                        <select name="Loc_Box_Eti" id="Loc_Box_Eti" class="form-control" disabled>
                            <option>Escolha..</option>
                            <option>DIGITAL</option>
                            @foreach($caixa_departamento_Edicao as $caixa_aberta)
                                <option style="display: block" value="{{$caixa_aberta->ordem}}">{{$caixa_aberta->ordem}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="MAM">
                        <label><b>Caixa:*</b></label>
                        <label for="Loc_Box_Eti"></label>
                        <select name="Loc_Box_Eti" id="Loc_Box_Eti" class="form-control" disabled>
                            <option>Escolha..</option>
                            <option>DIGITAL</option>
                            @foreach($caixa_departamento_Mam as $caixa_aberta)
                                <option style="display: block" value="{{$caixa_aberta->ordem}}">{{$caixa_aberta->ordem}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="NÚCLEO-CONTEÚDO">
                        <label><b>Caixa:*</b></label>
                        <label for="Loc_Box_Eti"></label>
                        <select name="Loc_Box_Eti" id="Loc_Box_Eti" class="form-control" disabled>
                            <option>Escolha..</option>
                            <option>DIGITAL</option>
                            @foreach($caixa_departamento_Nucleo_Conteudo as $caixa_aberta)
                                <option style="display: block" value="{{$caixa_aberta->ordem}}">{{$caixa_aberta->ordem}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="CAMPANHA-POLÍTICA">
                        <label><b>Caixa:*</b></label>
                        <label for="Loc_Box_Eti"></label>
                        <select name="Loc_Box_Eti" id="Loc_Box_Eti" class="form-control" disabled >
                            <option>Escolha..</option>
                            <option>DIGITAL</option>
                            @foreach($caixa_departamento_Campanha_Politica as $caixa_aberta)
                                <option style="display: block" value="{{$caixa_aberta->ordem}}">{{$caixa_aberta->ordem}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="PROJETOS-ESPECIAIS">
                        <label><b>Caixa:*</b></label>
                        <label for="Loc_Box_Eti"></label>
                        <select name="Loc_Box_Eti" id="Loc_Box_Eti" class="form-control" disabled>
                            <option>Escolha..</option>
                            <option>DIGITAL</option>
                            @foreach($caixa_departamento_Projetos_Especiais as $caixa_aberta)
                                <option style="display: block" value="{{$caixa_aberta->ordem}}">{{$caixa_aberta->ordem}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="OUTROS">
                        <label><b>Caixa:*</b></label>
                        <label for="Loc_Box_Eti"></label>
                        <select name="Loc_Box_Eti" id="Loc_Box_Eti" class="form-control" disabled>
                            <option>Escolha..</option>
                            <option>DIGITAL</option>
                            @foreach($caixa_departamento_Outros as $caixa_aberta)
                                <option style="display: block" value="{{$caixa_aberta->ordem}}">{{$caixa_aberta->ordem}}</option>
                            @endforeach
                        </select>
                    </div>
                
                </div>
            </div>

            <div class="col-md-2">
                <label><b>Maço:</b></label>
                <label for="Loc_Maco"></label>
                <select id="Loc_Maco" name="Loc_Maco" class="form-control" required>
                <option selected>{{$edit->Loc_Maco}}</option>
                <option>Digital</option>
                <?php
                    for ($i=1; $i<4; $i++) {
                        echo "<option value='".$i."'>". $i ."</option>";
                    }
                    ?>

                </select>
            </div>


            <div class="col-md-2">
                <label><b>Status:</b></label>
                <label for="Loc_Status"></label>
                <select id="Loc_Status" name="Loc_Status" class="form-control" required>
                    <option>{{$edit->Loc_Status}}</option>
                    <option> Em Processamento </option>
                    <option> Não Arquivado </option>
                </select>
            </div>

            <div class="col-md-2">
                <label><b>Desfaz/Destruir: </b></label>
            <label for="Desfaz"></label><input placeholder= "" type="text" class="form-control" value= "{{$edit->Desfaz}}" name="Desfaz" maxlength="9" id="Desfaz" required onkeyup="maiuscula(this)">
            </div>

            <div class="col-md-6">
                <label for="exampleFormControlTextarea1"><b>Observações:</b></label>
                <label for="Loc_Obs"></label><textarea class="form-control" id="Loc_Obs" name="Loc_Obs" rows="1" value="{{$edit->Loc_Obs}}" onkeyup="maiuscula(this)">{{$edit->Loc_Obs}}</textarea>
            </div>

            <!-- Envio de Arquivos -->

            <div class="arquivo_meio">
                
                <div class="row">
                    <div class="col-md-16">
                        <div class="input-group mb-10">
                            <div class="custom-file">
                                <label class="custom-file-label" for="arquivo_campo">Upload..</label>
                                <input type="hidden" name="MAX_FILE_SIZE" value="16777216">
                                <input type="file" name="anexo[]" required="" class="custom-file-input" id="anexo[]" aria-describedby="inputGroupFileAddon01" multiple>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>



        <!-- Linha 7 -->
        <div class="row"></div>
        <!-- Linha 8 -->
        <div class="row">  </div>
     
            <!-- Separador-->
            <div class="row">
                <!-- Auditoria -> Criado e Editado pelo Usuario X -->
                <div class="col-md-4" style="padding:27px">
                    <label for="criado_por">Criado Por:</label>
                    <input type="text" class="form-control" id="criado_por" name="criado_por" value="{{session()->get('usuario')}} - {{ date('d/m/Y H:i:s')}}" readonly="readonly">
                </div>

                <div class="col-md-4" style="padding:27px">
                    <label for="editado_por">Alterado Por:</label>
                    <input type="text" class="form-control" id="editado_por" name="editado_por" maxlength="50" value="{{$edit->editado_por}} - {{date('d/m/Y H:i:s')}}" readonly="readonly">
                </div>

                <div class="col-md-4" style="padding:27px">
                    <label for="editado_por">Editando:</label>
                    <input type="text" class="form-control" id="editado_por" name="editado_por" maxlength="50" value="{{session()->get('usuario')}}" readonly="readonly">
                </div>
        </div>

    


        <!-- Botões Pagina-->
            <div class="form-group">
              <label class="col-md-6 control-label" for="Cadastrar"></label>
                <div class="col-md-6" id="botoes_cadastros">
                  <button id="Cadastrar" name="Cadastrar" class="btn btn-lg btn-success" type="Submit"> Salvar</button>
                  <button id="Cancelar" name="Cancelar" class="btn btn-lg btn-danger" type="Reset">Limpar</button>
                </div>
            </div>

    </form>


@endsection


