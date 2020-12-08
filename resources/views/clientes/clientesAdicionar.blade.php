
@extends('layout.layout')
@include('layout.includes.Adds')


@section('titulo','Cadastro de Clientes')



@section('conteudo')





<div class="container">
  <p class="h4">Cadastro de Clientes</p>
</div>

<div class="container border border-secondary pb-3 py-3 bg-light">
  @if(isset($e))
  <div id="alerta" class="alert {{($r) == 'sim' ? 'alert-success' : 'alert-danger' }} " role="alert">
    {{$e}}<a href="#" class="alert-link"></a>
  </div>
  @endif

  <form action="{{route('site.clientes.salvar')}}" method="post" id="adicionar" enctype="multipart/form-data">
    {{csrf_field()}}

        @include('layout.includes.clientesFormulario')



    <button type="submit" id="botaoAdicionar" class="btn btn-primary">Cadastrar</button>
      <button type="reset" class="btn btn-primary" title="Limpar todos os campos">Limpar</button>
      <a href="{{route('site.clientes.listar')}}"class="btn btn-danger">{{(!isset($e)) ? 'Cancelar' : 'voltar'}} </a>
    </form>

    </div>



@endsection
