@extends('layout.layout')
@include('layout.includes.Adds')





@section('titulo','Clientes')




@section('conteudo')

<script >
$(window).on('load', function () {

if(document.referrer.match('caixa')){
    
 
  //   {template: '<div class="tooltip md-tooltip-main"> <div class = "tooltip-arrow md-arrow" > < /div> <div class = "tooltip-inner md-inner-main" > < /div> </div>' }
      setTimeout(() => {
              $('[data-toggle="tooltip"]').tooltip('show');
            }, 800  );
          
            setTimeout(() => {
              $('[data-toggle="tooltip"]').tooltip('hide');
            }, 7500);
    
  }

  

});

</script>

<div class="container ">

<div class="row table-wrapper-scroll-y my-custom-scrollba table-responsive "  >


<table class="table table-fixed " >
  <thead class="thead-dark" data-toggle="tooltip" data-placement="top" title="Para 'NOVO HAVER' ou 'NOVA VENDA EM PROMISSÓRIA' clique em [Compras/Receber] do cliente correspondente!!!'">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Nome</th>
      <th scope="col">Situacao</th>
      <th scope="col">Ação</th>
    </tr>
  </thead>

     @foreach($registros as $registro)
        <tbody class="corpo-tabela-cliente border bg-light">
          <tr>

            <th scope="row ">{{$registro->id}}</th>
            <td><a href="#" class="h5 text-uppercase" data-toggle="modal" data-target="#{{$registro->id}}">{{$registro->nome}}</a></td>

            <!-- Modal -->
            <div class="modal fade" id="{{$registro->id}}" tabindex="-1" role="dialog" aria-labelledby="{{$registro->id}}" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="{{$registro->id}}">{{$registro->nome}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">

                    <div class="form-group ">
                      <label for="nome">Nome</label>
                      <input type="text" disabled="disabled" class="form-control disabled text-uppercase" id="nome" value="{{isset($registro->nome) ? $registro->nome : ''}}" title="Nome do Cliente" required>
                    </div>
                    <div class="form-group ">
                      <label for="rua">Rua</label>
                      <input type="text" disabled="disabled" class="form-control" id="rua" name="rua"  value="{{isset($registro->rua) ? $registro->rua : ''}}"  title="Rua"  required>
                    </div>
                    <div class="form-row ">
                      <div class="form-group col-md-6">
                        <label for="cidade">Cidade</label>
                        <input type="text" disabled="disabled" class="form-control" id="cidade" name="cidade"  value="{{isset($registro->cidade) ? $registro->cidade : ''}}"   title="cidade" maxlength="30" required>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="bairro">Bairro</label>
                        <input type="text" disabled="disabled" class="form-control" id="bairro" name="bairro"   value="{{isset($registro->bairro) ? $registro->bairro : ''}}"  title="Bairro" maxlength="15" required>
                      </div>
                      <div class="form-group col-md-2">
                        <label for="numero">Número</label>
                        <input type="text" disabled="disabled" class="form-control" id="numero" name="numero"   value="{{isset($registro->numero) ? $registro->numero : ''}}" title="número da casa" >
                      </div>
                      <div class="form-group col-md-3">
                        <label for="telefone">Telefone</label>
                        <input type="number" disabled="disabled" class="form-control" id="telefone" name="telefone"  value="{{isset($registro->telefone) ? $registro->telefone : ''}}"  title="Telefone" >
                      </div>
                      <div class="form-group col-md-4">
                        <label for="cel">Celular</label>
                        <input type="text" disabled="disabled" class="form-control number" id="cel" name="celular" value="{{isset($registro->celular) ? $registro->celular : ''}}"title="Telefone">
                      </div>
                      <div class="form-group col-md-5">
                        <label for="email">Email</label>
                        <input type="email" disabled="disabled" class="form-control" id="email" name="email"  value="{{isset($registro->email) ? $registro->email : ''}}"  title="Email" >
                      </div>
                      <div class="form-group ">
                        <label for="inputAddress2">Nascimento</label>
                        <input type="text" disabled="disabled" class="form-control" id="inputAddress2" name="nascimento" value="{{isset($registro->nascimento) ? date( 'd/m/Y' , strtotime($registro->nascimento )): ''}}"  >
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-5">
                        <label for="cpf">CPF</label>
                        <input type="number" disabled="disabled" class="form-control" id="cpf" name="cpf"   value="{{isset($registro->cpf) ? $registro->cpf : ''}}" title="CPF do cliente" maxlength="11" required>
                      </div>
                      <div class="form-group col-md-5">
                        <label for="rg">RG</label>
                        <input type="number" disabled="disabled" class="form-control" id="rg" name="rg"  value="{{isset($registro->rg) ? $registro->rg : ''}}"  title="RG do cliente" maxlength="10" required>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="obs">Observações</label>
                      <textarea type="text" disabled="disabled" class="form-control" id="obs" name="observacao"   title="Observações" maxlength="200"> {{isset($registro->observacao) ? $registro->observacao : ''}}</textarea>
                    </div>


                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    @if(Auth::user()->funcao == "administrador")
                      <a href="{{route('site.clientes.editar', $registro->id)}}" type="button" class="btn btn-primary">Editar</a>
                    @endif
                  </div>
                </div>
              </div>
            </div>



            <td  class="{{isset($registro->situacao) && $registro->situacao == 'cancelada' ? 'text-danger' : ''}}">{{($registro->situacao) }}</td>
            <td> <a href="{{route('site.compras.listar.clientes',  $registro->id)}}" type="button" class="btn btn-primary {{isset($registro->situacao) && $registro->situacao == 'cancelada' ? 'bg-danger' : ''}}" >Compras/Receber</a>
              @if(Auth::user()->funcao == "administrador")
                <a href="{{route('site.clientes.editar', $registro->id)}}" type="button" class="btn btn-primary">Editar</a>
              @endif
             </td>
          </tr>
      @endforeach

</table>

</div>



<nav aria-label="Page navigation example ">
  <ul class="pagination justify-content-center">
  <a class="page-link" title="Primeira página" href="{{$registros->appends($input)->url(1)}}">««</a>
    <li class="page-item">
      <a class="page-link" id="previus" href="{{$registros->previousPageUrl() !== null ? $registros->appends($input)->previousPageUrl() : '#'}}" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>

    <li class="page-item"><a class="page-link" href="#">{{$registros->CurrentPage()}}/{{$registros->lastPage()}}</a></li>


    <li class="page-item">
      <a class="page-link" id="proximo" href="{{$registros->nextPageUrl() !== null ? $registros->appends($input)->nextPageUrl() : '#'}}" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
    <a class="page-link" title="Última página" href="{{$registros->appends($input)->url($registros->lastPage())}}">»»</a>
  </ul>
</nav>








<a href="{{route('site.clientes.cadastrar')}}" type="button" class="btn btn-primary btn-sm pl-1 ">Novo Cliente</a>
<button type="button" class="btn btn-secondary btn-sm ">voltar</button>







@endsection
