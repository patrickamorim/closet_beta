
  $(document).ready(function($){

    $('#botaoAtualizar').click(function(){
       $('#cpf').unmask();
     // $('#atualizar').submit();
     setTimeout(() => {
      $('#cpf').mask('000.000.000-00', {reverse: true, clearIfNotMatch: true});
     }, 500);
    
    })
  
    $('#botaoAdicionar').click(function(){
       $('#cpf').unmask();
      //$('#adicionar').submit();
      setTimeout(() => {
        $('#cpf').mask('000.000.000-00', {reverse: true,clearIfNotMatch: true});
       }, 500);
    })
  
    
    $('#cpf').mask('000.000.000-00',{reverse: true,clearIfNotMatch: true});


//esvanecimento da mensagem de laerta de sucesso ou erro quando adiciona

   

    });
    
    
  

  




