@extends('layouts.template')  {{-- USA O LAYOUT PADRÃO --}}
@section('title', 'Resumo') {{-- TITULO DA PAGE --}}

@section('content') {{-- CONTEUDO DA PAGE - INICIO --}}

<div class="container-fluid">

    {{--  DESCRICAO DA PAGE --}}

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Resumo das atividades</h1>
    </div>
    
    {{-- Content Row --}}
    <div class="row">
        {{-- CARD 1 NO PAINEL --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <center>Chamados de hoje</center>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><center>{{ $lista['today'] }}</center></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CARD 2 NO PAINEL --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                <center>Chamados até hoje</center>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <center>{{ $lista['all'] }}</center>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CARD 3 NO PAINEL --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                <center>Chamados de ontem</center>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <center>{{ $lista['yesterday'] }}</center>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-phone-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="h3 mb-0 text-gray-800">Relatório</h3>
    </div>

    {{-- solicitacao Papel --}}
    
    <form  id="signup-form">
        <div>
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input" id="chamados" value="chamados" name="chamados" checked onclick="checkboxChamado()">
                <label class="custom-control-label" for="chamados">Chamados</label>
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input" id="solicitacaoPapel" name="solicitacaoPapel" value="solicitacaoPapel" checked onclick="checkboxSolicPapel()">
                <label class="custom-control-label" for="solicitacaoPapel">Solicitação de Papel</label>
            </div>
        </div>
        <br />
        <div class="form-inline">
            <label for="email">Informe o período para gerar o relatório:</label>
            <input type="date" class="form-control" style="margin-left: 10px" name="dataOne" /> 
            <label for="email" style="padding: 0px 12px 0px 12px;"> até </label>
            <input type="date" class="form-control" name="dataTwo" /> 
            <button type="button" class="btn btn-primary" style="margin-left: 10px" onclick="frame()">Gerar</button>
        </div>
    </form>

    <hr class="sidebar-divider"> 

    <iframe src="" style="width: 100%; min-height: 100vh;" id="frame" class="frame">Your browser isn't compatible</iframe>
    

</div>



@endsection  {{-- CONTEUDO DA PAGE - FIM --}}