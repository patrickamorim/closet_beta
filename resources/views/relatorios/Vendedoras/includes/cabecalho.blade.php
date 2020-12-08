

    <div class="container mt-3">
    
    <div class="border  mb-2 row bg-light" name="divCabecalho">
    
        <form action="{{route('site.relatorios.relatorioVendedores')}}" method="get" name="dataCaixaEnviar" enctype="multipart/form-data"> {{csrf_field()}}
               
        <div class="form-row ml-2  mt-0"> 
            
                <div class="form-group col-md-4">
                <label for="inputAddress1">Data Incial</label>   
                <input type="date"  class="form-control text-center " id="inputAddress1" max="2150-04-30"  name="dataInicial" value="{{old('dataInicial')}}" required >
                </div>
    
                <div class="form-group col-md-4">
                 <label for="inputAddress2">Data Final</label>   
                <input type="date"  class="form-control text-center " id="inputAddress2" max="2150-04-30"  name="dataFinal" value="{{old('dataFinal')}}" required >
                </div>

                  
                <div class="form-group col-md-2">
                    <label for="status">Status</label>   
                    <select class="custom-select bg-light  text-primary  " id="status" name="status" required>
                        <option  class="text-dark" selected value="{{old('status')}}">{{old('status')}}</option>
                        <option class="text-dark"  value="Ativo">Ativo</option>
                        <option class="text-dark"  value="Desativado">Desativado</option>
                        <option class="text-dark"  value="">Todos</option>
                    </select>
                   </div>
            
                
                <div class="mt-2" title="Clique para efetuar a busca">
                <button type="submit" class="btn btn-primary btn  mt-4"> Ir </button>
                </div>
        </div>
        
    
    </form>
    
    
        
    <table class="  text-center table-sm col-md-5 ml-3  mb-1 mt-2 bg-white" >
           
            <tbody>
                   
                <tr>
                    <th scope="row" class="text-dark "> Relatório de vendas por vendedores. </td>
                </tr>
                <tr>
                    <th scope="row" class="text-dark"> <a href="{{route('site.vendedores.cadastrar')}}"class="btn btn-outline-dark">Nova Vendedora</a> </th>
                </tr>
               
            </tbody>
          </table>
      
        
      </div>
    
    </div>