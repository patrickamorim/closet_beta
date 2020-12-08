@extends('layout.layout')
@include('layout.includes.Adds')

@section('titulo','Configuração')




@section('conteudo')
<script src=  {{ asset("js/setup.js")}}></script>

<div  class="container" style="width: 30%">@include('resposta')  </div>     
<form action="{{route('site.configuracao.salvar')}}" method="post" id="atualizar" enctype="multipart/form-data">
    {{csrf_field()}}
   
    
    <div class="container  border bg-dark  " style="width: 600px" >

            @include('setup.includes.corpo')

           
    </div>


</form>
@endsection