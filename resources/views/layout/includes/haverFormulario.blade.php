

  <!-- Button trigger modal -->
  <button  type="button" class="btn btn-primary"  data-toggle="modal" data-target="#{{$promissoria->id}}" {{isset($promissorias->status) == 'aberta' ? 'disabled' : ''}}>
    Novo Haver
  </button>

  <!-- Modal -->
  <div class="modal fade" id="{{$promissoria->id}}" category="ajax-modal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title " id="exampleModalLongTitle"><h2 class="border border-bottom text-center ">{{$promissoria->clientes->nome}}</h2></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body ">

          <div category="doHaver" class="container ">

              <form action="{{route('site.compras.haver')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}

                <input type="hidden" name="id_cliente" value="{{$promissoria->id_cliente}}">
                <input type="hidden" name="id_promissoria" value="{{$promissoria->id}}">


                <div class="container mr-auto">
                    <h4 class="border-bottom text-md-right ">Valor Parcelas {{$promissoria->datasP->max('valorParcela')." "  }} R$  </h1>
                </div>
                <div class="container mr-auto">
                    <input type="hidden"  class="form-control"  name="valorRestante" value="{{$promissoria->valor+$promissoria->juros->sum('valor')-$promissoria->havers->sum('valor')}}"  >    
                    <h4  class="border-bottom text-md-right ">Restante Total: {{$promissoria->valor+$promissoria->juros->sum('valor')-$promissoria->havers->sum('valor')}} R$  </h1>
                </div>





                  <div class="form-row mr-auto">
                    <div class="form-group col-md-5">
                      <label for="inputAddress2">Data Haver</label>

                      @if(Auth::user()->funcao == "administrador")
                      <input type="date"  class="form-control" id="inputAddress2" name="dataP" value="{{date( 'Y-m-d')}}" max="2150-12-30" min="2000-01-01" required >
                      @else
                      <input type="date" readonly class="form-control" id="inputAddress2" name="dataP" value="{{date( 'Y-m-d')}}" required >
                      @endif

                      <input type="text" hidden class="form-control" id="inputAddress3" name="status" value="HAVER" required >
                    </div>
                    <div category="valorH" class="form-group col-md-3  ">
                        <label for="inputAddress2">Valor Haver</label>
                        <input type="number"   class="form-control" step="0.01"id="inputAddress2" name="valor" category="valorH"   min="0.01" max ="99999" required>
                     
                      </div>
                      <div class="form-group col-md-4">
                        <label for="parcelas">Meio Pagamento</label>
                        <select class="custom-select bg-light  text-primary form-group col-md-3" id="parcelas" name="formaPag" required>
                        <option selected></option>

                        <option value="Dinheiro">Dinheiro</option>
                          <option value="Cartão">Cartão</option>
                            <option value="Outros">Outros</option>
                          
                                    </select>
                        </div>

                    </div >


                           
                      

                      <div class="container form-row " >

                 

                         <button category="haverGerar"  type="button" class="btn btn-secondary mr-auto mb-5" >Gerar Haver</button>
                         
                         <div class="mr-auto ">
                         <div class="container"title="Selecione e clique em 'Gerar Haver' para pagamento total da promissória">
                            <input  class="form-check-input bg-dark " type="checkbox" value="" id="pagamentoTotal">Pagamento Total
                          </div>  
                         </div>  

                       </div>    
                     
                    
                    

                    <div id ="msg">
                     
                   
                    
                    </div>


                    

              </div>
                      <meta name="_token" content="{{csrf_token()}}" />




        </div>
        <div class="modal-footer">
          <button type="submit" category="loading" class="btn btn-primary" id = "salvar" disabled>Salvar</button>
     
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          </form>
  
        </div>
      </div>
    </div>
  </div>
