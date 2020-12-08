 <!-- Button trigger modal -->
 <!-- Button trigger modal -->



 
 <button  category="NovaVenda" type="button" class="btn btn-outline-dark"  data-toggle="modal" data-target="#NovaC" {{$caixa[0]->status != 'aberto' ? 'disabled' : ''}} >
  Nova Venda
</button>

<!-- Modal -->
<div class="modal fade" id="NovaC" category="ajax-modal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered" role="document">
   <div class="modal-content">
     <div class="modal-header">
      <h4 class="modal-title " id="exampleModalLongTitle"><h2 class=" text-center ">Nova Venda</h2></h4>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>
     <div class="modal-body "  align="left" category="divNovaVenda">

    
   
   
           <form action="{{route('site.caixa.novoMovimento')}}" method="post" name="submiterNovaVenda" enctype="multipart/form-data">
               {{csrf_field()}}
             
        <div class=" " >

        <div align="right">
          <div class="form-group col-md-5" title="Momento da compra">
           
          <input type="text"  hidden   class="form-control" id="dataaa" name="dataVenda" value="{{ date('d/m/Y - H:i ', strtotime($timestamp[0]->time))}}"  readonly >
          </div>
        </div>
            <div class="container border mt-3 " title="Selecione a foma de pagamento">
           
              <label for="movimento"><h6>Forma de Pagamento</label>
                <div id="opcoesCompra" class="form-group row mt-2">
                 
                    <div class="">
                      <input class="ml-3" type="radio" name="tipoEpag" category="tipoEpag" id="opcao1" value="Dinheiro" required>
                      <label class="" for="inlineRadio1">Dinheiro </label>
                    </div>
                    <div class="">
                      <input class="ml-2" type="radio" name="tipoEpag" category="tipoEpag" id="opcao2" value="Cartão" required>
                      <label class="" for="inlineRadio2">Cartão</label>
                    </div>
                    <div class="">
                      <input class="ml-2" type="radio" name="tipoEpag" category="tipoEpag" id="opcao3" value="promissoria"  required>
                      <label class="" for="inlineRadio3">Promissoria</label>
                    </div>
                    <div class="">
                      <input class="ml-2" type="radio" name="tipoEpag" category="tipoEpag" id="opcao4" value="outros" required >
                      <label class="" for="inlineRadio3">Outros</label>
                    </div>
                    <div class="col-sm-9">
                      <input class="form-control form-control" maxlength="25" type="text" category="tipoEpag" id="outrosSelect" required title="Preencha com uma forma de pagamento alternativa" name="tipoEpag" placeholder="ex: Cheques, títulos, vales, acordos " hidden disabled>
                    </div>
                </div>
              </div> 

              <div class="container border mt-3 " >

                    <div class="form-group col-md-12" title="Nome do Cliente">
                      <label for="clienteCompra">Cliente</label>
                      <input type="text"  class="form-control text-uppercase"   title="Nome do Cliente" id="clienteCompra" name="cliente" value="" required maxlength="50">
                    </div>

                    <div class=" row">
                    <div class="form-group col-md-6 ml-5" title="Selecione o(a) Vendedor(a)">
                      <label for="movimento" >Vendedor(a)</label>
                      <select class="custom-select bg-light  text-primary form-group col-md-2" id="vendedoraNovaVenda" name="vendedora" required>
                        <option disabled class="text-dark" selected ></option>

                            @foreach ($vendedores as $vendedor)
                            <option class="text-dark"  value="{{$vendedor->id}}">{{$vendedor->nome}}</option>
                            @endforeach
                 
                      </select>
                      
                    </div>
                    <div category="valorH" class="form-group col-md-3 " title="Número total de peças da compra">
                      <label for="inputAddress2">Nº Itens</label>
                      <input type="number"  class="form-control"  id="inputAddress2" name="numeroPecas" category="numeroPecas"  pattern="[0-9]" min="1" max ="99999" required>
                    </div>
                  </div>
                  
                  <div category="divGerarCaixa" class="form-group row float-right" >
                    <div  class="form-group col-md-4 ml-5 ">
                      <label for="inputAddress2">Valor Total</label>
                      <input type="number"   class="form-control" step="0.01"id="inputAddress2" name="valor" category="valorVenda"   min="0.01" max ="99999" title="Valor total da compra" required>
                    </div>
                  
                    <div name="divParcelas" class="form-group col-md-3" >
                      <label for="parcelas">Parcelas</label>
                      <select class="custom-select bg-light  text-primary form-group col-md-3" id="parcelas"   name="parcelas" required >
                      <option value="1" selected>1</option>

                        <option value="2">2</option>
                          <option value="3">3</option>
                            <option value="4">4</option>
                              <option value="5">5</option>
                                <option value="6">6</option>
                                  <option value="7">7</option>
                                    <option value="8">8</option>
                                      <option value="9">9</option>
                                        <option value="10">10</option>
                                          <option value="11">11</option>
                                            <option value="12">12</option>
                                  </select>
                      </div>

                      

                      <div  class="form-group col-md-3">
                        <label for="GerarVenda"></label>
                        <button type="button"  class="btn btn-success btn-sm mt-2 "   data-toggle="tooltip" data-placement="top" title="Clique aqui para gerar o resumo da compra" name="gerarVenda">Gerar Venda</button>
                        
                      </div>

                   

                  </div>

                    <div class="text-left " title="Descreva informações importantes sobre a compra como: Se é presente, possível troca, descrição de itens, etc.">
                      <label for="observacao">Observações sobre a Venda</label>
                      <textarea type="text"  class="form-control" id="obss" name="obs"    maxlength="140" required></textarea>
                    </div>

                   

              </div> 
                
        </h6>
        </div>
           <div class="modal-footer float-right">
             <button type="button" class="btn btn-warning text-light"  name="resetarCompra" title="Limpar todos os campos" hidden>Resetar Valores</button>
             <button type="button" name="buttonSalvarCompra" class="btn btn-primary"  >Salvar Compra</button>
             <button type="button" class="btn btn-danger mr-auto " name="cancelarFechamento" data-dismiss="modal">Cancelar</button>
           </div>  
             </form>
   
           </div>
         </div>
       </div>
     </div>
   