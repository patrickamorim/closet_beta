

  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary btn-lg btn-block"  data-toggle="modal" data-target="#exampleModalCenter">
    Nova Compra
  </button>

  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Nova Compra</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">


          <form action="{{route('site.compras.salvar')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}

                
                <label for="situacao">Cliente</label>
                <select class="custom-select bg-light  text-primary form-group col-md-3" id="situacao" name="id_cliente" required>
             
                

                @if(isset($registros))
                @foreach($registros as $registro)
                <option value="{{ $registro->id}}" selected>{{$registro->nome}}</option>
                @endforeach
              
                @endif


                </select>
                    

                  <div class="form-row">
                    <div class="form-group col-md-5">
                      <label for="inputAddress2">Data Promissória</label>
                      <input type="date"  class="form-control" id="inputAddress2" name="data" value="" max="2150-04-30" required >
                    </div>
                    <div class="form-group col-md-5">
                        <label for="inputAddress2">Vencimento</label>
                        <input type="date"  class="form-control" id="inputAddress2" name="dataVencimento" value="" max="2150-04-30" required >
                      </div>
                      <div class="form-group col-md-2">
                        <label for="valor">Nº Peças</label>
                        <input type="number"  class="form-control" id="telefone" name="numeroPecas"  step="1" value="" min="1" title="valor Total" required >
                      </div>
                    </div>

                  

                    <div class="form-row" name="divDaTabela">
                      <div class="form-group col-md-5" title="Selecione o(a) Vendedor(a)">
                        <label for="movimento" >Vendedor(a)</label>
                        <select class="custom-select bg-light  text-primary form-group col-md-2" id="vendedoraNovaVenda" name="id_vendedora" required>
                          <option disabled class="text-dark" selected ></option>

                          @if(@isset($vendedores))
                          @foreach ($vendedores as $vendedor)
                             <option class="text-dark"  value="{{$vendedor->id}}">{{$vendedor->nome}}</option> 
                          @endforeach
                          @endif
                      
                        </select>
                      </div>
                            <div class="form-group col-md-3">
                              <label for="valor">Valor</label>
                              <input type="number"  class="form-control" id="telefone" name="valor" category="valorNovaCompra" step="0.01" value=""  title="valor Total" required >
                            </div>
                            <div class="form-group col-md-2">
                            <label for="parcelas">Parcelas</label>
                            <select class="custom-select bg-light  text-primary form-group col-md-3" id="parcelas" name="parcelas" required>
                            <option selected></option>

                            <option value="1">1</option>
                              <option value="2">2</option>
                                <option value="3">3</option>
                                  <option value="4">4</option>
                                    <option value="5">5</option>
                                      <option value="6">6</option>
                                         <option value="7">7</option>
                                        </select>
                            </div>
                           
                    </div>
    
        </div>
        <div class="modal-footer">
          <button type="submit" category="loading" class="btn btn-primary">Salvar</button>
            <button type="reset" class="btn btn-primary" title="Limpar todos os campos">Limpar</button>
            <button data-dismiss="modal" id="loading" class="btn btn-danger">Cancelar</button>
          </form>

        </div>
      </div>
    </div>
  </div>
