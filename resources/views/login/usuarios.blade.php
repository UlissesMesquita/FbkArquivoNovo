@extends('layout.cabecalho')

@section('titulo_pagina')
    Usuários
@endsection

@section('titulo')
  Gerenciar Usuários
@endsection


@section('conteudo')

<form action="{{route('create-store')}}" method="POST">
  @csrf
<br>
<br>
  <div class="row">

    <div class="col-md-3">
      <label><b>Login:*</b></label>
      <label for="login"></label><input type="text" autofocus class="form-control" id="login" name="login" placeholder="" required>
    </div>

    <div class="col-md-2">
        <label><b>Permissão:*</b></label>
        <label for="permissao"></label>
            <select id="permissao" name="permissao" class="form-control" required>
                  <option selected>Escolha...</option>
                    <option>Admin</option>
                    <option>Operador</option>
            </select>
      </div>

      <div class="col-md-3">
        <label><b>Departamento: *</b></label>
        <label for="departamento"></label>
            <select id="departamento" name="departamento" class="form-control" required>
                <option selected>Escolha...</option>
                @if(isset($dep))
                    @foreach($dep as $departamento)
                        <option value="{{$departamento->cad_departamento}}">{{$departamento->cad_departamento}}</option>
                    @endforeach
                    @endif
                </select>
            </select>
    </div>

      <div class="col-md-2">
        <label><b>Ativo:*</b></label>
        <label for="permissao"></label>
            <select id="ativo" name="ativo" class="form-control" required>
                  <option selected>Escolha...</option>
                    <option>Ativo</option>
                    <option>Inativo</option>
            </select>
        </div>

    {{-- <div class="col-md-2">
      <label><b>Senha:*</b></label>
      <label for="password"></label><input type="password" class="form-control" id="#" name="#" placeholder="" required>
    </div> --}}

     <div class="col-md-2">
      <label><b>Senha:*</b></label>
      <label for="password"></label><input type="password" class="form-control" id="password" name="password" placeholder="" required>
    </div> 

  </div>

<br>
<br>
  <br><button id="cadastrar" name="Cadastrar" class="btn btn-success btn-lg btn-block" type="Submit"> Cadastrar</button><br>
</form>
<br>
<br>
<!--Exibição de dados -->

<h2> Lista de Usuários Cadastrados </h2>
<br>
<!-- Mostra os dados no banco de dados -->
  <table class="table table-striped">
      <thead>
          <tr>
              <th scope="col">ID</th>
              <th scope="col">Login</th>
              <th scope="col">Permissão</th> 
              <th scope="col">Departamento</th>   
              <th scope="col">Valido</th>           
              <th scope="col">Ação</th>
          </tr>
      </thead>

      {{csrf_field()}}
      
      @foreach($users as $user)
              <tr>
                  <th scope="row">{{$user->id_usuario}}</th>
                  <td>{{$user->login}}</td>
                  <td>{{$user->permissao}}</td>
                  <td>{{$user->departamento}}</td>
                  <td>{{$user->ativo}}</td>



                <!-- Botões de Ação-->
                <td>
                  <span></span>
                  <!-- Botão de Editar -->
                  <a class="far fa-edit fa-2x" method="GET" href="{{route('usuarios-edit', $user->id_usuario)}}"></a>
                  <!-- Botão de Apagar -->
                  <a class="fas fa-trash fa-2x"  method="GET" href="{{route('usuarios-delete', $user->id_usuario)}}"></a>
              </td>

              </tr>
        @endforeach

  </table>

@endsection