@extends('layout.cabecalho')

@section('titulo_pagina')
    Pesquisa
@endsection

@section('titulo')
    Pesquisa
@endsection

@section('conteudo')


<div class="container-fluid" id="campo-pesquisa">
     

    <form class="form-horizontal" name="form" method="POST" action="{{route('pesquisa_novo')}}" enctype="multipart/form-data">
        @csrf

            <!-- Linha 1 -->
            <div class="row">   

                <div class="col-md-2">
                    <label><b>Código:</b></label>
                    <label for="id_codigo"></label><input type="text" class="form-control" id="id_codigo" name="id_codigo" placeholder="">
                </div>
                
                <div class="col-md-2">
                    <label><b>Data Início: </b></label>
                    <label for="data_in"></label><input type="date" class="form-control" id="data_in" name="data_in" placeholder="" >
                    @error('data_in')
                        <div class="alert alert-warning">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label><b>Data Fim:</b> </label>
                    <label for="data_out"></label><input type="date" class="form-control" id="data_out" name="data_out" placeholder="" >
                    @error('data_out')
                        <div class="alert alert-warning">{{ $message }}</div>
                    @enderror    
                </div>

                <div class="col-md-3">
                    <label><b>Empresa Emitente:</b> </label>
                    <label for="Emp_Emit"></label>
                        <select id="Emp_Emit" name="Emp_Emit" class="form-control" >
                            <option value="">Escolha...</option>
                                @foreach($emit as $emitente)
                                    <option value="{{ $emitente->cad_emitentes }}"> {{ $emitente->cad_emitentes }} </option>
                                @endforeach
                        </select>
                </div>
    
                <div class="col-md-3">
                    <label><b>Empresa Destinatária:</b> </label>
                    <label for="Emp_Dest"></label>
                        <select id="Emp_Dest" name="Emp_Dest" class="form-control" value="" >
                            <option value="">Escolha...</option>
                                @foreach($dest as $destinataria)
                                    <option value ="{{ $destinataria->cad_destinatarias }}">{{ $destinataria->cad_destinatarias }}</option>
                                @endforeach
                        </select>
                </div>

            </div>
    <br>
            <!-- Linha 2 -->
            <div class="row"> 
                
                <div class="col-md-2">
                    <label><b>Tipo de Documento:</b> </label>
                    <label for="tp_documento"></label>
                        <select id="tp_documento" name="tp_documento" class="form-control" onkeyup="maiuscula(this)">
                            <option value="">Escolha...</option>
                                @foreach($tp_documento as $tp_documentos)
                                    <option value="{{$tp_documentos->tp_documento}}">{{$tp_documentos->tp_documento}}</option>
                                @endforeach
                            </select>
                        </select>
                </div>

                <div class="col-md-2">
                    <label><b>Departamento: *</b></label>
                    <label for="Dep"></label>
                    <select name="Dep" id="Dep" class="form-control">
                        <option selected value="">Escolha</option>
                            @if(isset($dep))
                            
                            @if(session()->get('permissao') == 'Admin' || session()->get('departamento') == 'DIRETORIA')
                                @foreach($dep as $departamento)
                                    <option value="{{$departamento->cad_departamento}}">{{$departamento->cad_departamento}}</option>
                                @endforeach
                            @endif
                                @if(session()->get('permissao') == 'Operador')
                                    <option value="{{session()->get('departamento')}}">{{session()->get('departamento')}}</option>
                                @endif     
                            @endif
                    </select>
                
                </div>

                <div class="col-md-2">
                    <label><b>Número Documento:</b> </label>
                    <label for="Nome_Doc"></label><input type="text" class="form-control" id="Nome_Doc" name="Nome_Doc" maxlength="20" placeholder="" onkeyup="maiuscula(this)">
                </div>
                
                <div class="col-md-3">
                    <label><b>Palavra-Chave:</b> </label>
                    <label for="Palavra_Chave"></label><input type="text" class="form-control" id="Palavra_Chave" name="Palavra_Chave" placeholder="" onkeyup="maiuscula(this)">
                </div>

                <div class="col-md-3">
                    <label><b>Desfaz/Destruir:</b> </label>
                    <label for="Desfaz"></label><input type="text" class="form-control" id="Desfaz" name="Desfaz"  maxlength="9" placeholder="" onkeyup="maiuscula(this)">
                </div>

            </div>

                <!-- Linha 3 -->
            <div class="row"> 

                <div class="col-md-2">
                    <label><b>Valor:</b></label>
                    <label for="Valor_Doc"></label><input type="text" class="form-control" id="Valor_Doc" name="Valor_Doc" placeholder="" onKeyPress="return(moeda(this,'.',',',event))">
                </div>


                <div class="col-md-2">
                    <label><b>Tipo de Projeto:</b></label>
                    <label for="Tp_Projeto"></label>
                    <select id="Tp_Projeto" name="Tp_Projeto" class="form-control" >
                        <option value="">Escolha...</option>
                        <option>JOB</option>
                        <option>ADM</option>
                    </select>
                </div>
                
                <div class="col-md-4" id="drop_job" style="display: block">
                    <label><b>Nome do Projeto:</b> </label>
                    <label for="nome_job"></label>
                    <select id="nome_job" name="nome_job" class="form-control" >
                        <option selected value="">Escolha...</option>
                        @if(isset($job))
                            @foreach($job as $jobs)
                                <option value="{{$jobs->nome_job}}">{{$jobs->nome_job}}</option>
                            @endforeach
                        @endif    
                    </select>
                </div>

                <div class="col-md-4">
                    <label><b>Assunto:</b></label>
                    <label for="Assunto"></label><input type="text" class="form-control" id="Assunto" name="Assunto" placeholder="" onkeyup="maiuscula(this)">
                </div>
                

            </div>

            <!-- Linha 3 -->
            <div class="row"> 

                <div class="col-md-2">
                    <label><b>Local Arquivo:</b> </label>
                    <label for="Loc_Arquivo"></label><input type="text" class="form-control" id="Loc_Arquivo" name="Loc_Arquivo" maxlength="" placeholder="" onkeyup="maiuscula(this)">
                </div>

                <div class="col-md-2">
                    <label><b>Estante:</b></label>
                    <label for="Loc_Est"></label>
                    <select id="Loc_Est" name="Loc_Est" class="form-control">
                        <option selected value="">Escolha...</option>
                        <option>Digital</option>
                        <?php
                        for ($i=1; $i<31; $i++) {
                            echo "<option value='".$i."'>". $i ."</option>";
                        }
                        ?>
    
                    </select>
                </div>
    
                <div class="col-md-2">
                    <div class="DivPai">
                        <div class="Escolha">
                            <label><b>Caixa:*</b></label>
                            <label for="Loc_Box_Eti"></label>
                            <select name="Loc_Box_Eti" id="Loc_Box_Eti" class="form-control"  >
                                    <option selected value="{{null}}">Escolha..</option>
                            </select>
                        </div>     
                    
                        <div class="ADM-FINANCEIRO">
                            <label><b>Caixa:*</b></label>
                            <label for="Loc_Box_Eti"></label>
                            <select name="Loc_Box_Eti" id="Loc_Box_Eti" class="form-control"  >
                                    <option value="" selected disabled>Escolha..</option>
                                    <option value="DIGITAL">DIGITAL</option>
                                @foreach($caixa_departamento_Financeiro as $caixa_aberta)
                                    <option value="{{$caixa_aberta->ordem}}">{{$caixa_aberta->ordem}}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="DIRETORIA">
                            <label><b>Caixa:*</b></label>
                            <label for="Loc_Box_Eti"></label>
                            <select name="Loc_Box_Eti" id="Loc_Box_Eti" class="form-control"  >
                                    <option value="" selected disabled>Escolha..</option>
                                    <option value="DIGITAL">DIGITAL</option>
                                @foreach($caixa_departamento_Diretoria as $caixa_aberta)
                                    <option style="display: block" value="{{$caixa_aberta->ordem}}">{{$caixa_aberta->ordem}}</option>
                                @endforeach
                            </select>
                        </div> 
    
                        <div class="PRODUÇÃO">
                            <label><b>Caixa:*</b></label>
                            <label for="Loc_Box_Eti"></label>
                            <select name="Loc_Box_Eti" id="Loc_Box_Eti" class="form-control"  >
                                    <option value="" selected disabled>Escolha..</option>
                                    <option value="DIGITAL">DIGITAL</option>
                                @foreach($caixa_departamento_Producao as $caixa_aberta)
                                    <option  value="{{$caixa_aberta->ordem}}">{{$caixa_aberta->ordem}}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="PÓS-PRODUÇÃO">
                            <label><b>Caixa:*</b></label>
                            <label for="Loc_Box_Eti"></label>
                            <select name="Loc_Box_Eti" id="Loc_Box_Eti" class="form-control"  >
                                    <option value=""selected disabled>Escolha..</option>
                                    <option value="DIGITAL">DIGITAL</option>
                                @foreach($caixa_departamento_Pos_Producao as $caixa_aberta)
                                    <option style="display: block" value="{{$caixa_aberta->ordem}}">{{$caixa_aberta->ordem}}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="COMERCIAL">
                            <label><b>Caixa:*</b></label>
                            <label for="Loc_Box_Eti"></label>
                            <select name="Loc_Box_Eti" id="Loc_Box_Eti" class="form-control"  >
                                    <option value="" selected disabled>Escolha..</option>
                                    <option value="DIGITAL">DIGITAL</option>
                                @foreach($caixa_departamento_Comercial as $caixa_aberta)
                                    <option style="display: block" value="{{$caixa_aberta->ordem}}">{{$caixa_aberta->ordem}}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="TÉCNICA">
                            <label><b>Caixa:*</b></label>
                            <label for="Loc_Box_Eti"></label>
                            <select name="Loc_Box_Eti" id="Loc_Box_Eti" class="form-control"  >
                                    <option value="" selected disabled>Escolha..</option>
                                    <option value="DIGITAL">DIGITAL</option>
                                @foreach($caixa_departamento_Tecnica as $caixa_aberta)
                                    <option style="display: block" value="{{$caixa_aberta->ordem}}">{{$caixa_aberta->ordem}}</option>
                                @endforeach
                            </select>
                        </div>
    
                        
                        <div class="COPIAGEM">
                            <label><b>Caixa:*</b></label>
                            <label for="Loc_Box_Eti"></label>
                            <select name="Loc_Box_Eti" id="Loc_Box_Eti" class="form-control"  >
                                    <option value="" selected disabled>Escolha..</option>
                                    <option value="DIGITAL">DIGITAL</option>
                                @foreach($caixa_departamento_Copiagem as $caixa_aberta)
                                    <option style="display: block" value="{{$caixa_aberta->ordem}}">{{$caixa_aberta->ordem}}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="EDIÇÃO">
                            <label><b>Caixa:*</b></label>
                            <label for="Loc_Box_Eti"></label>
                            <select name="Loc_Box_Eti" id="Loc_Box_Eti" class="form-control"  >
                                    <option value="" selected disabled>Escolha..</option>
                                    <option value="DIGITAL">DIGITAL</option>
                                @foreach($caixa_departamento_Edicao as $caixa_aberta)
                                    <option style="display: block" value="{{$caixa_aberta->ordem}}">{{$caixa_aberta->ordem}}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="MAM">
                            <label><b>Caixa:*</b></label>
                            <label for="Loc_Box_Eti"></label>
                            <select name="Loc_Box_Eti" id="Loc_Box_Eti" class="form-control"  >
                                    <option value="" selected disabled>Escolha..</option>
                                    <option value="DIGITAL">DIGITAL</option>
                                @foreach($caixa_departamento_Mam as $caixa_aberta)
                                    <option style="display: block" value="{{$caixa_aberta->ordem}}">{{$caixa_aberta->ordem}}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="NÚCLEO-CONTEÚDO">
                            <label><b>Caixa:*</b></label>
                            <label for="Loc_Box_Eti"></label>
                            <select name="Loc_Box_Eti" id="Loc_Box_Eti" class="form-control"  >
                                    <option value="" selected disabled>Escolha..</option>
                                    <option value="DIGITAL">DIGITAL</option>
                                @foreach($caixa_departamento_Nucleo_Conteudo as $caixa_aberta)
                                    <option style="display: block" value="{{$caixa_aberta->ordem}}">{{$caixa_aberta->ordem}}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="CAMPANHA-POLÍTICA">
                            <label><b>Caixa:*</b></label>
                            <label for="Loc_Box_Eti"></label>
                            <select name="Loc_Box_Eti" id="Loc_Box_Eti" class="form-control"  >
                                    <option value="" selected disabled>Escolha..</option>
                                    <option value="DIGITAL">DIGITAL</option>
                                @foreach($caixa_departamento_Campanha_Politica as $caixa_aberta)
                                    <option style="display: block" value="{{$caixa_aberta->ordem}}">{{$caixa_aberta->ordem}}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="PROJETOS-ESPECIAIS">
                            <label><b>Caixa:*</b></label>
                            <label for="Loc_Box_Eti"></label>
                            <select name="Loc_Box_Eti" id="Loc_Box_Eti" class="form-control"  >
                                    <option value="" selected disabled>Escolha..</option>
                                    <option value="DIGITAL">DIGITAL</option>
                                @foreach($caixa_departamento_Projetos_Especiais as $caixa_aberta)
                                    <option style="display: block" value="{{$caixa_aberta->ordem}}">{{$caixa_aberta->ordem}}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="OUTROS">
                            <label><b>Caixa:*</b></label>
                            <label for="Loc_Box_Eti"></label>
                            <select name="Loc_Box_Eti" id="Loc_Box_Eti" class="form-control"  >
                                    <option value="" disabled>Escolha..</option>
                                    <option value="DIGITAL">DIGITAL</option>
                                @foreach($caixa_departamento_Outros as $caixa_aberta)
                                    <option style="display: block" value="{{$caixa_aberta->ordem}}">{{$caixa_aberta->ordem}}</option>
                                @endforeach
                            </select>
                        </div>
                    
                    </div>
    
                </div>
    
                <div class="col-md-2">
                    <label><b>Maço:</b></label>
                    <label for="Loc_Maço"></label>
                    <select id="Loc_Maço" name="Loc_Maco" class="form-control">
                        <option selected value="">Escolha...</option>
                        <option>Digital</option>
                        <?php
                        for ($i=1; $i<4; $i++) {
                            echo "<option value='".$i."'>". $i ."</option>";
                        }
                        ?>
    
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="exampleFormControlTextarea1"><b>Observações:</b></label>
                    <label for="Loc_Obs"></label><textarea class="form-control" id="Loc_Obs" name="Loc_Obs" rows="1" onkeyup="maiuscula(this)"></textarea>
                </div>

            </div>

            <!-- Linha 4 -->
            <div class="row"> 

                <div class="col-md-2">
                    <label><b>Data Referência:</b></label>
                    <label for="Dt_Ref"></label><input placeholder= "" class="form-control" type="text" name="Dt_Ref" id="Dt_Ref">
                </div>

                <div class="col-md-2" id="drop_job" style="display: block">
                    <label><b>Criado por: </b></label>
                    <label for="criado_por"></label>
                    <select id="criado_por" name="criado_por" class="form-control" >
                    <option selected value="">Escolha...</option>
                        @if(isset($criado))
                            @foreach($criado as $create)
                                <option value="{{$create->criado_por}}">{{$create->criado_por}}</option>
                            @endforeach
                        @endif    
                    </select>
                </div>

                <div class="col-md-2" id="drop_job" style="display: block">
                    <label><b>Editado Por:</b> </label>
                    <label for="editado_por"></label>
                    <select id="editado_por" name="editado_por" class="form-control" >
                        <option selected value="">Escolha...</option>
                        @if(isset($editado))
                            @foreach($editado as $edit)
                                <option value="{{$edit->editado_por}}">{{$edit->editado_por}}</option>
                            @endforeach
                        @endif    
                    </select>
                </div>
            </div>

            <!-- Botões Pagina-->
                <div class="form-group">
                <label class="col-md-6 control-label" for="Cadastrar"></label>
                    <div class="col-md-6" id="botoes_cadastros">
                    <button id="Pesquisar" name="Pesquisar" class="btn btn-lg btn-success" type="Submit"> Pesquisar</button>
                    <button id="Cancelar" name="Cancelar" class="btn btn-lg btn-danger" type="Reset">Limpar</button>
                    
                    </div>
                </div>
    </form>
                <form class="form-horizontal" name="form" method="GET" action="{{route('documentos_create')}}">
                    <div class="form-group">
                        <label class="col-md-6 control-label" for="Cadastrar_Novo"></label>
                            <div class="col-md-4" id="Cadastrar_Novo">
                                <button id="Cadastrar_Novo" name="Cadastrar_Novo" class="btn btn-lg btn-primary" type="Submit">Novo Cadastro</button>
                            </div>
                    </div>
                </form>
            <br>

