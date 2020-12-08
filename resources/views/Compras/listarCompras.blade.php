@extends('layout.layout')

@section('titulo','Compras')




@section('conteudo')

<script>



function LimteHaver(meuThis, totalJurosGerados, valorrestante) {

if ($(meuThis).parents('div[category=doHaver]').find('[id=pagamentoTotal]').is(':checked') == true) {  //testando a parte do valor total 

  $('div[category=doHaver]').find('[name=valor]').val((valorrestante + totalJurosGerados).toFixed(2));
 
  $('[id=msg2]').parents('div[category=doHaver]').find('[name=valorFinal]').text('R$ '+(valorrestante + totalJurosGerados).toFixed(2));


  
  //totalJurosGerados = 0;
  // $(this).parents('div[category=doHaver]').find('[name=valor]').val(totalJurosGerados);

} else if (($(meuThis).parents('div[category=doHaver]').find('[id=pagamentoTotal]').is(':checked') == false) && ($(meuThis).parents('div[category=doHaver]').find('[name=valor]').val() > (valorrestante + totalJurosGerados))) {

  $.alert({ title: 'Atenção !!!', content: 'O valor máximo de haver para esta  promissória é de R$ ' + (valorrestante + totalJurosGerados).toFixed(2), });
  //alert('O valor máximo do haver para esta  promissória é '+(valorrestante+totalJurosGerados).toFixed(2));
  $('div[category=doHaver]').find('[name=valor]').val((valorrestante + totalJurosGerados).toFixed(2));
  $(meuThis).parents('[tabindex=-1]').find('[id=salvar]').attr("disabled", true);
  //totalJurosGerados = 0;


}


};


