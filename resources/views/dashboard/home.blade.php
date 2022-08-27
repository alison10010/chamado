@extends('layouts.template')  {{-- USA O LAYOUT PADRÃO --}}
@section('title', 'Painel') {{-- TITULO DA PAGE --}}

@section('content') {{-- CONTEUDO DA PAGE - INICIO --}}

    <table class="table">
        <thead class="thead-light">
          <tr>
            <th scope="col">Nome</th>
            <th scope="col">Setor</th>
            <th scope="col">Descrição</th>
            <th scope="col">Horário</th>
            <th scope="col">Status</th>
            <th scope="col" style="width: 8%"></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($chamadosDay['listChamado'] as $chamado)
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
                <td>  

                @if (!$chamado->date_chamado_fechado)
                    <form action={{route('chamado.finalizarChamado', $chamado->id)}} method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-primary">
                            Finalizar
                        </button>
                    </form>
                @else
                    Finalizado                            
                @endif

                </td>
            </tr>
            @endforeach

            {{-- TABELA DE PEDIDOS DE PAPEL --}}
            @foreach ($chamadosDay['resmaPapel'] as $chamado)
                <tr>                        
                    <td>{{ $chamado->nome }}</td>
                    <td>{{ $chamado->setor }}</td>
                    <td>{{ $chamado->quant_papel }} de papel</td>
                    
                    <td>{{ date('d-m-y H:i', strtotime($chamado->date_solicitacao_aberto)) }}</td>  

                    <td style="color: {{ $chamado->date_solicitacao_fechado ? 'green' : 'red' }}">{{ $chamado->date_solicitacao_fechado ?  'Liberado' : 'Pendente' }}</td>

                    <td>  
                    @if (!$chamado->date_solicitacao_fechado)
                    <form action={{route('resma.liberar', $chamado->id)}} method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-primary">
                            Aprovar
                        </button>
                    </form>
                    @else
                        Liberado                            
                    @endif
                </td>  
                    
                </tr>
        @endforeach
        </tbody>
    </table>
    @if(count($chamadosDay) == 0)
        <p>Sem chamados no momento.</p>
    @endif


    <audio id="myAudio">
        <source src="/songs/notificacao.mp3" type="audio/mpeg">            
    </audio>

@endsection  {{-- CONTEUDO DA PAGE - FIM --}}

<script src="{{asset('js/app.js')}}"></script> 

<script>

    var publico =  document.getElementById("publico");  

     Echo.channel('channel-publico')  //USANDO A VERSÃO 7.3 DO PHP
        .listen('channelPublico', (e) => {
            // SON DE NOTIFICACAO
            var x = document.getElementById("myAudio"); 

            x.play();     
            
            // ENVIA MSG TELEGRAM
            var nome = e.mensagem.original.nome;
            var setor = e.mensagem.original.setor;
            var descricao = e.mensagem.original.descricao;
            
            //telegramSend(nome, setor, descricao);

            setTimeout(reloadPage, 2500); 
            
    });   

    // RELOAD PAGE
    function reloadPage(){ 
        document.location.reload(true);
    }
    // ENVIA NOTIFICACAO VIA TELEGRAM
    function telegramSend(nome, setor, descricao){
        fetch('http://10.19.9.239:8000/notificacao/'+nome+"&"+setor+"&"+descricao)
    }
    
</script>

