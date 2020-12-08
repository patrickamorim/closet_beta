<div class=" border container text-center  table-success"><h4>Relatório Promissórias - Período : {{date( 'd/m/Y', strtotime(old('dataInicial')))}} à {{date( 'd/m/Y', strtotime(old('dataFinal')))}}</h4></span> </div>

<div class="mb-3">
        <table class="table m-auto table-striped  h6  table-primary table-hover pb-3">
        <thead>
           
            <tr >
                <th category="tab" title="">Nº</th>
                <th >Cliente</th>
                <th>Vendedor</th>
                <th title="Data que foi criada a promissória">Dia lançamento</th>
                <th title="Data que foi atribuída à promissória">Data da Compra</th>
                <th>Status</th>
                <th>Parcelas</th>
                <th>Valor</th>
             </tr>
          
        </thead>
        <tbody>
        @foreach($registros as $key => $registros)     
        <tr>
            <td>{{$key+1}}</td>
             <td>{{$registros->clientes->nome}}</td>
             <td>{{$registros->vendedora}}</td>
             <td @if(date( 'd/m/Y', strtotime($registros->created_at)) != date( 'd/m/Y', strtotime($registros->data))) class="text-danger" @endif title="{{date( 'H:m', strtotime($registros->created_at))}}">{{date( 'd/m/Y', strtotime($registros->created_at))}}</td>
             <td @if(date( 'd/m/Y', strtotime($registros->created_at)) != date( 'd/m/Y', strtotime($registros->data))) class="text-danger" @endif >{{date( 'd/m/Y', strtotime($registros->data))}}</td>
             <td>{{$registros->status}}</td>
             <td>{{$registros->parcelas}} x {{number_format($registros->valor/$registros->parcelas,2)}}</td>
             <td>R$ {{$registros->valor}}</td>
            </tr>
        @endforeach
        <tr    title="total das promissorias">
            <td colspan="6"></td>
            <th category="tab" scope="row" title="">Total</th>
            <th category="tab" scope="row" title="">R$ {{number_format($totalPromissorias, 2)}}</th>
        </tr>
        </tbody>
    </table>    
            
</div>      
            
         
              
             
               
            
      
        