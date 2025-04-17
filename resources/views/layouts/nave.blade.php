
<div id="wrapper">

    <nav class="navbar navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-btn">
                <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
            </div>

            <div class="navbar-brand">
                Gerenciador de Tarefas
            </div>

            <div class="navbar-right">
                <form id="navbar-search" class="navbar-form search-form">
                    <input value="" class="form-control" placeholder="Search here..." type="text">
                    <button type="button" class="btn btn-default"><i class="icon-magnifier"></i></button>
                </form>

                <div id="navbar-menu">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="login.html" class="icon-menu"><i class="icon-login"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div id="left-sidebar" class="sidebar">
        <div class="">
            <div class="user-account">
                <img src="9187604.png" class="rounded-circle user-photo" alt="User Profile Picture">
                <div class="dropdown">
                    <span>Bem-vindo,</span>
                    <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong>Vicente Eduardo</strong></a>
                    <ul class="dropdown-menu dropdown-menu-right account">
                        <li><a href="page-profile2.html"><i class="icon-user"></i>Meu Perfil</a></li>
                        <li><a href="app-inbox.html"><i class="icon-envelope-open"></i>Mensagens</a></li>
                        <li><a href="javascript:void(0);"><i class="icon-settings"></i>Configurações</a></li>
                        <li class="divider"></li>
                        <li><a href="login"><i class="icon-power"></i>Sair</a></li>
                    </ul>
                </div>
                <hr>

            </div>


            <!-- Tab panes -->
            <div class="tab-content p-l-0 p-r-0">
                <div class="tab-pane active" id="menu">
                    <nav id="left-sidebar-nav" class="sidebar-nav">
                        <ul id="main-menu" class="metismenu">
                            <li class="active">
                                <a href="index.html" ><i class="icon-home"></i> <span>Dashboard</span></a>

                            </li>
                            <li>
                                <a href="#App" class="has-arrow"><i class="icon-grid"></i> <span>Categorias</span></a>
                                <ul>
                                    <li><a href="cadastar_categorias.html">Cadastrar Categorias</a></li>
                                    <li><a href="categorias.html">Listar Categorias</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#FileManager" class="has-arrow"><i class="icon-folder"></i> <span>Tarefas</span></a>
                                <ul>
                                    <li><a href="cadastrar_tarefas.html">Cadastrar Tarefas</a></li>
                                    <li><a href="tarefas.html">Listar Tarefas</a></li>

                                </ul>
                            </li>


                            <li>
                                <a href="#charts" class="has-arrow"><i class="icon-bar-chart"></i> <span>Estatistica</span></a>
                                <ul>
                                    <li><a href="chart-chartjs.html">ChartJS</a> </li>
                                    <li><a href="chart-c3.html">C3 Charts</a></li>

                                </ul>
                            </li>


                        </ul>
                    </nav>
                </div>


            </div>
        </div>
    </div>