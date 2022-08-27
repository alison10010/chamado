<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
p,tr,h2,h3{
    font-family: sans-serif;
}
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
</style>
</head>
<body>


<div style="overflow-x:auto;">

@if($chamados['listChamado'])
  <h3>Relatório de chamado - SEASDHM</h3>

    <table>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Setor</th>
            <th scope="col">Descrição</th>
            <th scope="col">Horário</th>
            <th scope="col">Status</th>
        </tr>
    
        @foreach ($chamados['listChamado'] as $chamado)
            <tr>                        
            <td>{{ $chamado->nome }}</td>
            <td>{{ $chamado->setor }}</td>

                @if($chamado->descricao)
                    <td>{{ $chamado->descricao }}</td>   
                @else
                    <td>sem descrição.</td>  
                @endif 

            <td>{{ date('d-m-y H:i', strtotime($chamado->date_chamado_aberto)) }}</td>  
            <td style="color: {{ $chamado->date_chamado_fechado ? 'green' : 'red' }}">{{ $chamado->date_chamado_fechado ?  'Fechado' : 'Aberto' }}</td>

            </tr>
        @endforeach
    </table>
    @if(count($chamados['listChamado']) < 1)
        <p>Sem chamados.</p>
    @endif

@endif

<br /><br />
  
@if ($chamados['resmaPapel'])

  <h3>Solicitações de papeis - SEASDHM</h3>

  <table>
    <tr>
        <th scope="col">Nome</th>
        <th scope="col">Setor</th>
        <th scope="col">Descrição</th>
        <th scope="col">Horário</th>
        <th scope="col">Status</th>
    </tr>
    {{-- TABELA DE PEDIDOS DE PAPEL --}}

    
        @foreach ($chamados['resmaPapel'] as $chamado)
            <tr>                        
                <td>{{ $chamado->nome }}</td>
                <td>{{ $chamado->setor }}</td>
                <td>{{ $chamado->quant_papel }} de papel</td>
                
                <td>{{ date('d-m-y H:i', strtotime($chamado->date_solicitacao_aberto)) }}</td>  

                <td style="color: {{ $chamado->date_solicitacao_fechado ? 'green' : 'red' }}">{{ $chamado->date_solicitacao_fechado ?  'Liberado' : 'Pendente' }}</td>                    
            </tr>
        @endforeach

  </table>
    @if(count($chamados['resmaPapel']) < 1)
        <p>Sem solicitações de papel.</p>
    @endif

@endif


</div>

</body>
</html>
