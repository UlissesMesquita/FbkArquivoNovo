@extends('layout.cabecalho')
<!DOCTYPE html>
@section('titulo_pagina')
    Pesquisa
@endsection

@section('titulo')
    Pesquisa
@endsection

@section('conteudo')
    <!--Exibição de dados -->
<h2> Busca Solicitada </h2>

    <!-- Mostra os dados no banco de dados -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Código</th>
                <th>Data</th>
                <th>Emitente</th>
                <th>Destinatária</th>
                <th>Tipo Documento Arquivado</th>
                <th>Tipo de Projeto</th>
                <th>Número Documento</th>
                <th>Valor</th>
                <th>Data Referência</th>
                <th>Titulo Documento</th>
                <th>Palavra Chave</th>
                <th>Departamento</th>
                <th>Ferramentas</th>
            </tr>
        </thead>

        <tbody>

            <tr>
                <td scope="row">{{$dashboard->id_codigo}}</td>
                <td> <a href="documentos_edit/{{$dashboard->id_codigo}}" method="GET">{{date('d/m/Y', strtotime($dashboard->data))}}</a></td>
                <td> {{$dashboard->Emp_Emit}}</td>
                <td> {{$dashboard->Emp_Dest}}</td>
                <td> {{$dashboard->Palavra_Chave}} </td>
                <td> {{$dashboard->Nome_Doc}}</td>
                <td> {{$dashboard->Loc_Obs}} </td>
                <td> R${{$dashboard->Valor_Doc}}</td>
                <td> {{$dashboard->Loc_Box_Eti}}</td>
                <td> {{$dashboard->Tp_Projeto}}</td>
    
                            <!-- Botões de Ação-->
                        <td>
                            <!-- Botão de Exibir PDF -->
                            <form method="POST" action="{{ asset('storage/pdfs/'.$dashboard->id_codigo.'_'. $dashboard->Tit_Doc .'.pdf')}}" target="_blank">
                                <input type="hidden" name="pdf" value="#">
                                <button type="submit" class="btn btn-success">
                                    <span class="fas fa-file-pdf"></span>
                                </button>
                            </form>

                            <span></span>

                            <!-- Botão de Editar -->
                            <form method="GET" action="/dashboard/documentos_edit/{{$dashboard->id_codigo}}">
                                <input type="hidden" value="{{$dashboard->id_codigo}}">
                                <button type="submit" class="btn btn-primary">
                                    <span class="far fa-edit"></span>
                                </button>
                            </form>

                            <span></span>
                            <!-- Botão de Apagar -->
                            <form method="GET" action="/dashboard/delete/{{$dashboard->id_codigo}}">
                                    <button type="submit" class="btn btn-danger">
                                        <input type="hidden" value="{{$dashboard->id_codigo}}" onclick="return confirm('Deseja realmente excluir?')">
                                        <span class="fas fa-trash"></span>
                                    </button>
                            </form>
                        </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection