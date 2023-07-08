@extends('layout.cabecalho')
<!DOCTYPE html>
@section('titulo_pagina')
    Relatório Geral
@endsection

@section('titulo')
    Relatório Geral
@endsection

@section('conteudo')
    <!--Exibição de dados -->
<h2> Relatório Solicitado </h2>


@if(isset($contador))
<h5> Registros Encontrados: {{$contador}} </h5>
@endif

    <!-- Mostra os dados no banco de dados -->
    <form id="exportPdfDois" method="POST" href='/relatorios/Epdf'>
        @csrf
    <table class="table table-striped">
        <thead>
            <tr id="Cabecalho-tabela">

                <th scope="col"><b>ID</b></td>
                <th scope="col"><b>Data Principal</b></td>
                <th scope="col"><b>Emitente</b></td>
                <th scope="col"><b>Destinatária</b></th>
                <th scope="col"><b>Departamento</b></th>    
                <th scope="col"><b>Tp Doc</b></td>
                <th scope="col"><b>Nº Documento</b></td>
                <th scope="col"><b>Palavra Chave</b></td>
                <th scope="col"><b>Tipo projeto</b></td>
                <th scope="col"><b>Assunto</b></th>
                <th scope="col"><b>Nome Projeto</b></td>
                <th scope="col"><b>Local Arquivo</b></td>
                <th scope="col"><b>Estante</b></td>
                <th scope="col"><b>Caixa</b></td>
                <th scope="col"><b>Maço</b></td>
                <th scope="col"><b>Mês Ref</b></td>               
                <th scope="col"><b>Valor</b></td>

                <th scope="col">Ferramentas</th>
            </tr>
        </thead>

        <tbody>

            
                @csrf 
                {{-- <input type="hidden" name="#" value="#"> --}}
                <button type="submit" class="btn btn-primary" onclick="console.log('Clicado')">PDF</button>

            

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
                        <td>R${{$dashboard->Valor_Doc}}</td>
         
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
                            {{-- <form method="POST" action="{{route('visualizar_anexo')}}">
                                @csrf 
                                    <input type="hidden" name="id_codigo" value="{{$dashboard->id_codigo}}">
                                    <button type="submit" class="btn btn-link" target="_blank"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true"></i></button>
                            </form> --}}
                        @endif
                    </td>
                </tr>
            </tr>
            @endforeach

        

        </tbody>
    </table>
</form>
@endsection