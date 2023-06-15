<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element text-center">
                    <span class="block m-t-xs font-bold text-white" style="font-size: 20px;">SICC</span>       
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">{{auth()->user()->EmpresaID->nome}}</span>
                        <span class="block mb-3">{{auth()->user()->Nome}}</span>
                        <span class="text-muted text-xs block">Configurações <b class="caret"></b></span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="dropdown-item" href="{{ route('perfil') }}">Perfil</a></li>
                        <li><a class="dropdown-item" href="{{ route('funcionarios') }}">Funcionários</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    SICC
                </div>
            </li>
            <li id="relatorios_menu">
                <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Relatórios</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ route('relatorio_objeto') }}">Relatório de Objeto</a></li>
                    <li><a href="{{ route('relatorio_setor') }}">Relatório de Setor</a></li>
                    <li><a href="{{ route('relatorio_mensal') }}">Relatório Mensal</a></li>
                    <li><a href="{{ route('relatorio_anual') }}">Relatório Anual</a></li>
                </ul>
            </li>
            @if(Auth::user()->acesso == "Compras")
            <li>
                <a href="#"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Compras</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ route('cadastro_fornecedor') }}">Cadastro de Fornecedor</a></li>
                    <li><a href="{{route('fornecedores')}}">Fornecedores</a></li>
                    
                </ul>
            </li>
            @endif
            @if(Auth::user()->acesso != "Geral")
            <li>
                <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Cadastro </span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse"> 
                    <li><a href="{{route('cadastro_item')}}">Cadastro Item</a></li>
                    <li><a href="{{route('cadastro_objeto') }}">Cadastro Objeto</a></li>
                    <li><a href="{{route('cadastro_setor')}}">Cadastro de Setor</a></li>
                    @if(Auth::user()->acesso == "admin")
                    <li><a href="{{route('cadastro_login')}}">Cadastro de Usuários</a></li>
                    @endif
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-search"></i><span class="nav-label">Visualização</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    @if(Auth::user()->acesso == "admin")
                    <li><a href="{{route('usuarios')}}">Usuários</a></li>
                    @endif
                    <li><a href="{{route('setores')}}">Setores</a></li>
                    <li><a href="{{route('itens')}}">Itens</a></li>
                    <li><a href="{{route('objetos')}}">Objetos</a></li>
                </ul>
            </li>
            @endif
            <li>
                <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">Chamado</span><!-- <span class="float-right label label-primary">SISTEMA</span> --><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ route('abertura') }}">Abertura</a></li>
                    <li><a href="{{ route('historico') }}">Chamados</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-qrcode"></i> <span class="nav-label">QR Code</span><!-- <span class="float-right label label-primary">SISTEMA</span> --><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ route('qrcode_objeto') }}">Objetos</a></li>
                    <li><a href="{{ route('qrcode_setor') }}">Setores</a></li>
                    <li><a href="{{ route('qrcode_camera') }}">Câmera</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
