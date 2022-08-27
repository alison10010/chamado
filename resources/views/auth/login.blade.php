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
    </header>
    <br />
    
    <center><img src="img/brasao_acre.svg" style="max-width: 10%;margin-top: 2rem"></center>

    <main>        

        <div class="constainer-card" style="margin-top: 2rem">

            @include('include/msgError')  {{-- MGS DE ERROR NOS FORMULARIOS DE VALIDACAO --}}

            @if(session('msg'))  {{-- VERIFICA SE EXISTE MSG NA SESSÃO --}}
                <div class="alert alert-success" id="alert" role="alert">
                    <button type="button" class="close" data-dismiss="alert" onclick="fechaModal()">x</button>
                    {{ session('msg') }}
                </div>
            @endif  

            <div class="card-body">
                <form action="{{ route('login') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Digite seu email" required value="{{ old('email') }}" autofocus />
                    </div>

                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input name="password" type="password" id="password" class="form-control" placeholder="Senha"></input>
                    </div>
                    <br />

                    <center><button type="submit" class="btn btn-primary">Acessar</button></center>
                </form>
            </div>
        </div>
        <br />
        <center><a href="{{ route('welcome') }}" style="text-decoration: none">Voltar</button></a> </center>

    </main>

</body>
</html>
