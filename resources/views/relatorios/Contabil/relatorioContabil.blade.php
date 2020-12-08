@extends('layout.layout')
@include('layout.includes.Adds')

@section('titulo','Caixa')




@section('conteudo')
    
    <div class="container  border bg-dark">

            @include('relatorios.Contabil.includes.cabecalho')


            @if(isset($aReceber))
            @include('relatorios.Contabil.includes.corpo')
            @endif


    </div>
@endsection