<div class="border border-dark mb-2 row bg-light" name="divDaData">

    <form action="{{route('site.caixa.listar')}}" method="get" name="dataCaixaEnviar" enctype="multipart/form-data"> {{csrf_field()}}
           
    <div class="form-row ml-2  mt-4"> 
        
            <div class="form-group col-md-11'">
            <input type="date"  class="form-control text-center " id="inputAddress2" name="dataCaixa" value="{{$dateAbertura}}" required >
    </div>

        
    </div>

</form>


    
<table class="table border   table-sm col-md-8 ml-5  mt-2" >
       
        <tbody>
               
            <tr>
               
                <td scope="row" class="text-success">Entradas : R$ {{isset($item_caixas) ? number_format($item_caixas->whereIn('tipoEpag', ['Entrada','Troco','HAVER','QUITAÇÃO'])->sum('valor'), 2) : '--'}}</td>
                <td class="text-danger">Saídas : R$ {{isset($item_caixas) ? number_format($item_caixas->where('tipoEpag', 'Saida')->sum('valor'), 2) : '--'}}</td>
                <td class="text-primary">Total : R$ {{isset($item_caixas) ? number_format($item_caixas->sum('valor'), 2) : '--'}}</td>
            </tr>
            <tr>
               
                <td colspan="3" class="text-center"><h5>Nenhum Caixa aberto</h5></td>
                
            </tr>
        </tbody>
      </table>
    </div>