

<div class="container " >

    
<div class="border border-dark mb-2 row bg-light  " name="divDaData">

    <form action="{{route('site.caixa.listar')}}" method="get" name="dataCaixaEnviar" enctype="multipart/form-data"> {{csrf_field()}}
           
    <div class="form-row ml-2  mt-4"> 
        
            <div class="form-group {{(count($caixa) > 1 or (isset($caixasDoDia) and count($caixasDoDia) > 1)) ? 'col-md-6' : 'col-md-11'}}">
        <input type="date"  class="form-control text-center " id="inputAddress2" name="dataCaixa" value="{{date('Y-m-d', strtotime($caixa[0]->abertura)) }}" required >
    </div>

        @if(count($caixa) > 1 or (isset($caixasDoDia) and count($caixasDoDia) > 1))

            <div class="form-group col-md-5">
            <select class="custom-select bg-light    form-group col-md-3" id="parcelas" name="caixaEscolhido" required title="Caixas abertos no dia selecionado">
            


                @if (count($caixasDoDia) > 1)

                @foreach ($caixa as $kay => $caixas)
                
                    <option class="text-primary text-left" value="null" selected> Caixa: {{date('H:m', strtotime($caixas->abertura))}}h </option>

                @endforeach
                    @foreach ($caixasDoDia as $kay => $caixas)
                    
                    <option class="text-primary text-left" value="{{$caixas->id}}">{{$caixas->id - $caixasDoDia->last()->id+1}}º - aberto às: {{date('H:m', strtotime($caixas->abertura))}}h </option>

                    @endforeach
            
                @endif

                @if (count($caixa) > 1)
                <option value="null" selected>Caixas do dia</option disabled>
                @foreach ($caixa as $kay => $caixas)
                
                    <option class="text-primary text-left" value="{{$caixas->id}}" >{{$caixas->id - $caixa->last()->id+1}}º - aberto às: {{date('H:m', strtotime($caixas->abertura))}}h </option>

                @endforeach
                @endif
            
             </select>
             </div>
        
        @endif
        
    </div>

</form>


    
<table class="table border  bg-white table-sm {{(count($caixa) > 1 or (isset($caixasDoDia) and count($caixasDoDia) > 1)) ? 'col-md-7' : 'col-md-8 ml-5'}}  mt-2" >
       
        <tbody>
               
            <tr>
               
                <td scope="row" class="text-success text-center">Entradas : R$ {{isset($item_caixas) ? number_format($item_caixas->where('tipoEpag','!=', 'Saída')->sum('valor'), 2) : '--'}}</td>
                <td class="text-danger text-center">Saídas : R$ {{isset($item_caixas) ? number_format($item_caixas->where('tipoEpag', 'Saída')->sum('valor'), 2) : '--'}}</td>
                <td class="text-primary text-center">Total : R$ {{isset($item_caixas) ? number_format($item_caixas->sum('valor'), 2) : '--'}}</td>
            </tr>
            <tr>
                
          
              
                <td colspan="3" align="center">@include('Caixa.Caixa_Movimentacao.caixa_NovaCompra') @include('Caixa.Caixa_Movimentacao.caixa_NovoMovimento') @include('Caixa.Caixa_Movimentacao.caixa_novoHAver') @include('Caixa.Caixa_Movimentacao.caixa_Fechar') </td>
            </tr>
        </tbody>
      </table>
    </div>
</div>
        <div class="container border text-center  table-success"><h2>CAIXA  -  {{date( 'd/m/Y', strtotime($caixa[0]->abertura))}}</h2> <span name='statusDoCaixaTop' class='h6'>({{$caixa[0]->status}})</span> </div>


        <table class="table m-auto table-striped table-bordered  table-primary table-hover mb-3">
        <thead>
            <tr>
            <th style="width: 15%" class="text-center "scope="col">Tipo</th>
            <th scope="col">Histórico</th>
            <th style="width: 12%" scope="col">Valor</th>
            
            </tr>
        </thead>
        <tbody>
            
            
        
               @if(isset($item_caixas)) @foreach($item_caixas as $caixas) 
            <tr  @include('Caixa.caixa_includes')   title="clique para mais detalhes">
                    <th category="tab" scope="row" class="text-uppercase" title="@include('Caixa.addsTipoCaixa')">{{$caixas->tipoEpag}} {{$caixas->parcelas > '1' ? $caixas->parcelas.'x' : ''}} </th>
                    <td title="@include('Caixa.addsHistoricoCaixa')" class="text-uppercase" category="tab">{{isset($caixas->cliente) ? $caixas->cliente : (isset($caixas->observacao) ? $caixas->observacao : $caixas->vendedora) }}
                    </td>
                    <td>R$ {{$caixas->valor}}</td>
                    
                 </tr>
                @endforeach
                <!--<td colspan="3" class="table-light"></td>-->
                @endif
               
            
        </tbody>
        </table>

     

     

