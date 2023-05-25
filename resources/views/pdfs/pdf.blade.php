<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/cabecalho.css')}}">
    <link rel="stylesheet" href="{{asset('css/Stylesheet.css')}}">


    <link rel="stylesheet" href="{{asset('css/fontawesome/css/all.css')}}">

    <meta charset="utf-8">
        <title>Relatório</title>
</head>


<body>

    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/JQuery.js')}}"></script><!--Versão 3.1.0-->
    <script type="text/javascript" src="{{asset('js/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jsPersonalizado.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/upper.js')}}"></script>

    <script src="{{asset('js/Javascript.js')}}"></script>
<div class="container-fluid" id="campo-pesquisa">
     



<!-- Mostra os dados no banco de dados -->
   <table class="table" border="1">
    <thead>
        <tr id="Cabecalho-tabela">

            <th scope="col"><b>ID</b></td>
            <th scope="col"><b>Data Principal</b></td>
            <th scope="col"><b>Emitente</b></td>
            <th scope="col"><b>Destinatária</b></th>
            <th scope="col"><b>Departamento</b></th>    
            <th scope="col"><b>Tipo Documento</b></td>
            <th scope="col"><b>Nº Documento</b></td>
            <th scope="col"><b>Palavra Chave</b></td>
            <th scope="col"><b>Tipo projeto</b></td>
            <th scope="col"><b>Assunto</b></th>
            <th scope="col"><b>Nome Projeto</b></td>
            <th scope="col"><b>Local Arquivo</b></td>
            <th scope="col"><b>Estante</b></td>
            <th scope="col"><b>Caixa</b></td>
            <th scope="col"><b>Maço</b></td>
            <th scope="col"><b>Mês Referência</b></td>               
            <th scope="col"><b>Valor</b></td>


        </tr>
    </thead>



        

    <tbody>
        @foreach($cadastros as $dashboard)

        {{-- //{{dd($dashboard)}} --}}
        
            <tr>
                <td scope="row">{{$dashboard->id_codigo}}</td>
                <td> <a href="/dashboard/documentos_edit/{{$dashboard->id_codigo}}" method="GET">{{date('d/m/Y', strtotime($dashboard->data))}}</a></td>
                <td>{{$dashboard->Emp_Emit}}</td>
                <td>{{$dashboard->Emp_Dest}}</td>
                <td>{{$dashboard->Dep}}</td>    
                <td>{{$dashboard->tp_documento}}</td>
                <td>{{$dashboard->Nome_Doc}}</td>
                <td>{{$dashboard->Palavra_Chave}}</td>
                <td>{{$dashboard->Tp_Projeto}}</td>
                <td>{{$dashboard->Assunto}}</td>
                <td>{{$dashboard->nome_job}}</td>
                <td>{{$dashboard->Loc_Arquivo}}</td>
                <td>{{$dashboard->Loc_Est}}</td>
                <td>{{$dashboard->Loc_Box_Eti}}</td>
                <td>{{$dashboard->Loc_Maco}}</td>
                <td>{{$dashboard->Dt_Ref}}</td>  
                <td>R${{$dashboard->Valor_Doc}}</td>
            </tr>
                    

            </tr>
        @endforeach
    </tbody>
</table>


</div>


<footer>
    <b>©Controle de Arquivo Fabrika</b> Versão 1.0
    <br>
    Desenvolvido por <b>Ulisses Mesquita</b> 
    <br>
    Autorizado para Fabrika Filmes
</footer>
</div>


</body>
</html>


