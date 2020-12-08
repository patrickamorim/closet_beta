<div class="container bg-light mt-3 mb-3"  >

<h2 class="text-center">Configurações</h2>

<div class="mt-5 ml-5 " >
<div class="form-group row">
    <label for="juros" class="col-sm-1 col-form-label">Juros</label>
    <div class="col-sm-3">
      <input type="number" class="form-control ml-5" name="juros" id="juros" min="0" step="0.01" value="{{$valoresFixo->juros}}" required disabled>
    </div>
  </div>
  <div class="form-group row">
    <label for="mesesParaCobrar" class="col-sm-1 col-form-label">Carência</label>
    <div class="col-sm-3">
      <input type="number" class="form-control ml-5" id="mesesParaCobrar"  name="mesesParaCobrar" id="juros" min="0" step="1" value="{{$valoresFixo->mesesParaCobrar}}" required disabled>
    </div>
  </div>
  <div class="form-group row">
    <label for="fonte" class="col-sm-1 col-form-label">Fonte</label>
    <div class="col-sm-3">
      <input type="number" class="form-control ml-5" id="fonte"  name="fonte" id="juros" min="1" max="3" step="1" value="{{$valoresFixo->fonte}}" required disabled>
    </div>
  </div>
  <div class="form-group row">
    <label for="comissao" class="col-sm-1 col-form-label">Comissão</label>
    <div class="col-sm-3">
      <input type="number" class="form-control ml-5" id="comissao"  name="comissao" id="comissao" min="0" step="0.01" value="{{$valoresFixo->comissao}}" required disabled>
    </div>
  </div>
</div>

<button disabled type="submit" id="salvar" title="Clique primeiro em Editar para modifcar os valores" class="btn btn-primary ml-5 mt-2 mb-3">Salvar</button> <button  type="button" id="editar" class="btn btn-gray ml-2 mt-2 mb-3">Editar</button> 

</div>  