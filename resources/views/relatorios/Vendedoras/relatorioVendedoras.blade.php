@extends('layout.layout')
@include('layout.includes.Adds')

@section('titulo','Caixa')




@section('conteudo')
    
    <div class="container  border bg-dark">

            @include('relatorios.Vendedoras.includes.cabecalho')


            @if(isset($registros) and $registros->count() >0)
            @include('relatorios.Vendedoras.includes.corpo')
            @elseif(isset($registros) and $registros->count() == 0)
            @include('relatorios.Vendedoras.includes.respostaPesquisa')
            @endif


    </div>
@endsection