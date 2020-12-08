

  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary btn-block " data-toggle="modal" data-target="#exampleModalCenter">
    ABRIR CAIXA
  </button>

  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title " id="exampleModalLongTitle text-center">Abrir Caixa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">


         
         
         
          
                  <div class="form-row ml-3">
                    <div class="form-group col-md-11">
                      <label for="inputAddress2">Abertura</label>
                    <input type="datetime-local"  class="form-control" id="inputAddress2" name="abertura" value="{{ date( 'Y-m-d\TH:i' , strtotime($timestamp[0]->time))}}"  readonly >
                    </div>
                </div>
                    <div class="form-row  ml-3">  
                    <div class="form-group col-md-6">
                        <label for="inputAddress2">Usuário</label>
                    <input type="text"  class="form-control" id="inputAddress2" name="user" value="{{isset(Auth::user()->name) ? Auth::user()->name : ''}} " required maxlength="25" @if(isset(Auth::user()->name)) readonly @endif>
                      </div>
                      
                        <div class="form-group col-md-5">
                            <label for="valor">Troco</label>
                            <input type="number"  class="form-control" id="telefone" name="valor"  step="0.01" value=""  title="valor Entrada (Troco)" required  >
                        </div>

                    </div>
                       

               

        </div>
        <div class="modal-footer">
          
           <button type="submit" class="btn btn-primary">Salvar</button>
          </form>  
            <a href=""class="btn btn-danger" data-dismiss="modal">Cancelar</a>
             

        </div>
      </div>
    </div>
  </div>
