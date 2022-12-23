@extends('layout.cabecalho')
<!DOCTYPE html>
@section('titulo_pagina')
    Editando Jobs
@endsection

@section('titulo')
    Editando Job: {{$edit->nome_job}}
@endsection


@section('conteudo')
    <form action="{{route('job_update', $edit->id_job)}}" method="POST">
        @method('PUT')
        {{csrf_field()}}
        <div class=""><br>
            <label>Jobs:</label>
        <label for="nome_job"></label><input type="text" class="form-control" autofocus id="nome_job" name="nome_job" placeholder="" value="{{$edit->nome_job}}" onkeyup="maiuscula(this)" required>
        </div>

        <br><button id="cadastrar" name="Cadastrar" class="btn btn-success btn-lg btn-block" type="Submit"> Salvar</button><br>
    </form>

@endsection