</div>


@if(isset($contador))
<h5> Registros Encontrados: {{$contador}} </h5>
@endif

<div class="d-flex justify-content-center" style="margin: auto;">
    <!-- {{$dash->links()}} -->
    {{ $dash->links('pagination::default') }}
</div>
    

<!-- Mostra os dados no banco de dados -->
   <table class="table table-striped">
    <thead>
        <tr id="Cabecalho-tabela">

            <th scope="col"><b>ID</b></td>
            <th scope="col"><b>Data Principal</b></td>
            <th scope="col"><b>Emitente</b></td>
            <th scope="col"><b>Destinatária</b></th>
            <th scope="col"><b>Departamento</b></th>    
            <th scope="col"><b>Tipo Documento</b></td>
            <th scope="col"><b>Nº Documento</b></td>
            <th scope="col"><b>Palavra Chave</b></td>
            <th scope="col"><b>Tipo projeto</b></td>
            <th scope="col"><b>Assunto</b></th>
            <th scope="col"><b>Nome Projeto</b></td>
            <th scope="col"><b>Local Arquivo</b></td>
            <th scope="col"><b>Estante</b></td>
            <th scope="col"><b>Caixa</b></td>
            <th scope="col"><b>Maço</b></td>
            <th scope="col"><b>Mês Referência</b></td>               
            <th scope="col"><b>Valor</b></td>

            <th scope="col">Ferramentas</th>
        </tr>
    </thead>

    <tbody>

        @foreach($dash as $dashboard)
            <tr>
                    <td scope="row">{{$dashboard->id_codigo}}</td>
                    <td> <a href="/dashboard/documentos_edit/{{$dashboard->id_codigo}}" method="GET">{{date('d/m/Y', strtotime($dashboard->data))}}</a></td>
                    <td>{{$dashboard->Emp_Emit}}</td>
                    <td>{{$dashboard->Emp_Dest}}</td>
                    <td>{{$dashboard->Dep}}</td>    
                    <td>{{$dashboard->tp_documento}}</td>
                    <td>{{$dashboard->Nome_Doc}}</td>
                    <td>{{$dashboard->Palavra_Chave}}</td>
                    <td>{{$dashboard->Tp_Projeto}}</td>
                    <td>{{$dashboard->Assunto}}</td>
                    <td>{{$dashboard->nome_job}}</td>
                    <td>{{$dashboard->Loc_Arquivo}}</td>
                    <td>{{$dashboard->Loc_Est}}</td>
                    <td>{{$dashboard->Loc_Box_Eti}}</td>
                    <td>{{$dashboard->Loc_Maco}}</td>
                    <td>{{$dashboard->Dt_Ref}}</td>  
                    <td id="Valor_Doc">{{$dashboard->Valor_Doc}}</td>

                <td>
                
                    

                            <!-- Botão de Editar -->
                            @if(session()->get('departamento') == $dashboard->Dep || session()->get('permissao') == 'Admin' || session()->get('departamento') == 'DIRETORIA')
                                <a id="edit-icon" style="color:green" class="far fa-edit fa-2x" href="/dashboard/documentos_edit/{{$dashboard->id_codigo}}" method="GET" onclick=""></a>
                            @endif

                                <!-- Botão de Clonar -->
                            @if(session()->get('departamento') == $dashboard->Dep || session()->get('permissao') == 'Operador' || session()->get('permissao') == 'Admin' || session()->get('departamento') == 'DIRETORIA')
                                <a id="clone-icon" style="color:gray" class="far fa-copy fa-2x" href="/documento/edit_clone/{{$dashboard->id_codigo}}" method="GET" onclick=""></a>
                            @endif
                        
                            <!-- Botão de Apagar -->
                            @if(session()->get('permissao') == 'Admin')
                                <a id="delete-icon" style="color:red" class="fas fa-trash fa-2x" href="/dashboard/delete/{{$dashboard->id_codigo}}" onclick="return confirm('Deseja realmente excluir?')" method="GET"></a>
                            @endif

                            <!-- Botão de Anexo -->
                            @if(session()->get('departamento') == $dashboard->Dep || session()->get('permissao') == 'Admin' || session()->get('departamento') == 'DIRETORIA')
                                <a type="submit"href="documento/anexo/{{$dashboard->id_codigo}}" class="btn btn-link" target="_blank"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true"></i></a>
                            @endif
                      
 

                </td>
            </tr>
                    

            </tr>
        @endforeach
    </tbody>
</table>
<script>
$(document).ready(function() {
  $('table td#Valor_Doc').each(function() {
    var number = parseFloat($(this).text());
    if (!isNaN(number)) {
      var formattedNumber = number.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
      $(this).text(formattedNumber);
    }
  });
});

</script>

@endsection

