<!doctype html>
<html lang="pt-br">
    <head>
         <meta charset="UTF-8">
        <!-- Custom fonts for this template-->
        <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="/css/general.css">
        <link type="text/css" rel="stylesheet" href="{{ mix('css/style.css') }}">

        <title>Fanart online</title>
    </head>
    <body id="page-top">
        <div class="container">
            <header class="header">
                <div class="nav-dig-img">
                    <h2 class="logop1">Fanart<h2 class="logop2">Online</h2></h2>
                </div>
                <nav class="navbar">
                    <a href="{{url('public/index')}}" id="home">Home</a>
                    <a href="{{url('public/about')}}" id="sobre">Sobre</a>
                    @if(!Auth::check())
                    <a href="{{url('login')}}" id="login">Login</a>
                    <a href="{{url('public/new')}}" class="buttoncadastrar">Cadastrar-se</a>
                    @else
                        @php $users = Auth::user(); @endphp

                        @if($users->type == 'admin')
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle no-arrow" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Menu</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item text-black" href="{{url('/evaluation/evaluations')}}">Avaliações</a>
                                    <a class="dropdown-item text-black" href="{{url('/fanart/fanarts')}}">FanArt</a>
                                    <a class="dropdown-item text-black" href="{{url('/loginrecord/loginrecords')}}">Registro de Logins</a>
                                    <a class="dropdown-item text-black" href="{{url('/user/users')}}">Usuários</a>
                                    <a class="dropdown-item text-black" href="#" data-toggle="modal" data-target="#logoutModal">Sair</a>
                                </div>
                            </li>
                        @else
                            <li class="text-white">{{$users->name}}</li>

                            <li class="nav-item dropdown " >
                                <a class="text-black dropdown-toggle no-arrow" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    @if ($users->photo)
                                        <img class="rounded-circle" src="{{ asset('storage/'.$users->photo )}}" style="height: 50px; width: 50px;">
                                    @else
                                      <span>Menu</span>
                                    @endif

                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item text-black"  href="{{url('/evaluation/evaluations')}}">Suas Avaliações</a>
                                    <a class="dropdown-item text-black" href="{{url('/fanart/fanarts')}}">Suas Fanart's</a>
                                    <a class="dropdown-item text-black" href="/user/{{$users->id}}/show">Perfil</a>
                                    <a class="dropdown-item text-black" href="#" data-toggle="modal" data-target="#logoutModal">Sair</a>
                                </div>
                            </li>

                        @endif
                    @endif
                </nav>
            </header>


            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="title-with-button text-center">
                    @if (isset($pageTitle))
                        <h1 class="d-inline-block h3 mb-4 text-white"><strong>{{ $pageTitle }}</strong></h1>
                    @endif
                    @if(isset($titleButton) && isset($route))
                        <a href="{{ $route }}" class="d-inline-block btn btn-primary btn-sm float-right" role="button">{{ $titleButton }}</a>
                    @endif
                </div>
                @yield('content')
            </div>

            <!-- Footer -->
            <footer class="footer mt-4">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span class="mr-2">Copyright Equipe FanartOnline 2022 - Mais informações </span>
                        <div class="pull-right mr-4">
                            <a  href="#"><i class="fab fa-instagram fa-2x"></i></a>
                            <a href="#"><i class="fab fa-facebook-square fa-2x"></i></a>
                            <a  href="#"><i class="fab fa-youtube fa-2x"></i></a>
                        </div>
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
