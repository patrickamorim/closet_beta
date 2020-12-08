<a href="{{$caixa[0]->status != 'aberto' ? '#' : route('site.clientes.listar')}}" category="NovoHaver" type="button" class="btn btn-outline-dark {{$caixa[0]->status != 'aberto' ? 'disabled' : ''}}"  >
    Novo Haver
</a>