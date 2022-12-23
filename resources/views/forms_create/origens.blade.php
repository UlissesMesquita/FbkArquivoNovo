@extends('layout.cabecalho')

@section('titulo_pagina')
    Origens
@endsection

@section('titulo')
    Cadastro de Origens
@endsection

@section('conteudo')
    <form action="{{route('novo_origem')}}" method="POST">
        @csrf
        <div class=""><br>
            <label>Origem:</label>
            <label for="cad_origem"></label><input type="text" autofocus class="form-control" id="cad_origem" name="cad_origem" placeholder="" required onkeyup="maiuscula(this)">
        </div>

        <br><button id="cadastrar" name="Cadastrar" class="btn btn-success btn-lg btn-block" type="Submit"> Salvar</button><br>
    </form>



    <!--Exibição de dados -->

    <h2> Lista de Origens Cadastradas </h2>
    <!-- Mostra os dados no banco de dados -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Origens</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>


        {{csrf_field()}}

        @foreach($origem as $origens)
            <tr>
                <th scope="row">{{ $origens->id_origem }}</th>
                <td> {{ $origens->cad_origem }} </td>

        <!-- Botões de Ação-->
                <td>
                    <span></span>
                    <!-- Botão de Editar -->
                    <a class="far fa-edit fa-2x" href="{{route('origem_edit', $origens->id_origem)}}" method="GET"></a>
                    <!-- Botão de Apagar -->
                    <a class="fas fa-trash fa-2x" href="/origem/delete/{{$origens->id_origem}}" onclick="return confirm('Deseja realmente excluir?')" method="GET"></a>
                    
                </td>
            </tr>
        @endforeach

    </table>
    </div>

@endsection
