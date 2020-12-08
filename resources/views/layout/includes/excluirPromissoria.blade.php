<div class="btn-group dropup ">
  <button type="button" class="btn btn-dark dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    
  </button>
  <div class="dropdown-menu bg-dark text-center" title="Exlusão  possível apenas se não ouver havers na promissória">
  <a class="text-light  btn btn-sm" data-toggle="modal" data-target="#{{$promissoria->id}}exluir">Exluir Promissória</a>
  </div>
</div>




<!-- Modal -->
<div class="modal fade" id="{{$promissoria->id}}exluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-danger" id="exampleModalLabel">Excluir Promissória ?!?</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-dark h5">
        Deseja Excluir permanentemente a promissória no valor de R$ {{$promissoria->valor}} do dia '{{date( 'd/m/Y' , strtotime($promissoria->data))}}' ???
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        @if(Auth::user()->funcao == "administrador")
        <a href="{{route('site.compras.excluir',[$promissoria->id,$promissoria->clientes->id])}}" type="button" class="btn btn-danger">Excluir</a>
        @else
        <button href="#" type="button" class="btn btn-danger" title="Função apenas para administradores" disabled>Excluir</button>
        @endif
      </div>
    </div>
  </div>
</div>