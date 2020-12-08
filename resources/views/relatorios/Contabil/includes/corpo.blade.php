<div class=" border container text-center  mb-2 table-success"><h4>Relatório Contábil - Período : {{date( 'd/m/Y', strtotime(old('dataInicial')))}} à {{date( 'd/m/Y', strtotime(old('dataFinal')))}}</h4></span> </div>


<div class="container bg-light mb-3 ">
    <br>
<div class="mb-3 mt-3 col-md-9 m-auto">
        <table class="table  m-auto table-striped border  table-bordered h5  table-primary table-hover  ">
        <thead>
           <tr>
            <th class="text-center h4" colspan="2" title="">Total de Vendas</th>
          </tr>  
        </thead>
        <tbody>
         
        <tr class="" title="Vendas efetuadas nas PROMISSÓRIAS dos clientes + juros gerados">  
            <th >Vendas à Prazo</th>
            <th class="text-left" title="">R$ {{number_format($valorPromissorias + $totalJuros,2)}}</th>
        </tr>     
        
        <tr class="" title="Vendas feitas no caixa por Dinheiro, cheques, cartão e outros">  
            <th >Vendas à vista</th>
            <th class="text-left" title="">R$ {{number_format($totalRecebidos - $TotalHavers,2)}}</th>
        </tr>     
        <tr class="">  
            <th class="" title="" >Total</th>
            <th class="text-left" title="Total Vendas à prazo e vendas à vista" style="width: 22%" scope="col">R$ {{number_format($totalRecebidos - $TotalHavers + $valorPromissorias + $totalJuros,2)}}</th>
        </tr>     
   
    </tbody>
</table> 
</div>
 
<br>

    <div class="mb-3 mt-3 col-md-9 m-auto ">
            <table class="table  m-auto table-striped border table-bordered h5  table-warning table-hover mb-3 ">
            <thead>
               <tr>
                <th class="text-center h4" colspan="2" title="">Total à receber</th>
              </tr>  
            </thead>
            <tbody>
             
            <tr class="" title="Vendas à receber que não estão atrasadas">  
                <th >Vendas à receber</th>
                <th class="text-left" title="">R$ {{number_format($aReceber - $aReceberAtrasados,2)}}</th>
            </tr>     
            
            <tr class="" title="Vendas à receber que  estão atrasadas">  
                <th >Atrasadas à receber</th>
                <th class="text-left" title="">R$ {{number_format($aReceberAtrasados,2)}}</th>
            </tr>     
            <tr class="" title="Total Vendas à receber">  
                <th class=""  >Total</th>
                <th class="text-left"  style="width: 22%" scope="col">R$ {{number_format( $aReceber,2)}}</th>
            </tr>     
       
        </tbody>
    </table> 
    </div>

    <br>

    <div class="mb-3 mt-3 col-md-9 m-auto ">
            <table class="table  m-auto table-striped border table-bordered h5  table-success table-hover mb-3 ">
            <thead>
               <tr>
                <th class="text-center h4" colspan="2" title="">Total Recebidos</th>
              </tr>  
            </thead>
            <tbody>
             
            <tr class="" title="Haver recebidos nas Promissórias dos clientes">  
                <th >Total de Havers</th>
                <th class="text-left" >R$ {{number_format($TotalHavers,2)}}</th>
            </tr>     
            
            <tr class="" title="Vendas feitas no caixa por Dinheiro, cheques, cartão e outros">  
                <th >Total à vista</th>
                <th class="text-left" >R$ {{number_format($totalRecebidos - $TotalHavers,2)}}</th>
            </tr>     
            <tr class="" title="Total já recebidos sobre as vendas">  
                <th class=""  >Total</th>
                <th class="text-left"  style="width: 22%" scope="col">R$ {{number_format( $totalRecebidos,2)}}</th>
            </tr>     
             </tbody>
         </table> 
    </div>

    <br>

    <div class="mb-3 mt-3 col-md-9 m-auto ">
        <table class="table  m-auto table-striped border table-bordered h5  table-primary table-hover mb-3 ">
        <thead>
           <tr>
            <th class="text-center h4" colspan="2" title="">Total Movimentos</th>
          </tr>  
        </thead>
        <tbody>
         
        <tr class="table-success" title="Entradas realizadas nos caixas">  
            <th >Total de Entradas</th>
            <th class="text-left" title="">R$ {{number_format($totalEntradas,2)}}</th>
        </tr>     
        <tr class="table-success" title="Total Vendas à prazo e vendas à vista" >  
            <th class=""  >Total Recebidos</th>
            <th class="text-left" style="width: 22%" scope="col">R$ {{number_format( $totalRecebidos,2)}}</th>
        </tr>  
        <tr class="table-danger" title="saídas de dinheiro no caixa por diversos motivos">  
            <th >Total de Saídas</th>
            <th class="text-left" title="">R$ {{number_format($totalSaidas*(-1),2)}}</th>
        </tr>    
        <tr class="table-active" title="Saldo total dos movimentos">  
            <th class=""  >Saldo Total</th>
            <th class="text-left"  style="width: 22%" scope="col">R$ {{number_format( $totalRecebidos + $totalEntradas + $totalSaidas,2)}}</th>
        </tr>     
         </tbody>
         
     </table> 
</div>

    <br>
    </div> 
        
    
            
</div>      
            

              
             
               
            
      
        