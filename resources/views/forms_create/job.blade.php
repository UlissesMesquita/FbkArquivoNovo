@extends('layout.cabecalho')
<!DOCTYPE html>
@section('titulo_pagina')
    Jobs
@endsection

@section('titulo')
    Cadastro de Jobs
@endsection


@section('conteudo')
    <form action="{{route('novo_job')}}" method="POST">
        {{csrf_field()}}
        <div class=""><br>
            <label>Job:</label>
            <label for="nome_job"></label><input type="text" autofocus class="form-control" id="nome_job" name="nome_job" placeholder="" required onkeyup="maiuscula(this)">
        </div>

        <br><button id="cadastrar" name="Cadastrar" class="btn btn-success btn-lg btn-block" type="Submit"> Salvar</button><br>
    </form>




    <h2> Lista de Jobs Cadastrados </h2>


    <!-- Dados da Tabela -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Jobs</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>

        {{csrf_field()}}

            @foreach($job as $jobs)
            <tr>
                <th scope="row">{{$jobs->id_job}} </th>
                <td> {{$jobs->nome_job}} </td>
                    <!-- Botões de Ação-->
                <!-- Botões de Ação-->
                <td>
                    <span></span>
                    <!-- Botão de Editar -->
                    <a class="far fa-edit fa-2x" href="{{route('job_edit', $jobs->id_job)}}" method="GET"></a>
                    <!-- Botão de Apagar -->
                    <a class="fas fa-trash fa-2x" href="/job/delete/{{$jobs->id_job}}" onclick="return confirm('Deseja realmente excluir?')" method="GET"></a>
                </td>





            </tr>
            @endforeach
        </form>
    </table>
@endsection
