$(window).on('load', function () {


  

  if($('[name=statusDoCaixaTop]').text() == '(aberto)')
  window.history.pushState("object or string", "Title", "/public/caixa");

  $("[name=divParcelas]").fadeOut();

  // FECHAMENTO DO CAIXA
var myVar;

  $('[name=cancelar]').click(function () {

    $.alert({

      title: '!!!',
      content: 'innclusão de um novo movimento do caixa cancelada',
    });

  })

  $('[category=fecharCaixa]').click(function () {

    $.alert({

      title: 'Fechamento do caixa',
      content: 'Para o fechamento do caixa, adicione os valores presentes no caixa nos campos: Dinheiro, Cartão e Outras formas de pagamento e clique em : [Adicionar Saldos]',
    });

  })


  $('[category=adicionarSaldos]').click(function () {

    $thisAddSaldos = $(this);
    $dinheiro = parseFloat($(this).parents('div[category=divFechamento]').find('[name=dinheiro]').val());
    $cartao = parseFloat($(this).parents('div[category=divFechamento]').find('[name=cartao]').val());
    $outros = parseFloat($(this).parents('div[category=divFechamento]').find('[name=outros]').val());
    $total = ($dinheiro + $cartao + $outros).toFixed(2);
    $saldoTotal = ($total - parseFloat($(this).parents('div[category=divFechamento]').find('[category=totalDoCaixa]').text().replace(",",""))).toFixed(2);

    console.log(parseFloat($(this).parents('div[category=divFechamento]').find('[category=totalDoCaixa]').text().replace(",","")));
    
    if (($dinheiro < 0 || isNaN($dinheiro)) || ($cartao < 0 || isNaN($cartao)) || ($outros < 0 || isNaN($outros))) {
            $.alert({

              title: 'Atenção',
              content: 'Os valores devem ser preenchidos com valores POSITIVOS',
            });
      } else {    

        $(this).parents('div[category=divFechamento]').find('[name=dinheiro]').attr('readonly', true);
        $(this).parents('div[category=divFechamento]').find('[name=cartao]').attr('readonly', true);
        $(this).parents('div[category=divFechamento]').find('[name=outros]').attr('readonly', true);

          $(this).parents('div[category=divFechamento]').find('[category=totalSaldos]').text($total);
          $.alert({

            title: 'Saldos Adicionados',
            content: 'Total de R$ ' + $total + ' em saldos adicionados ao caixa"',
          });

          
           myVar = setInterval(function(){ 
              if($saldoTotal == 0){
                if($thisAddSaldos.parents('div[category=divFechamento]').find('[category=rowfechamento]').attr('class') =="bg-success"){
                
                  $($thisAddSaldos).parents('div[category=divFechamento]').find('[category=rowfechamento]').removeClass("bg-success");    
                }else if($thisAddSaldos.parents('div[category=divFechamento]').find('[category=rowfechamento]').attr('class') != "bg-success"){
                    $($thisAddSaldos).parents('div[category=divFechamento]').find('[category=rowfechamento]').removeClass("bg-danger").removeClass("bg-warning").addClass('bg-success');
                }
              }
              else if($saldoTotal <0 ){
                if($thisAddSaldos.parents('div[category=divFechamento]').find('[category=rowfechamento]').attr('class') =="bg-danger"){
                
                  $($thisAddSaldos).parents('div[category=divFechamento]').find('[category=rowfechamento]').removeClass("bg-danger");    
                }else if($thisAddSaldos.parents('div[category=divFechamento]').find('[category=rowfechamento]').attr('class') != "bg-danger"){
                    $($thisAddSaldos).parents('div[category=divFechamento]').find('[category=rowfechamento]').removeClass("bg-success").removeClass("bg-warning").addClass('bg-danger');
                }
              }
              else if($saldoTotal >0 ){
                if($thisAddSaldos.parents('div[category=divFechamento]').find('[category=rowfechamento]').attr('class') =="bg-warning"){
                
                  $($thisAddSaldos).parents('div[category=divFechamento]').find('[category=rowfechamento]').removeClass("bg-warning");    
                }else if($thisAddSaldos.parents('div[category=divFechamento]').find('[category=rowfechamento]').attr('class') != "bg-warning"){
                    $($thisAddSaldos).parents('div[category=divFechamento]').find('[category=rowfechamento]').removeClass("bg-success").removeClass("bg-danger").addClass('bg-warning');
                }
              }
              
              
              

            }, 1500);
           
           
         if($saldoTotal == 0){
         $(this).parents('div[category=divFechamento]').find('[name=status]').val("fechado");
         $(this).parents('div[category=divFechamento]').find('[name=tabelaResumo]').append("<h3 name='fechamento' class='text-success'>Fechamento sem ressalvas</h3>");
         }
         if($saldoTotal > 0 ){
         $(this).parents('div[category=divFechamento]').find('[name=status]').val("fechado com ressalvas");
         $(this).parents('div[category=divFechamento]').find('[name=tabelaResumo]').append("<h3 title='Caixa com Sobras !!!' name='fechamento' class='text-warning'>Fechamento com ressalvas</h3>");
         }  
         if( $saldoTotal < 0){
         $(this).parents('div[category=divFechamento]').find('[name=status]').val("fechado com ressalvas");
         $(this).parents('div[category=divFechamento]').find('[name=tabelaResumo]').append("<h3 title='Caixa com Faltas !!!' name='fechamento' class='text-danger'>Fechamento com ressalvas</h3>");
         }  


         $(this).parents('div[category=divFechamento]').find('[category=sadoFechamento]').text($saldoTotal);
         $(this).attr("disabled", true);
         $(this).parents('div[category=divFechamento]').find('[name=buttonFechar]').attr("disabled", false);
         $(this).parents('div[category=divFechamento]').find('[name=resetarValores]').attr("hidden", false);

      }
  })

  $('[name=resetarValores]').click(function () {

      $thisResete = $(this);

    $.confirm({
      title: 'Atenção!!!',
      content: 'As Entradas inseridas serão apagadas !',
      buttons: {
          confirm: function () {
              

              $($thisResete).parents('div[category=divFechamento]').find('[name=dinheiro]').val("");
              $($thisResete).parents('div[category=divFechamento]').find('[name=cartao]').val("");
              $($thisResete).parents('div[category=divFechamento]').find('[name=outros]').val("");
              $($thisResete).parents('div[category=divFechamento]').find('[name=obs]').val("");
              $($thisResete).parents('div[category=divFechamento]').find('[name=resetarValores]').attr("hidden", true);
              $($thisResete).parents('div[category=divFechamento]').find('[category=totalSaldos]').text("--");
              $($thisResete).parents('div[category=divFechamento]').find('[category=rowfechamento]').removeClass();  
              $($thisResete).parents('div[category=divFechamento]').find('[category=sadoFechamento]').text("--");
              $($thisResete).parents('div[category=divFechamento]').find('[category=adicionarSaldos]').attr("disabled", false);
              $($thisResete).parents('div[category=divFechamento]').find('[name=buttonFechar]').attr("disabled", true);
              $($thisResete).parents('div[category=divFechamento]').find('[name=dinheiro]').attr('readonly', false);
              $($thisResete).parents('div[category=divFechamento]').find('[name=cartao]').attr('readonly', false);
              $($thisResete).parents('div[category=divFechamento]').find('[name=outros]').attr('readonly', false);
              $($thisResete).parents('div[category=divFechamento]').find('[name=fechamento]').remove();
              clearInterval(myVar);
              $.alert('Entradas Apagadas!');
          },
          cancel: function () {
            

          },
         
      }
  });
  })

  $('[name=buttonFechar]').click(function () {

    $this = $(this);

    $.confirm({
      title: 'Fechamento!!!',
      content: 'Deseja realmente realziar um "'+$($this).parents('div[category=divFechamento]').find('[name=fechamento]').text()+'" do caixa?!',
      buttons: {
          confirm: function () {
              
                if( $($this).parents('div[category=divFechamento]').find('[name=obs]').val() == ""){
                  $.alert('Para fechar o caixa preencha uma observação!');
                }else{

                  $.alert('Caixa Encerrado!');
              
                  $this.parents('div[category=divFechamento]').find('[name=submiterCaixa]').submit();
                }

            
          
          },
          cancel: function () {
            

          },
         
      }
  });

    //FIM DO FECHAMENTO DO CAIXA 

    //SUBMIT DATA DO CAIXA
  })
  $dataAntiga = $('[name=dataCaixa]').val(); //valor antigo da data

    $('[name=dataCaixa],[name=caixaEscolhido]').change(function () {
      $this = $(this);
      
      setInterval(function(){ if($dataAntiga != $this.val()) $($this).parents('div[name=divDaData]').find('[name=dataCaixaEnviar]').submit();}, 1000); 
    3
      
    })

    //NOVA VENDA  ---------------------------------------------------------------------------------------------------------------------------

    $("[category=tipoEpag]").change(function() {
   
      
      if($("#opcao4").is( ":checked"))
         $("#outrosSelect").attr("disabled", false).attr("hidden", false);
      else if($("#opcao4").is(":not(:checked)"))
         $("#outrosSelect").attr("disabled", true).attr("hidden", true);

         if($("#opcao2").is( ":checked"))
         $('[name=divParcelas]').fadeIn();
          else if($("#opcao2").is(":not(:checked)"))
         $("[name=divParcelas]").fadeOut();
         


      if($("#opcao3 ").is( ":checked")){

        $.confirm({
          title: 'Compra por Promissórias?',
           content: 'Para Compras por Promissória você será redirecionado para as fichas de CLIENTES em 15 segundos, ou clique em "IR PARA CLIENTES" !',
           autoClose: 'logoutUser|15000',
           buttons: {
               logoutUser: {
                   text: 'Ir Para Clientes',
                   action: function () {
                   // location.href = '{{route("site.clientes.listar")}}';
                    window.location.assign("/public/clientes");
                   }
               },
               cancelar: function () {
                   $.alert('Cancelado');
                  $("#opcao3").prop("checked", false);

               }
           }
       });


      }


    })

    $("[name=gerarVenda]").click(function (){
      $('[name=gerarVenda]').tooltip('hide');

      b= "";
      outroselect = $("[id=outrosSelect]");
    
      nParcelas = $("[name=parcelas]");
      valorTotal = $("[category=valorVenda]");
      data = $("[name=dataVenda]").val();
      pagamento = $("input[name='tipoEpag']:checked");
      cliente = $("input[name=cliente]");
      numeroPecas = $("[name=numeroPecas]");
      vendedora = $("[name=vendedora] :selected");
      pagamentos = $("#opcao2,#opcao4,#opcao1").is(":checked");


      if(vendedora.val() == "" || pagamentos == false || numeroPecas.val() == "" || cliente.val() == "" || valorTotal == "" || valorTotal < 0.01 || numeroPecas.val() % 1 != 0 || ($("#opcao4").is( ":checked") == true && outroselect.val() == "" ) == true){
       
        $.alert({

          title: 'Atenção',
          content: 'Preencha todos os campos da venda corretamente !!!',
        });
     
        cliente.tooltip();
        return false;
      }
      
   
      a =  '<div class="container mt-2"name="tabelaVenda">'+ 
         '<table class="table table-sm table-bordered  table-hover table-striped " id="tabelaResumo" >'+
            '<thead class="table-dark">'+
              '<td colspan="">Parcelamento</td>'+
              '<td colspan="">Pagamento</td>'+
              '<td colspan="">Emissão</td>'+
              '<td colspan="">Valor</td>'+
              '</thead>'+
            '<tbody>';

           

              b +=  '<tr>'+
                      '<th scope="row ">'+nParcelas.val()+'x</th>'+    
                      '<td> <span >'+pagamento.val()+'</span></td>'+       
                      '<td> <span >'+data+'</span></td>'+  
                      '<td> <span >R$ '+(parseFloat(valorTotal.val())/nParcelas.val()).toFixed(2)+'</span></td>'+      
                    '</tr>';
              
            
       c= '</tbody> </table> </div>';    
        
      
        $("[category=divGerarCaixa]").append( a+b+c);

      $("[name=gerarVenda]").attr('disabled', true);
      $('[name=resetarCompra]').attr('hidden', false);

      nParcelas.attr('disabled', true);
      valorTotal.attr('readonly', true);
      cliente.prop('readonly','readonly');
      numeroPecas.attr('disabled', true);
      $("[name=vendedora]").attr('disabled', true);
      $("#opcao2,#opcao4,#opcao1,#opcao3").attr('disabled', true);
      $("#outrosSelect").attr('disabled', true);



    })

    $('[name=resetarCompra]').click(function(){

      nParcelas = $("[name=parcelas]");
      valorTotal = $("[category=valorVenda]");
      cliente = $("input[name=cliente]");
      numeroPecas = $("[name=numeroPecas]");
 


      $.confirm({
        title: 'Resetar Venda!',
        content: 'Deseja Resetar os valores adicionados ?',
        buttons: {
            Confirmar: function () {
              $.confirm({
                title: 'Resetar tudo?!',
                content: 'Resetar todos os dados ou apenas a simulação das parcelas?',
                buttons: {
                    Simulação: function () {
                            
                      $("[name=gerarVenda]").prop('disabled',false);
                      $("[name=tabelaVenda]").fadeOut('slow');
                      nParcelas.attr('disabled', false).val("");
                      valorTotal.attr('readonly', false);
                      cliente.attr('readonly', false);
                      numeroPecas.attr('disabled', false);
                      $("[name=vendedora]").attr('disabled', false);
                      $("#opcao2,#opcao4,#opcao1,#opcao3").attr('disabled', false);
                      $("#outrosSelect").attr('disabled', false);
                      $("[name=obs]");
                      $('[name=resetarCompra]').attr('hidden', true);
                       
                    },
                    Tudo: function () {

                      $("[name=gerarVenda]").prop('disabled',false);
                     

                      nParcelas.attr('disabled', false).val("");
                      valorTotal.attr('readonly', false).val("");
                      cliente.attr('readonly', false).val("");
                      numeroPecas.attr('disabled', false).val(1);
                      $("[name=vendedora]").attr('disabled', false).val("");
                      $("#opcao2,#opcao4,#opcao1,#opcao3").attr('disabled', false).prop("checked", false);
                      $("#outrosSelect").attr('disabled', false).val("");
                      $("[name=obs]").val("");
                      $("#outrosSelect").attr("disabled", true).attr("hidden", true);
                      $('[name=resetarCompra]').attr('hidden', true);
                      $("[name=tabelaVenda]").fadeOut('slow');
                      //$("[name=tabelaVenda]").remove();
                    
                      
                    }
                }
            });

            },
            
            Cancelar: {
              btnClass: 'btn-danger',
                action: function () {
                  
                    
                }
           }
        }
    });



    })
 

      $("[name=valor]").keyup(function(){
          
        
        setTimeout(() => {
            $('[name=gerarVenda]').tooltip('show');
          }, 1000);
        
          setTimeout(() => {
            $('[name=gerarVenda]').tooltip('hide');
          }, 5000);
  
      })

      $("[name=buttonSalvarCompra]").click(function () {
        
       // $("#opcao4").attr("name", "tipo");

       $.confirm({
        title: 'Resetar Venda!',
        content: 'Deseja Resetar os valores adicionados ?',
        buttons: {
            Confirmar: function () {
              nParcelas.attr('disabled', false);
              numeroPecas.attr('disabled', false);
              $("[name=vendedora]").attr('disabled', false);
              $("#opcao2,#opcao4,#opcao1,#opcao3").attr('disabled', false);
              
              if($("#opcao4").is( ":checked"))
              $("#outrosSelect").attr("disabled", false);
               else if($("#opcao4").is(":not(:checked)"))
              $("#outrosSelect").attr("disabled", true);
                  

              $("[name=submiterNovaVenda]").submit();
              
           
            },
            
            Cancelar: {
              btnClass: 'btn-danger',
                action: function () {
                  
                    
                }
           }
        }
    });
    
      })

      $("[category=tab]").hover(function() { 
      valorAntigo = $(this).text();
       $(this).text($(this).attr('title'));
    }, function() { 
      $(this).text(valorAntigo);
       
    }); 
    


});


