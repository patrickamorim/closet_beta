@extends('layout.layout')
@include('layout.includes.Adds')

@section('titulo','Caixa')




@section('conteudo')


<script src=  {{ asset("js/caixa2.js")}}></script>


<div class="container ">
    <div  class="container  ">@include('resposta')  </div> 
    <div class="container bg-dark pt-3 pb-3 ">   
        

    @if(isset($caixa) and ($caixa->count('id') > 0))
   

                 @include('Caixa.caixa_form')
                 
            @else
                
            
                @include('Caixa.caixa_cabecalho')
                    
                <form action="{{route('site.caixa.novo')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    @include('Caixa.novoCaixa_form')
                </form>

    @endif

</div>
</div>

@endsection
