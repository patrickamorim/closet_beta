@extends('layout.layout')

@section('titulo','Compras')




@section('conteudo')



<div class="container">

<div class="row">


<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Data</th>
      <th  scope="col">Valor</th>
      <th scope="col">Parcelas</th>
      <th scope="col">Ação</th>

    </tr>
  </thead>

     @foreach($promissorias as $promissoria)
        <tbody>
          <tr>

            <th scope="row " class="h5">{{$promissoria->data}}</th>

            <td><a href="#" class="h5" data-toggle="modal" data-target="#{{$promissoria->id}}">{{$promissoria->valor}} R$</a></td>

            <td  class="h5  {{isset($promissoria->status) && $promissoria->status == 'aberta' ? 'text-primary' : ''}}">{{($promissoria->parcelas) }} x {{($promissoria->valor)/($promissoria->parcelas) }}</td>
            <td>
                <a href="#" type="button" class="btn btn-primary btn-sm pl-1" >Detalhes</a>
                <a href="#" type="button" class="btn btn-primary btn-sm pl-1">Haver</a>


             </td>

          </tr>


      @endforeach

</table>

</div>

@if(isset($idset))
<div class="div justify-content-center">
  {{$promissorias->links()}}
</div>
@endif


@include('layout.includes.formularioCompras')
<button type="button" class="btn btn-secondary btn-sm ">voltar</button>
</div>

@endsection
