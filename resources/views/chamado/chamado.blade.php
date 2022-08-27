<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/telaChamado.css">
    <link rel="stylesheet" href="/css/bootstrap.css">

    <script src="/js/scriptManual.js"></script>

    <title>Chamado</title>
</head>
<body>
    <header class="cabecario">
        {{-- <img src="/img/brasao_acre.svg" class="logo" id="logo"/> --}}
        <label class="text-header">SEASDHM</label>
        <a href="{{route('login')}}" class="login">Login</a>
    </header>

    <main>
        <p class="titulo">HELP DESK</p>
        
        <div class="constainer-card">

            @include('include/msgError')  {{-- MGS DE ERROR NOS FORMULARIOS DE VALIDACAO --}}

            @if(session('msg'))  {{-- VERIFICA SE EXISTE MSG NA SESSÃO --}}
                <div class="alert alert-success" id="alert" role="alert">
                    <button type="button" class="close" data-dismiss="alert" onclick="fechaModal()">x</button>
                    {{ session('msg') }}
                </div>
            @endif  

            <div class="card-body">
                <form action="{{route('chamado.store')}}" method="POST" autocomplete="off">
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
                        <label for="descricao">Breve descrição:</label>
                        <textarea name="descricao" id="descricao" class="form-control" placeholder="(Internet, Impressora, Monitor, Pasta Compartilhada, etc.)"></textarea>
                    </div>
                    <br />

                    <center><button type="submit" class="btn btn-primary">Solicitar</button></center>
                </form>
            </div>                    
        </div>       
        <br />
        <center><a href="{{route('chamado.papel')}}" class="login" style="color: #071d41; font-weight: bold">Solicitar papel A4 </a></center>

        <img  src="/img/help.svg" class="direito-inferior" />

    </main>    

</body>
</html>