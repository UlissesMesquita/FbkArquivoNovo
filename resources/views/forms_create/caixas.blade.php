@extends('layout.cabecalho')

@section('titulo_pagina')
    Gerenciar Caixas
@endsection

@section('titulo')
  Criar Caixas
@endsection


@section('conteudo')
<br>

<form action="{{route('nova_caixa')}}" method="POST">
  @csrf
<div class="row">

  <div class="col-md-2">
    <label><b>Departamento: *</b></label>
    <label for="Dep"></label>
        <select id="id_departamento" name="id_departamento" class="form-control" required>     
            <option selected>Escolha...</option>
            @if(isset($departamentos))
                {{-- @if(session()->get('permissao') == 'Admin' || session()->get('departamento') == 'DIRETORIA') --}}
                @foreach($departamentos as $departamento)
                    <option value="{{$departamento->id_departamento}}">{{$departamento->cad_departamento}}</option>
                @endforeach
                {{-- @endif --}}
                    {{-- <option selected value="{{session()->get('departamento')}}" >{{session()->get('departamento')}}</option> --}}
                @endif
            </select>
        </select>
</div>



</div>
  <br><button id="cadastrar" name="Cadastrar" class="btn btn-success btn-lg btn-block" type="Submit"> Criar</button><br>
</form>


<!--Exibição de dados -->
   
    @foreach($departamentos as $departamento)
<br>
<div class="row">
    <div class="col">
    <h2> {{$departamento->cad_departamento}}</h2>

<!-- Mostra os dados no banco de dados -->
<table class="table table-striped">
  <thead>
    
      <tr>

          <th scope="col">Nº Caixa</th>
          <th scope="col">Status</th>
          
          <th scope="col">Ação</th>

      </tr>
  </thead>

  {{csrf_field()}}
        
    @foreach($departamento->caixa_departamento as $caixa)
    
    {{-- @if($caixa->status == 'Aberta') --}}

          <tr>
              <th scope="row"> {{$caixa->ordem }} </th>
              <th scope="row">{{ $caixa->status}}</th>
              

             <!-- Botões de Ação-->
              <td>
                  <span></span>
                  @if($caixa->status == 'Aberta')
                    <!-- Botão de Travar Caixa -->
                    <a class="fas fa-unlock fa-2x" href="/caixas/fechar/{{$caixa->id_caixa}}" onclick="return confirm('Deseja realmente fechar a Caixa?')" method="GET"></a>
                  @else
                    <!-- Botão de Destravar Caixa -->
                    <a class="fas fa-lock fa-2x" href="/caixas/abrir/{{$caixa->id_caixa}}" onclick="return confirm('Deseja realmente Abrir a Caixa?')" method="GET"></a>
                  @endif

                  {{-- <!-- Botão de Editar -->
                  <a class="far fa-edit fa-2x" href="{{route('caixa_edit', $caixa->id_caixa)}}" method="GET"></a> --}}

                  {{-- <!-- Botão de Apagar -->
                  <a class="fas fa-trash fa-2x" href="/caixas/delete/{{$caixa->id_caixa}}" onclick="return confirm('Deseja realmente excluir?')" method="GET"></a> --}}
              </td>
          </tr>
        </div>
        {{-- @endif --}}
    @endforeach
</table>
</div>
</div>
@endforeach






@endsection