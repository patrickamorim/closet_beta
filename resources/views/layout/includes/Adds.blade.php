

@section('Login')  
<form action="{{route('site.login.entrar')}}" class="ml-2 mr-2" method="post">
  {{csrf_field()}}
  <div class="form-group " >
    <small id="emailHelp" class="form-text ">Usuário.</small>
    <input type="email" class="form-control " name="email" aria-describedby="emailHelp" title="Digite seu Login">
  </div>
  <div class="form-group">
    <small id="emailHelp" class="form-text ">Senha.</small>
    <input type="password" class="form-control" name="senha" title="Digite sua senha" >
  </div>
  @if(Auth::guest())
  <button type="submit" class="btn btn-primary">Logar</button>
  @else
  <a href="{{route('site.login.sair')}}" class="btn btn-primary">Sair</a>
  @endif
</form>
@endsection



@section('slide')



<div id="carouselExampleSlidesOnly" class="carousel slide container pt-10 " data-ride="carousel">
  <ol class="carousel-indicators">
   <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
   <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
   <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
 </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100 mt-50" src=  {{ URL::asset( "/imagens/img1.jpg")}} alt="">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src=  {{ URL::asset( "/imagens/img2.jpg")}} alt="">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src=  {{ URL::asset( "/imagens/img3.jpg")}} alt="">
    </div>
  </div>
</div>
@endsection



@section('compraM')
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

@endsection