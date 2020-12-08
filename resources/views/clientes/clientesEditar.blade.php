@extends('layout.layout')
@include('layout.includes.Adds')





@section('titulo','Clientes')




@section('conteudo')

<div class="container ">
<p class="h5 ">Atualizar Cliente - <span class="text-uppercase">{{$registro->nome}}</span></p>
</div>

<div class="container border border-secondary pb-3 py-3 bg-light">
  @if($errors->any())
  <div class="alert alert-danger " role="alert">
    {{$errors->first()}}<a href="#" class="alert-link"></a>
  </div>
  @endif

<div class="container border border-secondary pb-3 py-3 bg-light">


  <form action="{{route('site.clientes.atualizar',$registro->id)}}" method="post" id="atualizar" enctype="multipart/form-data">
    {{csrf_field()}}
  <input type="hidden" name="_method" value="put">

        @include('layout.includes.clientesFormulario')



    <button type="submit" id="botaoAtualizar" class="btn btn-primary">Atualizar</button>
      <a href="{{route('site.clientes.listar')}}"class="btn btn-danger">Cancelar</a>
    </form>

    </div>

@endsection
