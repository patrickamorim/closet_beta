@extends('layout.layout')
@include('layout.includes.Adds')

@section('titulo','Caixa')




@section('conteudo')
    
    <div class="container  border bg-dark">

            @include('relatorios.Promissorias.includes.cabecalho')


            @if(isset($registros) and $registros->count() >0)
            @include('relatorios.Promissorias.includes.corpo')
            @elseif(isset($registros) and $registros->count() == 0)
            @include('relatorios.Promissorias.includes.respostaPesquisa')
            @endif


    </div>
@endsection