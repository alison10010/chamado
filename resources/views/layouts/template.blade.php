<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('title')</title>

    {{-- ICONS --}}
    <script src="https://kit.fontawesome.com/4ed72f0505.js" crossorigin="anonymous"></script>
    
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    {{-- Custom styles for this template --}}
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/estiloManual.css" rel="stylesheet">

</head>

<body id="page-top">

    {{-- Page Wrapper --}}
    <div id="wrapper">

        {{-- Menu da Page --}}
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            {{-- Sidebar - Brand --}}
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon">
                    {{-- <i class="fas fa-phone"></i> --}}
                    <img src="/img/phone-icon.svg" />
                </div>
                <div class="sidebar-brand-text mx-3">Chamado<sup></sup></div>
            </a>

            {{-- Divider --}}
            <hr class="sidebar-divider my-0">

            {{-- Nav Item - Dashboard --}}
            <li class="nav-item active">
                <a class="nav-link" href="{{route('dashboard.home')}}">
                    <img src="/img/dashboard-icon.svg" />
                    <span>Dashboard</span></a>
            </li>

            {{-- Divider --}}
            <hr class="sidebar-divider">

            {{-- Heading --}}
            <div class="sidebar-heading">
                Serviços
            </div>

            {{-- Nav Item - Pages Perfil --}}
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{route('register')}}">                   
                    <img src="/img/user.svg" />
                    <span>Perfil</span>
                </a> 
            </li> --}}

            {{-- Nav Item - Resumo --}}
            <li class="nav-item" style="margin-top: 15px">
                <a class="nav-link" href="{{route('dashboard.resumo')}}">                     
                    <img src="/img/resume-icon.svg" />
                    <span>Resumo</span>
                </a>
            </li>

            <br /><br />
            {{-- Sidebar Toggler (Sidebar) --}}
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle" onclick="menu()"></button>
            </div>

        </ul>
        {{-- Fim do Menu da Page --}}

        {{-- Content Wrapper --}}
        <div id="content-wrapper" class="d-flex flex-column">

            {{-- Main Content --}}
            <div id="content">

                {{-- TOP DA PAGE --}}
                <nav class="navbar navbar-expand topbar mb-4 static-top shadow">

                    {{-- Sidebar Toggle (Topbar) --}}
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3" onclick="menu()">
                        <img src="/img/bar-menu.svg" alt="bar-menu" />
                    </button>

                    {{-- Topbar Navbar --}} 
                    <ul class="navbar-nav ml-auto">                        

                        {{-- Nav Item - User Information --}}
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle">
                                <span class="mr-2 d-lg-inline text-gray-600 small">
                                    SEASDHM
                                </span>                                
                            </a> 
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        {{-- Nav Item - Sair --}}
                        <li class="nav-item">
                            
                            <form action="{{route('logout')}}" method="POST">
                                @csrf
                                <a href="/logout" class="nav-link" onclick="event.preventDefault(); 
                                this.closest('form').submit();">Sair</a>
                            </form>
                        </li>

                    </ul>

                </nav>
                {{-- FIM DO TOP DA PAGE --}}

                {{-- Inicio do conteudo da page --}}
                <main>                    
                    <div class="container-fluid">      
                        @if(session('msg'))  {{-- VERIFICA SE EXISTE MSG NA SESSÃO --}}
                            <div class="alert alert-success" id="alert" role="alert">
                                <button type="button" class="close" data-dismiss="alert" onclick="fechaModal()">x</button>
                                {{ session('msg') }}
                            </div>
                        @endif                    
                        <div class="row">
                            @yield('content') {{-- CONTEUDO DAS PAGINAS --}}
                        </div>
                    </div>
                </main>
                
                {{-- Fim do conteudo da page --}}

            </div>
            {{-- End of Main Content --}}

            {{-- Footer --}}
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright © 2022 - SEASDHM.</span>
                    </div>
                </div>
            </footer>
            {{-- End of Footer --}}

        </div>
        {{-- End of Content Wrapper --}}

    </div>
    {{-- Fim Page Wrapper --}}

    {{-- Scroll to Top Button--}}
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

</body>

<script src="/js/scriptManual.js"></script>

</html>