
  <!-- Button trigger modal -->
 <!-- Button trigger modal -->
 <button  category="fecharCaixa" type="button" class="btn btn-outline-dark"  data-toggle="modal" data-target="#fecharC">
   {{$caixa[0]->status != 'aberto' ? 'Resumo do Caixa' : 'Fechar Caixa'}}
</button>

<!-- Modal -->
<div class="modal fade" id="fecharC" category="ajax-modal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLongTitle"><h2 class="text-center">Enceramento do Caixa</h2></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body " category="divFechamento">
    
    
            <form action="{{route('site.caixa.fecharCaixa')}}" method="post" name="submiterCaixa" enctype="multipart/form-data">
                {{csrf_field()}}
              
             
                <div class="form-row  float-right" >
                    <div class="form-group col-md-4 mr-3" >
                    <input type="text"  class="form-control-sm text-center bg-light" id="inputuser" name="userFechamento" title="Aberto por: " value="{{$caixa[0]->user}}" required maxlength="25"  readonly>
                    </div>
                    <div class="form-group col-md-7 ">
                        <input type="text"  class="form-control-sm text-center bg-light" id="inpudata" name="fechamentoTime" value="{{ date( 'd/m/Y - H:i' , strtotime($timestamp[0]->time))}}"  disabled >
                    </div>
                  </div>
          
                    
                <div class="container "name="tabelaResumo">  
       
                  <table class="table table-sm table-bordered  table-hover table-striped " id="tabelaResumo" >
                      <thead class="table-dark">
                        <td colspan="2">Resumo do Caixa</td>
                        </thead>
                      <tbody>
                        <tr>
                          <th scope="row ">Entradas + Troco</th>
                          <td>R$ <span category="entradas">{{number_format($item_caixas->whereIn('tipoEpag', ['Entrada','Troco'])->sum('valor'), 2)}}</span></td>
                         
                        </tr>
                        <tr>
                          <th scope="row">Saídas</th>
                          <td>R$ <span category="saidas">{{number_format($item_caixas->where('tipoEpag', 'Saída')->sum('valor'), 2)}}</span></td>
                        
                        </tr>
                        <tr>
                          <th scope="row">Vendas/Havers em Espécie</th>
                          <td>R$ <span category="vDinheiro">{{number_format($item_caixas->where('formaPag','Dinheiro')->sum('valor'), 2)}}</span></td>
                        </tr>
                        <tr>
                          <th scope="row">Vendas/Havers em Cartão</th>
                          <td>R$ <span category="Vcartao">{{number_format($item_caixas->where('formaPag','Cartão')->sum('valor'), 2)}}</span></td>
                        </tr>
                        <tr>
                          <th scope="row">Vendas/Havers Outros</th>
                        <td>R$ <span category="vOutros">{{number_format($item_caixas->where('formaPag','!=','Cartão')->where('formaPag','!=','Dinheiro')->where('formaPag','!=','Troco')->where('formaPag','!=','Entrada')->where('formaPag','!=','Saída')->sum('valor'), 2)}}</span></td>
                        </tr>
                        <tr>
                          <th scope="row">Total Havers</th>
                          <td>R$ <span category="havers">{{number_format($item_caixas->whereIn('tipoEpag', ['HAVER','QUITAÇÃO'])->sum('valor'), 2)}}</span></td>
                        </tr>
                      <tr class="{{$item_caixas->sum('valor') < 0 ? 'text-danger' : ''}}">
                          <th scope="row">Subtotal do Caixa</th>
                          <td><b>R$ <span category="totalDoCaixa">{{number_format($item_caixas->sum('valor'), 2)}}</span></b></td>
                        </tr>
                        <tr>
                          <th scope="row">Total em Saldos</th>
                          <td>R$ <span category="totalSaldos">{{$caixa[0]->status != 'aberto' ? number_format($caixa[0]->dinheiro+$caixa[0]->cartao+$caixa[0]->outros, 2) : ''}}</span></td>
                        </tr>
                        <tr category="rowfechamento" title="Total do valor do caixa menos o valor total do saldo adicionado">
                          <th scope="row" >Saldo Fechamento</th>
                          <td><b>R$ <span category="sadoFechamento">{{$caixa[0]->status != 'aberto' ? number_format($item_caixas->sum('valor')-$caixa[0]->dinheiro+$caixa[0]->cartao+$caixa[0]->outros, 2) : ''}}</span></b></td>
                        </tr>
                      </tbody>
                    </table>    
                  </div>  
                    
                  @if($caixa[0]->status != 'aberto')
                  <h3 name='fechamento' class=''>{{$caixa[0]->status}}</h3>
                  @endif

                  <div class="border container form-row float-right" align="left">
                    <div class="form-group col-md-3">
                      <label for="dinheiro">Dinheiro</label>
                    <input type="number"  class="form-control" id="dinheiro" name="dinheiro"  step="0.01"   value="{{isset($caixa[0]->dinheiro) ? $caixa[0]->dinheiro : ''}}"  min="0" title="Valor total em espécie" required  >
                    </div>
                    <div class="form-group col-md-3">
                      <label for="cartao">Cartão</label>
                      <input type="number"  class="form-control" id="entrada" name="cartao"  step="0.01"   value="{{isset($caixa[0]->cartao) ? $caixa[0]->cartao : ''}}"  title="Valor total em cartão" required  >
                    </div>
                    <div class="form-group col-md-3">
                      <label for="outros">Outros</label>
                      <input type="number"  class="form-control" id="entrada" name="outros"  step="0.01"   value="{{isset($caixa[0]->outros) ? $caixa[0]->outros : ''}}"  title="Outras formas de Pagamentos" required  >
                    </div>
                    <input type="text"  class="form-control" id="entrada" name="status" hidden   value="" >
                    
                    <div class="form-group col-md-3">
                      <label for="aa"></label>
                      <button type="button" category="adicionarSaldos" class="btn btn-success btn-sm mt-2" {{$caixa[0]->status != 'aberto' ? 'disabled' : ''}} name="aa">Adicionar Saldos</button>
                      
                    </div>

                  </div>  

                    <div class="text-left ">
                      <label for="observacao">Observações</label>
                      <textarea type="text"  class="form-control text-uppercase" id="obs" name="obs"   title="Observações sobre o Caixa"  maxlength="160" required>{{isset($caixa[0]->obs) ? $caixa[0]->obs : ''}}</textarea>
                    </div>

                
    
                   
           
            <div class="modal-footer float-right">
              <button type="button" class="btn btn-warning text-light"  name="resetarValores" title="Limpar todos os campos" hidden>Resetar Valores</button>
              <button type="button" name="buttonFechar" class="btn btn-primary" disabled >Fechar Caixa</button>
              <button type="button" class="btn btn-danger mr-auto " name="cancelarFechamento" data-dismiss="modal">Cancelar</button>
            </div>  
              </form>
    
            </div>
          </div>
        </div>
      </div>
    