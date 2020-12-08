

  <!-- Button trigger modal -->
  <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target=".bbd-example-modal-sm" {{$caixa[0]->status != 'aberto' ? 'disabled' : ''}}>
    Novo Entrada/Saída
  </button>

  <!-- Modal -->
  <div class="modal fade bbd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Movimento do Caixa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">


        <form action="{{route('site.caixa.novoMovimento')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}

           
              

                  <div class="form-row text-left">
                    <div class="form-group col-md-6">
                    <label for="movimento">Tipo Movimento</label>
                    <select class="custom-select bg-light  text-primary form-group col-md-2" id="movimento" name="tipoEpag" required>
                      <option selected disabled></option>
                      <option value="Entrada">Entrada</option>
                      <option value="Saída">Saída</option>
                    </select>
                    </div>
                    <div class="form-group col-md-5">
                      <label for="valor">Valor</label>
                      <input type="number"  class="form-control" id="telefone" name="valor"  step="0.01" value="" min="0" title="valor Total" required >
                    </div>
                  </div>

                  <div class="text-left ">
                    <label for="observacao">Observações</label>
                    <textarea type="text"  class="form-control" id="obsN" name="observacao"   title="Observações a respeito do novo movimento" maxlenght="170" required ></textarea>
                  </div>


       
        <div class="modal-footer float-right">
          <button type="submit" class="btn btn-primary" >Salvar</button>
          <button type="button" class="btn btn-danger mr-auto " name="cancelarR" data-dismiss="modal">Cancelar</button>
        </div>  
          </form>

        </div>
      </div>
    </div>
  </div>