$(window).on('load', function () {
//$('[category=parcelas]').hide();

$("[category=loading]").click(function(){

  setTimeout(() => {
  $(this).attr("disabled", true);
}, 100);
setTimeout(() => {
  $(this).attr("disabled", false);
}, 3000);
 // $("[category=loading]").attr("disabled", false);

});

setTimeout(() => {
  $('#obsCabecalho').attr('hidden',false).delay(8000);
  $('#obsCabecalho').fadeOut(2000);
  $('#resposta').fadeOut(15000);
}, 1200);



$('[category=pormissoriasCabecalho]').click(function () {
  $(this).parents('#areaToda').find('.corpo-tabela').toggle(500);
});


$('.corpo-tabela').fadeOut(1000);
$('.thead-dark').click(function () {
  $(this).next().toggle(500);
});



$('[category=ajax-modal]').on('hidden.bs.modal', function (e) {
  // do something...

  if ($(this).find('[id=pagamentoTotal]').is(':checked') == true) {
    $('[category=valorH]').parents('div[category=doHaver]').find('[name=valor]').val(0);
    $('[category=haverGerar]').parents('div[category=doHaver]').find('[id=msg2]').remove();
  } //totalJurosGerados = 0;  
  // alert('fechou modal');
})





$('#custom-select').change(function () {
  selecionado = $('#custom-select option:selected').val();
  
  if ((selecionado != 'Mostrar Todas')) {
    $('[category=pormissorias]:not(:contains(' + selecionado + '))').hide(300);
    $('[category=pormissorias]:contains(' + selecionado + ')').show(300);
    $('.corpo-tabela').show(1000);
  } else { $('[category=pormissorias]').show(500); $('.corpo-tabela').hide(1000); }




});

//$('#haverGerar').click(function(){
//$('#haverGerar').append(' <input type="hidden" name="GeraHaver" value="haver"><h2>@if(isset($mostra)){{$mostra}}@endif</h2>');

$('[category=valorH]').keyup(function () {

  $(this).parents('[tabindex=-1]').find('[id=salvar]').attr("disabled", true);
  $(this).parents('div[category=doHaver]').find('[id=pagamentoTotal]').prop("checked", false);
});


//});

$('[category=haverGerar]').click(function () {

  ThisAqui = this;

  totalJurosGerados = 0;
  //vlaor total dos jutos gerados
  valorrestante = parseFloat($(this).parents('div[category=doHaver]').find('[name=valorRestante]').val());


  if ($(this).parents('div[category=doHaver]').find('[name=valor]').val() > 0 || $(this).parents('div[category=doHaver]').find('[id=pagamentoTotal]').is(':checked') == true) {



    $(this).parents('[tabindex=-1]').find('[id=salvar]').removeAttr('disabled');
    $('[category=haverGerar]').parents('div[category=doHaver]').find('[id=msg2]').remove();
    $(this).parents('div[category=doHaver]').find('[id=msg]').prepend("<table id='msg2' class='table-striped table-bordered border-dark'>" +
      "<thead class ='thead-dark'><tr><th>Juros/Descontos</th><th>Valor</th></tr></thead>");
    //  alert ($(this).parents('[category=doHaver]').first().find('[name=valor]').val());

    if ($(this).parents('div[category=doHaver]').find('[id=pagamentoTotal]').is(':checked') == true)   //testando a parte do valor total
      $(this).parents('div[category=doHaver]').find('[name=valor]').val($(this).parents('div[category=doHaver]').find('[name=valorRestante]').val());

      

    $.post("{{route('site.compras.verJuros')}}", {
      _token: $('[name=_token]').val(),
      id_cliente: $(this).parents('div[category=doHaver]').find('[name=id_cliente]').val(),
      id_promissoria: $(this).parents('div[category=doHaver]').find('[name=id_promissoria]').val(),
      dataP: $(this).parents('div[category=doHaver]').find('[name=dataP]').val(),
      valor: $(this).parents('div[category=doHaver]').find('[name=valor]').val()  
    }, function (msg) {
      // 

      $.each(msg, function (i, value) {
        // alert(value.valor+value.datas+value.referencia);

        $('[id=msg2]').prepend("<tbody>" +
          "<tr><th scope='row' title='" + value.referencia + "' class='h5'>Correção</th> <td colspan=''scope='row' class='h5'><a title='" +
          value.referencia + "'> R$ " + value.valor.toFixed(2) + "</a></tr> </tbody>").val();
        totalJurosGerados = totalJurosGerados + value.valor;
      }), $('[id=msg2]').append("<tbody>" +
        "<tr><th scope='row' class='h5 text-danger'>Correção Total</th> <td category='TD' scope='row' class='h5 text-danger'><a title='Correção gerada neste pagamento" +
        "'><span id='totaljuros'> R$ " + totalJurosGerados.toFixed(2) + "</span></a></tr> </tbody>" +
        "<tbody> <tr><th scope='row' class='h5 text-success'>Haver</th> <td name='valorFinal' scope='row' class='h5 text-success'><a title='" +
        "'>" + $('[id=msg2]').parents('div[category=doHaver]').find('[name=valor]').val() + " R$</a></tr> </tbody>")






    })


  } else $.alert({ title: 'Alerta !!!', content: 'valor do Haver tem que ser maior que 0 (zero)', });//alert ('valor do Haver tem que ser maior que 0 (zero)'); 


  setTimeout(function () { LimteHaver(ThisAqui, totalJurosGerados, valorrestante); }, 700);


});

$("[name=parcelas], [category=valorNovaCompra]").change(function(){
  if($("[name=dataVencimento]").val() == ""){

    $.alert({
      title: 'Atenção!',
      content: 'Preencha as datas corretamente !',
  });

    return false;
  }

  
  
 // if($('[name=dataVencimento]').val() )

  $("[name=tabelaVenda]").remove();
  dataVencimeto = $("[name=dataVencimento]").val();
  nParcelas = $('[name=parcelas]').val();
  valor= $('[category=valorNovaCompra]').parents("[name=divDaTabela]").find("[name=valor]").val();
  b="";

  var data = new Date(dataVencimeto);
  dia = data.getDate() +1,
  mes = data.getMonth(),
  ano = data.getFullYear();
  index2 = 0;
  index3 = 0;
  zero = 0;
  a =  '<div class="container h6 mt-2"name="tabelaVenda">'+ 
  '<table class="table table-sm table-bordered  table-hover table-striped " id="tabelaResumo" >'+
     '<thead class="table-dark">'+
       '<td colspan="">Nº da Parcela</td>'+
   
       '<td colspan="">Vencimento</td>'+
       '<td colspan="">Valor</td>'+
       '</thead>'+
     '<tbody>';

     for (let index = 1; index <= nParcelas; index++) {

              if((mes+index) > 12 || mes == 0){
                index2 =  index - index3;
                  if( (index - index3) == 1)
                  ano++;
                mes= zero;
              }else if(((mes+index) < 13) && (mes != 0)){
                index2 = index;
                index3 = index2;
              }

       b +=  '<tr>'+
               '<th scope="row ">'+(index)+'</th>'+      
               '<td> <span >'+dia+'/'+(mes+(index2))+'/'+ano+'</span></td>'+  
               '<td> <span >'+(parseFloat(valor/nParcelas)).toFixed(2)+'</span></td>'+
              '</tr>'     
             ;
       
     }
c=  '</tbody> </table> </div>';    

$("[name=divDaTabela]").append(a+b+c);

})



});

