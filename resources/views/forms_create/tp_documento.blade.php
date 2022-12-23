@extends('layout.cabecalho')

@section('titulo_pagina')
    Tipo de Documentos
@endsection

@section('titulo')
    Cadastro de Tipo de Documentos
@endsection

@section('conteudo')
    <form action="{{route('novo_tp_documento')}}" method="POST">
        @csrf
        <div class=""><br>
            <label>Tipo de Documentos:</label>
            <label for="tp_documento"></label><input type="text" autofocus class="form-control" id="tp_documento" name="tp_documento" placeholder="" required onkeyup="maiuscula(this)">
        </div>

        <br><button id="cadastrar" name="Cadastrar" class="btn btn-success btn-lg btn-block" type="Submit"> Salvar</button><br>
    </form>



    <!--Exibição de dados -->

    <h2> Lista de Tipos de Documentos </h2>
    <!-- Mostra os dados no banco de dados -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tipos de Documentos</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>


        {{csrf_field()}}

        @foreach($tp_documento as $tp_documentos)
            <tr>
                <th scope="row">{{ $tp_documentos->id_tp_documento }}</th>
                <td> {{ $tp_documentos->tp_documento }} </td>

        <!-- Botões de Ação-->
                <td>
                    <span></span>
                    <!-- Botão de Editar -->
                    <a class="far fa-edit fa-2x" href="{{route('tp_documento_edit', $tp_documentos->id_tp_documento)}}" method="GET"></a>
                    <!-- Botão de Apagar -->
                    <a class="fas fa-trash fa-2x" href="/tp_documento/delete/{{$tp_documentos->id_tp_documento}}" onclick="return confirm('Deseja realmente excluir?')" method="GET"></a>
                    
                </td>
            </tr>
        @endforeach

    </table>
    </div>

@endsection
