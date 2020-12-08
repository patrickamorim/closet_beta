<div class=" border container text-center  table-success"><h4>Relatório Vendas por Vendedor - Período : {{date( 'd/m/Y', strtotime(old('dataInicial')))}} à {{date( 'd/m/Y', strtotime(old('dataFinal')))}}</h4></span> </div>

<div class="mb-3">
        <table class="table m-auto table-striped  h6  table-primary table-hover pb-3">
        <thead>
           
            <tr >
               
                <th >Vendedor(a)</th>
               
                <th>Status</th>
                <th title=""style="width: 20%">Total Peças</th>
                <th title="" style="width: 20%">Total Vendas</th>
             
             
             </tr>
          
        </thead>
        <tbody>
        @foreach($registros as $key => $registro)     
        <tr>
           
               
           
        <td class="text-uppercase">{{$key}}  <a title="Editar Vendedor"  href="{{route('site.vendedoras.editar', $registro->first()->id_vendedora)}}"  class=" btn-outline-secondary btn-sm text-lowercase font-weight-normal">editar</a></td>   
        
            <td>{{$registro->first()->situacaoVendedora}}</td>
            
             <td >{{number_format($registro->sum('numeroPecas'), 0)}}</td>
             <td>R$ {{number_format($registro->sum('valor'), 2)}}</td>
            
            </tr>
        
            
        @endforeach
        <tr    title="total das promissorias">
            <td colspan="2"></td>
            <th category="tab" scope="row" title="">Total em Vendas</th>
            <th category="tab" scope="row" title="">R$ {{number_format($total, 2)}} </th>
        </tr>
        </tbody>
    </table>    
            
</div>      
            
         
              
             
               
            
      
        