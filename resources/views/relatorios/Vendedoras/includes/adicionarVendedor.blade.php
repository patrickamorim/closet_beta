
@extends('layout.layout')
@include('layout.includes.Adds')


@section('titulo','Cadastro de Clientes')



@section('conteudo')





<div class="container">
  <p class="h4">Cadastro de Vendedor</p>
</div>

<div class="container border border-secondary pb-3 py-3 bg-light">
  @if(isset($e))
  <div class="alert {{($r) == 'sim' ? 'alert-success' : 'alert-danger' }} " role="alert">
    {{$e}}<a href="#" class="alert-link"></a>
  </div>
  @endif

  <form action="{{route('site.vendedores.salvar')}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}

        @include('relatorios.Vendedoras.includes.vendedorForm')

        

    <button type="submit" class="btn btn-primary">Cadastrar</button>
      <button type="reset" class="btn btn-primary" title="Limpar todos os campos">Limpar</button>
  <a href="@if(isset($e)){{route("site.relatorios.relatorioVendedores")}} @else {{request()->headers->get('referer')}} @endif"class="btn btn-danger">{{(isset($registro)) ? 'Cancelar' : 'voltar'}} </a>
    </form>

    </div>



@endsection