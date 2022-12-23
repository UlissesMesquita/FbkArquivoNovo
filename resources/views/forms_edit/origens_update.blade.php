@extends('layout.cabecalho')

@section('titulo_pagina')
    Editando Origem
@endsection

@section('titulo')
    Editando a Origem: {{$edit->cad_origem}}
@endsection

@section('conteudo')
    <form action="{{route('origem_update', $edit->id_origem)}}" method="POST">
        @method('PUT')
        @csrf
        <div class=""><br>
            <label>Origem:</label>
        <label for="cad_origem"></label><input type="text" autofocus class="form-control" id="cad_origem" name="cad_origem" placeholder="" value="{{$edit->cad_origem}}" required onkeyup="maiuscula(this)">
        </div>

        <br><button id="cadastrar" name="Cadastrar" class="btn btn-success btn-lg btn-block" type="Submit"> Alterar </button><br>
    </form>

@endsection
