@extends('layout.cabecalho')
<!DOCTYPE html>
@section('titulo_pagina')
    Departamentos
@endsection

@section('titulo')
    Cadastro de Departamento
@endsection

@section('conteudo')


    <form action="{{route('novo_departamento')}}" method="POST">
        @csrf
        <div class=""><br>
            <label>Departamentos:</label>
            <label for="cad_departamento"></label><input type="text" autofocus class="form-control" id="cad_departamento" name="cad_departamento" placeholder="" required onkeyup="maiuscula(this)" >
        </div>

        <br><button id="cadastrar" name="Cadastrar" class="btn btn-success btn-lg btn-block" type="Submit"> Salvar</button><br>
    </form>


    <!--Exibição de dados -->
<h2> Lista de Departamentos Cadastrados </h2>

    <!-- Mostra os dados no banco de dados -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Departamentos</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>

        
        {{csrf_field()}}

            @foreach($departamentos as $departamento)

                <tr>
                    <th scope="row">{{ $departamento->id_departamento }} </th>
                    <td>{{$departamento['cad_departamento']}}</td>

                   <!-- Botões de Ação-->
                    <td>
                        <span></span>
                        <!-- Botão de Editar -->
                        <a class="far fa-edit fa-2x" href="{{route('departamento_edit', $departamento->id_departamento)}}" method="GET"></a>
                        <!-- Botão de Apagar -->
                        <a class="fas fa-trash fa-2x" href="/departamento/delete/{{$departamento->id_departamento}}" onclick="return confirm('Deseja realmente excluir?')" method="GET"></a>
                    </td>
                </tr>
            @endforeach
    </table>
@endsection

