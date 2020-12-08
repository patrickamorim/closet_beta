

<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href={{ URL::asset("/assets/bootstrap/dist/css/bootstrap.min.css") }}>
    <link rel="stylesheet" href={{ URL::asset("/assets/font-awesome-4.7.0/css/font-awesome.min.css") }}>
   
    <title>@yield('titulo')</title>

   
    <script src={{ URL::asset("/assets/jquery/dist/jquery.min.js") }}></script>
    <script  src={{ URL::asset("/assets/jQuery-Mask-Plugin-master/dist/jquery.mask.min.js")}}></script>      
   
       
 
  


      <!--<script type="text/javascript">


$(window).on('load', function (){

  //compras
$('.corpo-tabela').fadeOut(1000);
$('.thead-dark').click(function(){
  $(this).next().toggle(500);
});




});


</script>-->
     

     


  </head>
  <body style="background: url({{asset('/assets/img4.jpg')}}) center center no-repeat fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  ">
   

      <nav class="navbar navbar-expand-lg navbar-dark bg-dark {{isset($pesquisa) ? '' : 'mb-5' }} " >




        <div class="container">

            <a class="navbar-brand h1 mb-0 " href="{{route('site.home')}}">Closet</a>

              <button  class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite">
                <span class="navbar-toggler-icon"></span>
              </button>


              <div class="collapse navbar-collapse" id="navbarSite">

                  <ul class="navbar-nav mr-auto">
                    @if(!Auth::guest())
                      <li class="nav-item ">
                      <a class="nav-link" href="{{route('site.caixa.listar')}}">Caixa</a>
                      </li>

                      <li class="nav-item ">
                      <a class="nav-link" href="{{route('site.clientes.listar')}}">Clientes</a>
                      </li>

                      @if(Auth::user()->funcao == "administrador")

                      <li class="nav-item ">
                      <a class="nav-link" href="{{route('site.compras.listar')}}">Compras</a>
                      </li>
                   
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Relatórios
                        </a>
                        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink">
                          <a class="dropdown-item text-light" href="#">Caixas</a>
                          <a class="dropdown-item text-light" href="{{route('site.relatorios.relatorioContabil')}}">Contábil</a>
                          <a class="dropdown-item text-light" href="{{route('site.relatorios.relatorioPromissorias')}}">Promissórias</a>
                          <a class="dropdown-item text-light" href="{{route('site.relatorios.relatorioVendedores')}}">Vendedores</a>
                        </div>
                      </li>

                      <li class="nav-item" title="Configurações" >
                      <a href="{{route('site.configuracao')}}" class=" nav-link"><i class="fa fa-cog fa-spin"></i> </a> 
                      </li>
                      @endif

                      @endif  
                  </ul>

                  <ul class="navbar-nav ml-auto">

                    @if(!Auth::guest())
                   <li class="nav-item ">
                   <a class="nav-link" >Olá {{Auth::user()->name}}</a>
                   </li>
                    @endif
                      <li class="nav-item dropdown">
                        @if(Auth::guest())
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="navdrop">Logar</a>
                        @else
                        <a class="nav-link text-white dropdown-toggle " href="{{route('site.login.sair')}}"  id="navdrop">Sair</a>
                        @endif
                    

                      <div class="dropdown-menu ">
                          @yield('Login')
                      </div>

                      </li>

                  </ul>


              </div>
            </div>

      </nav>
      @if(isset($pesquisa))<nav class="navbar navbar-expand-lg navbar-dark bg-secondary  mb-5 " >
      <div class="container">

      <ul class="navbar-nav ml-auto">

         

          <form class="form-inline float-right " action="{{route('site.clientes.buscar')}}" method="get"  >
      {{csrf_field()}}
      <input class="form-control mr-sm-2 " name="nome" type="search" placeholder="Buscar" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
    </form>

        

      </ul>
      </div>
      
      </nav>@endif


