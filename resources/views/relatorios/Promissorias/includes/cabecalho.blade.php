

    <div class="container mt-3">
    
    <div class="border border-dark mb-2 row bg-light" name="divCabecalho">
    
        <form action="{{route('site.relatorios.relatorioPromissorias')}}" method="get" name="dataCaixaEnviar" enctype="multipart/form-data"> {{csrf_field()}}
               
        <div class="form-row ml-2  mt-0"> 
            
                <div class="form-group col-md-11'">
                <label for="inputAddress1">Data Incial</label>   
                <input type="date"  class="form-control text-center " id="inputAddress1" max="2150-04-30"  name="dataInicial" value="{{old('dataInicial')}}" required >
                </div>
    
                <div class="form-group col-md-11'">
                 <label for="inputAddress2">Data Final</label>   
                <input type="date"  class="form-control text-center " id="inputAddress2" max="2150-04-30"  name="dataFinal" value="{{old('dataFinal')}}" required >
                </div>
                
                <div class="mt-2" title="Clique para efetuar a busca">
                <button type="submit" class="btn btn-primary btn  mt-4"> Ir </button>
                </div>
        </div>
        
    
    </form>
    
    
        
    <table class="  text-center table-sm col-md-6 ml-5  mb-1 mt-2 bg-white" >
           
            <tbody>
                   
                <tr>
                    <tH scope="row" class="text-dark "> Relatório dos lançamentos de promissórias. </td>
                </tr>
                <tr>
                    <tH scope="row" class="text-primary"> Atenção, as datas definidas dizem respeito a data de LANÇAMENTO DAS PROMISSÓRIAS !!!</td>
                </tr>
               
            </tbody>
          </table>
      
        
      </div>
    
    </div>