</script>



<div class="container">

@if($registros[0]->observacao != "" and !session()->has('success') and !session()->has('error'))
<div id="obsCabecalho" hidden  class="alert alert-warning border h5 text-uppercase" role="alert">
  Observações : {{$registros[0]->observacao}}
</div>
@endif

<div  class=" " id="respostaDiv">@include('resposta')  </div> 

<h5 class="text-uppercase">{{$registros[0]->nome}}</h5>
<div class=" border border-dark mb-2 row bg-light">

    @if(isset($parcelas))
          <select class="custom-select ml-3 mr-3 mt-2 " id="custom-select">
          <option selected disabled>Parcelas à pagar</option>,
          <option >Mostrar Todas</option>,

              @foreach($parcelas as $parcela)
              <option class=" text-center {{$parcela->mesesAtrasado > 0 ? 'text-danger' : ''}}" value="{{ date( 'd/m/Y' , strtotime($parcela->datasP))}}">
              {{ date( 'd/m/Y' , strtotime($parcela->datasP))}} - Pagar
              </option>
          
            
            @endforeach

          </select>  
    @endif

    @if(isset($resumo))
              <div class="block bg-white">
                      
                      <h5 class="text-success"> <span class="text-primary container">Vence Hoje : {{$resumo[5] < '0,01' ? '0,00' : number_format($resumo[5], 2).' R$'}}
                      </span>  <span class="container">Total recebido :  {{$resumo[0] < '0,01' ? '0,00' : number_format($resumo[0], 2).' R$'}}
                      </span><span class="text-dark container">Á vencer : {{number_format($resumo[4], 2).' R$'}}</span>  </h5>
                      <h5 class="text-danger"> <span class="container">Atrasados : {{$resumo[2] <'0,01' ? '0,00' : number_format($resumo[2], 2).' R$'}} </span>   
                      <span class="container mr-5">Juros : {{$resumo[3] < '0,01' ? '0,00' : number_format($resumo[3], 2).' R$'}}</span>&nbsp;&nbsp;&nbsp;&nbsp;  
                      <span class="ml-4 container text-danger ">Total à pagar : {{number_format($resumo[6], 2).' R$'}}</span>  </h5>

              </div>

            
    @endif
  
    <div class="mt-2 ml-3 ">
    @if(isset($registros[0]->situacao) and  ($registros[0]->situacao == 'apto') and $caixa > 0 )
    @include('layout.includes.formularioCompras')
   
    @endif

    @if(isset($registros[0]->situacao) and  $registros[0]->situacao == 'cancelada')
    <button type="button" class="btn btn-danger btn-lg btn-block" disabled title="Cliente bloquedo, inápto à fazer novas compras">
      Nova Compra
    </button>

    @elseif($caixa == 0)
    <button type="button" class="btn btn-warning btn-lg btn-block" disabled title="Obrigatório ter um caixa aberto para criar promissória">
      Nova Compra
    </button>
    @endif
    </div>
</div>

@foreach($promissorias as $promissoria)

