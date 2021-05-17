<!doctype html>
<html lang="pt-br">
    <head>
         <meta charset="UTF-8">
        <!-- Custom fonts for this template-->
        <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="/css/general.css">
        <link type="text/css" rel="stylesheet" href="{{ mix('css/style.css') }}">

        <title>Fanart online</title>
    </head>
    <body id="page-top">
        <div class="container">
            <header class="card-header mb-4">
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link " href="{{url('public/index')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('public/about')}}">Sobre</a>
                    </li>
                    @if(!Auth::check())
                        <li class="nav-item">
                            <a class="nav-link" href=" {{url('public/new')}} ">Cadastre-se</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="{{url('login')}}">Login</a>
                        </li>
                    @else
                        @php $users = Auth::user(); @endphp

                        @if($users->type == 'admin')
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Menu</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{url('/evaluation/evaluations')}}">Avaliações</a>
                                    <a class="dropdown-item" href="{{url('/fanart/fanarts')}}">FanArt</a>
                                    <a class="dropdown-item" href="{{url('/loginrecord/loginrecords')}}">Registro de Logins</a>
                                    <a class="dropdown-item" href="{{url('/user/users')}}">Usuários</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"">Sair</a>
                                </div>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Menu</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item"  href="{{url('/evaluation/evaluations')}}">Suas Avaliações</a>
                                    <a class="dropdown-item" href="{{url('/fanart/fanarts')}}">Suas Fanart's</a>
                                    <a class="dropdown-item" href="/user/{{$users->id}}/show">Perfil</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Sair</a>
                                </div>
                            </li>
                        @endif
{{--                        <li>{{$users->name}}</li>--}}
                    @endif
                </ul>
                <!-- Topbar -->
            </header>
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="title-with-button text-center">
                    @if (isset($pageTitle))
                        <h1 class="d-inline-block h3 mb-4 text-gray-800"><strong>{{ $pageTitle }}</strong></h1>
                    @endif
                    @if(isset($titleButton) && isset($route))
                        <a href="{{ $route }}" class="d-inline-block btn btn-primary btn-sm float-right" role="button">{{ $titleButton }}</a>
                    @endif
                </div>
                @yield('content')
            </div>

            <!-- Footer -->
            <footer class="card-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy;  Renato Nunes 2021 - Mais informações <a href="https://www.facebook.com/renato.nunes.376/" target="_blank">Encontre-me</a></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->



            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Encerrar a Sessão</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Deseja realmente encerrar a sessão?</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                            <a class="btn btn-primary" href="{{route('logout')}}">Sair</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <!-- Bootstrap core JavaScript-->
        <script src="/vendor/jquery/jquery.min.js"></script>
        <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Scripts -->
        <script src="{{ asset('jquery/jquery.js') }}"></script>
        <script src="{{ asset('js/bootstrap.js') }}"></script>
        <script src="/js/scripts.js"></script>
    </body>
</html>
