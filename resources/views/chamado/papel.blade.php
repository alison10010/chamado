<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/telaChamado.css">
    <link rel="stylesheet" href="/css/bootstrap.css">

    <script src="/js/scriptManual.js"></script>

    <title>Solicitação de Papel</title>
</head>
<body>
    <header class="cabecario">
        {{-- <img src="/img/brasao_acre.svg" class="logo" id="logo"/> --}}
        <label class="text-header">SEASDHM</label>
        <a href="{{route('login')}}" class="login">Login</a>
    </header>

    <main>
        <p class="titulo">Solicitação de papel</p>
        
        <div class="constainer-card">

            @include('include/msgError')  {{-- MGS DE ERROR NOS FORMULARIOS DE VALIDACAO --}}

            @if(session('msg'))  {{-- VERIFICA SE EXISTE MSG NA SESSÃO --}}
                <div class="alert alert-success" id="alert" role="alert">
                    <button type="button" class="close" data-dismiss="alert" onclick="fechaModal()">x</button>
                    {{ session('msg') }}
                </div>
            @endif  

            <div class="card-body">
                <form action="{{route('resma.store')}}" method="POST" autocomplete="off">
                    @csrf {{-- NECESSARIO PARA REALIZAR O SALVAMENTO DO FORM NO BD --}}
                    <div class="form-group">
                        <label for="Nome">Nome</label>
                        <input type="text" name="nome" class="form-control" id="Nome" placeholder="Digite seu nome" required value="{{ old('Nome') }}">
                    </div>

                    <div class="form-group">
                        <label for="Setor">Setor</label>
                        <input type="text" name="setor" class="form-control" id="Setor" placeholder="Digite seu Setor" required value="{{ old('Setor') }}">
                    </div>

                    <div class="form-group">
                        <label for="quant_papel">Quantidade de papel</label>
                        <select name="quant_papel" class="form-control" required>
                            <option value="">Selecione...</option>
                            <option value="1 resma">1 resma</option>
                            <option value="2 resma">2 resma</option>
                            <option value="3 resma">3 resma</option>
                            <option value="4 resma">4 resma</option> 
                            <option value="5 resma ( 1 caixa P)">5 resma ( 1 caixa P)</option>          
                            <option value="10 resma ( 1 caixa G)">10 resma ( 1 caixa G)</option>          
                        </select>                         
                    </div>
                    <br />

                    <center><button type="submit" class="btn btn-primary">Solicitar</button></center>
                </form>
            </div>                    
        </div>       
        <br />
        <center><a href="{{route('welcome')}}" class="login" style="color: #071d41; font-weight: bold;">Chamado</a>

        <table class="table table-bordered" id="dataTable" style="max-width: 70%; margin-top: 2rem" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col" style="width: 30%">Nome</th>
                    <th scope="col" >Setor</th>
                    <th scope="col">Quant. Resma</th>
                    <th scope="col"><center>Solicitação</th>
                    <th scope="col"><center>Status</th>
                </tr>
            </thead>

            <tbody>  
                 
                @foreach ($yesterDayToday as $chamado)
                    <tr>                        
                        <td>{{ $chamado->nome }}</td>
                        <td>{{ $chamado->setor }}</td>
                        <td>{{ $chamado->quant_papel }} de papel</td>
                        
                        <td><center>{{ date('d-m-y H:i', strtotime($chamado->date_solicitacao_aberto)) }}</center></td>  

                        <td style="color: {{ $chamado->date_solicitacao_fechado ? 'green' : 'red' }}"><center>{{ $chamado->date_solicitacao_fechado ?  'Liberado' : 'Pendente' }}</center></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if(count($yesterDayToday) == 0)
            <p>Sem solicitações ontem e hoje.</p>
        @endif

    </center>
        <img  src="/img/help.svg" class="direito-inferior" />

    </main>    

    <script src="{{asset('js/app.js')}}"></script> 

    <script>
    
         Echo.channel('channel-publico')  // USANDO A VERSÃO 7.3 DO PHP
            .listen('aprovaResmaPapel', (e) => {
                document.location.reload(true);                
        });   
        
    </script>

</body>
</html>