<div id="areaToda"  category="pormissorias" class="row" >

  <div category="pormissoriasCabecalho" class=" container block border border-dark bg-dark text-light ">
      
      <h5 class="{{$promissoria->status == 'fechada' ? 'text-success' : ''}} "> <span class="text-light" >{{$promissoria->status == 'fechada' ? '[PAGO]' : ''}}</span>   {{date( 'd/m/Y' , strtotime($promissoria->data))}}  -  [R$ {{$promissoria->valor}}]<a class='h5 text-uppercase'>  -  {{$promissoria->clientes->nome}} </a> <spam class="float-right">@include('layout.includes.excluirPromissoria')</spam></h5> 

    

  </div>
<table id="tableCompras"  class="table table-md border border-dark ">
  <thead id="tabela_compras" class="thead-dark">
    <tr>
      <th category="parcelas" scope="col">R$ {{$promissoria->valor}} em {{$promissoria->parcelas}}x</th>
      @foreach($promissoria->datasP as $datasp)
      <th  scope="col " class="h5  @if($datasp->situacao == 'aberta'  &&  $datasp->mesesAtrasado > 0) text-danger @endif 
      @if($datasp->situacao == 'aberta'  &&  date( 'd/m/Y' , strtotime($datasp->datasP)) == date( 'd/m/Y' ) ) text-primary @endif
      @if($datasp->situacao == 'pago' ) text-success @endif" title='{{$datasp->situacao}}@if($datasp->situacao == 'aberta'  &&  $datasp->mesesAtrasado > 0), com {{$datasp->mesesAtrasado}} mês(es) de atraso @endif'>{{date( 'd/m/Y' , strtotime($datasp->datasP))}}</th>
      @endforeach
      <th scope="col">TOTAL</th>
    </tr>
  </thead>

        <tbody class="corpo-tabela bg-white">
          <tr>

                <th scope="row " class="h5">PARCELAS</th>

                    @foreach($promissoria->datasP as $datasp)
                      <td scope="row " class="h5  {{isset($datasp->situacao) && $datasp->situacao == 'pago' ? 'text-success' : ''}}" title='{{$datasp->situacao}}'>R$ {{$datasp->valorParcela}}</td>
                    @endforeach

                <td scope="row " class="h5">R$ {{$promissoria->valor}}</td>
          </tr>
          <tr>
                <th scope="row " class="h5">HAVER</th>

                  <td colspan="{{$promissoria->datasP->count('id')}}"scope="row " class="h5">

                    @foreach($promissoria->havers as $havers)
                  <a  class="border border-black pr-04" title="{{date( 'd/m/Y' , strtotime($havers->dataP))}}"> R$ {{$havers->valor}}  -     @endforeach </td></a>
                



                <td scope="row " class="h5"> R$ {{number_format($promissoria->havers->sum('valor'), 2)}}</td>
          </tr>
          <tr>
                <th scope="row " class="h5">CORREÇÃO</th>

                <td colspan="{{$promissoria->datasP->count('id')}}"scope="row " class="h5">
                @foreach($promissoria->juros as $juros)<a title="{{$juros->referencia}}"> R$ {{$juros->valor}} -  </a>@endforeach</td>


                <td scope="row " class="h5">R$ {{number_format($promissoria->juros->sum('valor'), 2)}}</td>

          </tr>

    </tr>
    <tr>
           
          <th> 
            @if($promissoria->status == 'aberta' and ($caixa > 0))  @include('layout.includes.haverFormulario') @endif
            @if($promissoria->status == 'fechada' or ($caixa < 1))<button  type="button" class="btn btn-primary" disabled >{{$caixa == 0 ? 'Haver habilitado apenas com caixa aberto' : 'Novo Haver'}}</button>@endif
          </th>
           
          
          
          
         
          <td colspan="{{$promissoria->datasP->count('id')}}" scope="row " class="h5 text-right">RESTANTE </td>

          <td scope="row " class="h5">R$ {{number_format($promissoria->valor+$promissoria->juros->sum('valor')-$promissoria->havers->sum('valor'), 2)}}</td>

    </tr>
</tbody>
</table>

</div>

@endforeach


@if(isset($idset))
<div class="div justify-content-center">
  {{$promissorias->links()}}
</div>

</div>

@endif

@endsection
