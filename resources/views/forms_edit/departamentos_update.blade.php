@extends('layout.cabecalho')
<!DOCTYPE html>
@section('titulo_pagina')
    Editando Departamento 
@endsection

@section('titulo')
    Editando o Departamento: {{$dep_edit->cad_departamento}}
@endsection

@section('conteudo')
    <form action="{{route('departamento_update', $dep_edit->id_departamento)}}" method="POST">
        
        @method('PUT')
        @csrf
        <div class=""><br>
            <label>Edite o Departamento:</label>
        <label for="cad_departamento"></label><input type="text" autofocus class="form-control" id="cad_departamento" name="cad_departamento" placeholder="" value="{{$dep_edit->cad_departamento}}" required onkeyup="maiuscula(this)">
        </div>

        <br><button id="cadastrar" name="Cadastrar" class="btn btn-success btn-lg btn-block" type="Submit"> Alterar</button><br>
    </form>

@endsection
