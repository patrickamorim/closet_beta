


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


    if ($(this).parents('div[category=doHaver]').find('[name=valor]').val() > 0) {



      $(this).parents('[tabindex=-1]').find('[id=salvar]').removeAttr('disabled');
      $('[category=haverGerar]').parents('div[category=doHaver]').find('[id=msg2]').remove();
      $(this).parents('div[category=doHaver]').find('[id=msg]').prepend("<table id='msg2' class='table-striped table-bordered border-dark'>" +
        "<thead class ='thead-dark'><tr><th>Juros/Descontos</th><th>Valor</th></tr></thead>");
      //  alert ($(this).parents('[category=doHaver]').first().find('[name=valor]').val());

      if ($(this).parents('div[category=doHaver]').find('[id=pagamentoTotal]').is(':checked') == true)   //testando a parte do valor total
        $(this).parents('div[category=doHaver]').find('[name=valor]').val($(this).parents('div[category=doHaver]').find('[name=valorRestante]').val());

        

      $.post("http://localhost/Closet_beta/public/compras/verJuros", {
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
    dia = data.getDate(),
    mes = data.getMonth() + 1,
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