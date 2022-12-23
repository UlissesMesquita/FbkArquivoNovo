@extends('layout.cabecalho')
<!DOCTYPE html>
@section('titulo_pagina')
    Empresas Destinatárias
@endsection

@section('titulo')
    Cadastro de Empresas Destinatárias
@endsection

@section('conteudo')
    <form action="{{route('novo_destinataria')}}" method="POST">
        @csrf
        <div class=""><br>
            <label>Empresas Destinatarias:</label>
            <label for="cad_destinatarias"></label><input autofocus type="text" class="form-control" id="cad_destinatarias" name="cad_destinatarias" placeholder="" required onkeyup="maiuscula(this)">
        </div>

        <br><button id="cadastrar" name="Cadastrar" class="btn btn-success btn-lg btn-block" type="Submit"> Salvar</button><br>
    </form>

    <!--Exibição de dados -->

<h2> Lista de Empresas Destinatárias Cadadastradas </h2>

    <!-- Mostra os dados no banco de dados -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Empresas Destinatárias</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>

            {{csrf_field()}}
            
                @foreach($destinatarias as $destinataria)
                    <tr>
                        <th scope="row">{{$destinataria->id_empresa_destinataria}} </th>
                        <td> {{$destinataria->cad_destinatarias}} </td>

                <!-- Botões de Ação-->
                <td>
                    <span></span>
                    <!-- Botão de Editar -->
                    <a class="far fa-edit fa-2x" href="{{route('destinatarias_edit',$destinataria->id_empresa_destinataria)}}" method="GET"></a>
                    <!-- Botão de Apagar -->
                    <a class="fas fa-trash fa-2x" href="/destinataria/delete/{{$destinataria->id_empresa_destinataria}}" onclick="return confirm('Deseja realmente excluir?')" method="GET"></a>
                </td>




                    </tr>
                @endforeach

        </table>
@endsection

