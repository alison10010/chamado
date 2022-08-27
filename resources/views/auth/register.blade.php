@extends('layouts.template')  {{-- USA O LAYOUT PADRÃO --}}
@section('title', 'Registro') {{-- TITULO DA PAGE --}}

@section('content') {{-- CONTEUDO DA PAGE - INICIO --}}

<div style="min-width: 400px">
    {{-- CADASTRO DE CARGO--}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4" style="margin-left: 1rem">
        <h3 class="h3 mb-0 text-gray-800">Novo usuário</h3>
    </div>

        <form action="{{route('register')}}" method="POST" autocomplete="off" style="width: 100%;margin-top:-17px">
            @csrf {{-- NECESSARIO PARA REALIZAR O SALVAMENTO DO FORM NO BD --}}
            <div class="card-body">
            <div class="form-group"> 
                <label for="Nome">Nome</label>
                <input type="txt" name="name" class="form-control" id="Nome" minlength="3" placeholder="Digite o nome completo" required value="{{ old('name') }}"> {{-- VALUE 'OLD' MANTEM O VALOR DIGITADO CASO OCORRA UM ERRO --}}
            </div>
            <div class="form-group">
                <label for="Email">Email</label>
                <input type="email" name="email" class="form-control" id="Email" placeholder="Digite o email de acesso" required value="{{ old('Email') }}">
            </div>
    
            <!-- Password -->
            <div class="form-group">
                <label for="Senha">Senha</label>
                <input type="password" name="password" class="form-control" id="Senha" placeholder="Digite senha de acesso" required>
            </div>
    
            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation">Confirme a senha</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirme a senha" required>
            </div>

                <button type="submit" class="btn btn-success">Registrar</button>
        </form>

</div>

@endsection  {{-- CONTEUDO DA PAGE - FIM --}}