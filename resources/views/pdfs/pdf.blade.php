<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <meta charset="utf-8">
    <title>  RELATÓRIO DE CONFERÊNCIA DE ENTRADA DE LOTE</title>

        <style>
            .table {
                font-size: 2mm;
                margin: 0;
                padding: 0;
                box-sizing: border-box;

            }
            #valor {
                text-align: right;
            }
            td {
                max-width: 100px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
                margin: 5% 0;
                text-align: left;
            }
            tr {
                height: 100%;
            }

            h1 {
                text-align: center; center;
                    padding: 1px;
                }

            h2 {
                text-align: center;
                padding: 1px;
            }

            #paginate {
                align-items: right; 
                justify-content: right; 
                text-align: right;
                position: absolute; 
                width: 100%;
            } 

            footer {
                    text-align: center;
                    width: 100%;
                    position: fixed;
                    bottom: 0;
                    right: 0;
                    color: white;
                    display: flex;
                    font-size: 8px;
                    height: 4%;
                    background: #333;
            }

            #total {
                float: right;
            }

        </style>


</head>


<body>



    

    <h2> RELATÓRIO DE CONFERÊNCIA DE ENTRADA DE LOTE </h2>

    <br>

    <div id="imgs">
        {{-- Logos --}}
        <img src="{{base_path('public/logos/fabrika.jpg')}}" height="50" width="150" hspace="25" style="text-align: center">
        <img src="{{base_path('public/logos/conecta.jpg') }}" height="50" width="150" hspace="25">
        <img src="{{base_path('public/logos/kuarup.jpg')}}" height="50" width="150" hspace="25">
        <img src="{{base_path('public/logos/loccamera.jpg')}}" height="50" width="150" hspace="25">
        <img src="{{base_path('public/logos/cientik.jpg')}}" height="50" width="150" hspace="25">
    </div>
    <br>

<div class="container-fluid" id="campo-pesquisa">
     

    <h5> Registros Encontrados: {{count($cadastros)}} </h5>

<!-- Mostra os dados no banco de dados -->
   <table class="table" id="table-main "border="2">
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
            {{-- <th scope="col"><b>Assunto</b></th> --}}
            <th scope="col"><b>Nome Projeto</b></td>
            {{-- <th scope="col"><b>Local Arquivo</b></td> --}}
            {{-- <th scope="col"><b>Estante</b></td> --}}
            <th scope="col"><b>Caixa</b></td>
            <th scope="col"><b>Maço</b></td>
            <th scope="col"><b>Mês Referência</b></td>
            <th scope="col"><b>Desfaz</b></td>                
            <th scope="col"><b>Valor</b></td>


        </tr>
    </thead>



        

    <tbody>
        @foreach($cadastros as $dashboard)

        {{-- //{{dd($dashboard)}} --}}
        
            <tr>
                <td scope="row">{{$dashboard->id_codigo}}</td>
                <td>{{date('d/m/Y', strtotime($dashboard->data))}}</td>
                <td>{{$dashboard->Emp_Emit}}</td>
                <td>{{$dashboard->Emp_Dest}}</td>
                <td>{{$dashboard->Dep}}</td>    
                <td>{{$dashboard->tp_documento}}</td>
                <td>{{$dashboard->Nome_Doc}}</td>
                <td>{{$dashboard->Palavra_Chave}}</td>
                <td>{{$dashboard->Tp_Projeto}}</td>
                {{-- <td>{{$dashboard->Assunto}}</td> --}}
                <td>{{$dashboard->nome_job}}</td>
                {{-- <td>{{$dashboard->Loc_Arquivo}}</td> --}}
                {{-- <td>{{$dashboard->Loc_Est}}</td> --}}
                <td>{{$dashboard->Loc_Box_Eti}}</td>
                <td>{{$dashboard->Loc_Maco}}</td>
                <td>{{$dashboard->Dt_Ref}}</td>
                <td>{{$dashboard->Desfaz}}</td>  
                <td id="valor">R${{$dashboard->Valor_Doc}}</td>

            </tr>
        @endforeach

        

    </tbody>
</table>
<br>
{{-- <table border="2" id="total">
    
    <th scope="col"> TOTAL </td>
    <td style="color: red">R$ {{$soma}}</td>

</table> --}}
<footer>
    <b>©Controle de Arquivo Fabrika</b> Versão 1.0
    <br>
    Desenvolvido por <b>Ulisses Mesquita</b> 
    <br>
    Autorizado para Fabrika Filmes
</footer>


</div>



</div>


</body>
</html>


