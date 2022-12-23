@extends('layout.cabecalho')
<!DOCTYPE html>
@section('titulo_pagina')
    Empresas Emitentes
@endsection

@section('titulo')
    Cadastro de Empresas Emitentes
@endsection


@section('conteudo')
    <form action="{{route('novo_emitente')}}" method="POST">
        {{csrf_field()}}
        <div class=""><br>
            <label>Empresas Emitentes:</label>
            <label for="cad_emitentes"></label><input type="text" autofocus class="form-control" id="cad_emitentes" name="cad_emitentes" placeholder="" required onkeyup="maiuscula(this)">
        </div>

        <br><button id="cadastrar" name="Cadastrar" class="btn btn-success btn-lg btn-block" type="Submit"> Salvar</button><br>
    </form>




    <h2> Lista de Empresas Emitentes Cadastradas </h2>


    <!-- Dados da Tabela -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Empresas Emitentes</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>

        {{csrf_field()}}

            @foreach($emit as $emitente)
            <tr>
                <th scope="row">{{$emitente->id_empresa_emitente}} </th>
                <td> {{$emitente->cad_emitentes}} </td>
                    <!-- Botões de Ação-->
                <!-- Botões de Ação-->
                <td>
                    <span></span>
                    <!-- Botão de Editar -->
                    <a class="far fa-edit fa-2x" href="{{route('emitente_edit', $emitente->id_empresa_emitente)}}" method="GET"></a>
                    <!-- Botão de Apagar -->
                    <a class="fas fa-trash fa-2x" href="/emitente/delete/{{$emitente->id_empresa_emitente}}" onclick="return confirm('Deseja realmente excluir?')" method="GET"></a>
                </td>





            </tr>
            @endforeach
        </form>
    </table>
@endsection
