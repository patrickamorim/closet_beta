
@extends('layout.layout')
@include('layout.includes.Adds')


@section('titulo','Editar Vendedor')



@section('conteudo')





<div class="container">
  <p class="h4">Editar Vendedor</p>
</div>

<div class="container border border-secondary pb-3 py-3 bg-light">
  @if($errors->any())
  <div class="alert alert-danger " role="alert">
    {{$errors->first()}}<a href="#" class="alert-link"></a>
  </div>
  @endif

  @if(session('success'))
  <div class="alert alert-success " role="alert">
    {{session('success')}}<a href="#" class="alert-link"></a>
  </div>
  @endif

<form action="{{route('site.vendedores.atualizar', $registro->id)}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}} 
  

        @include('relatorios.Vendedoras.includes.vendedorForm')

        

    <button type="submit" class="btn btn-primary">Salvar</button>
  <a href="@if(isset($registro)){{route("site.relatorios.relatorioVendedores")}} @else {{request()->headers->get('referer')}} @endif"class="btn btn-danger">{{!session('success') ? 'Cancelar' : 'voltar'}} </a>
    </form>

    </div>



@endsection