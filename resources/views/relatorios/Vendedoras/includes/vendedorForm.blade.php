
<div class="form-group ">
    <label for="nome">Nome</label>
    <input type="text"  class="form-control  text-uppercase" id="nome" name="nome"{{isset($registro->nome) ? 'readonly' : ''}} value="{{isset($registro->nome) ? $registro->nome : ''}}@if(isset($r) and $r == 'nao'){{old('nome')}}@endif" title="Nome do Vendedor" maxlength="50"required>
  </div>
  <div class="form-group ">
    <label for="rua">Rua</label>
    <input type="text"  class="form-control text-uppercase" id="rua" name="rua"  value="{{isset($registro->rua) ? $registro->rua : ''}}@if(isset($r) and $r == 'nao'){{old('rua')}}@endif"  title="Rua" maxlength="50" required>
  </div>
  <div class="form-row ">
    <div class="form-group col-md-6">
      <label for="cidade">Cidade</label>
      <input type="text"  class="form-control text-uppercase" id="cidade" name="cidade"  value="{{isset($registro->cidade) ? $registro->cidade : ''}}@if(isset($r) and $r == 'nao'){{old('cidade')}}@endif"   title="cidade" maxlength="30" required>
    </div>
    <div class="form-group col-md-3">
      <label for="bairro">Bairro</label>
      <input type="text"  class="form-control text-uppercase" id="bairro" name="bairro"   value="{{isset($registro->bairro) ? $registro->bairro : ''}}@if(isset($r) and $r == 'nao'){{old('bairro')}}@endif"  title="Bairro" maxlength="15" required>
    </div>
    <div class="form-group col-md-2">
      <label for="numero">Número</label>
      <input type="text"  class="form-control text-uppercase" id="numero" name="numero"   value="{{isset($registro->numero) ? $registro->numero : ''}}@if(isset($r) and $r == 'nao'){{old('numero')}}@endif" title="número da casa" maxlength="9" required>
    </div>
    <div class="form-group col-md-2">
      <label for="telefone">Telefone</label>
      <input type="text"  class="form-control" id="telefone" name="telefone"  value="{{isset($registro->telefone) ? $registro->telefone : ''}}@if(isset($r) and $r == 'nao'){{old('telefone')}}@endif"  title="Telefone ex 7734342319" maxlength="10" pattern="[0-9]{10}">
    </div>
    <div class="form-group col-md-2">
      <label for="cel">Celular</label>
      <input type="text" class="form-control number" id="cel" name="celular" value="{{isset($registro->celular) ? $registro->celular : ''}}@if(isset($r) and $r == 'nao'){{old('celular')}}@endif"title="celular ex 77999515416" maxlength="11" pattern="[0-9]{11}" required>
    </div>
    <div class="form-group col-md-4">
      <label for="email">Email</label>
      <input type="email" class="form-control text-uppercase" id="email" name="email"  value="{{isset($registro->email) ? $registro->email : ''}} @if(isset($r) and $r == 'nao'){{old('email')}}@endif"  title="Email" maxlength="50">
    </div>
    <div class="form-group col-md-3">
      <label for="inputAddress2">Nascimento</label>
      <input type="date"  class="form-control" id="inputAddress2" name="nascimento" value="{{isset($registro->nascimento) ? $registro->nascimento : ''}}@if(isset($r) and $r == 'nao'){{old('nascimento')}}@endif" max="2150-04-30" required >
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-5">
      <label for="cpf">CPF</label>
      <input type="text"  class="form-control @if(isset($r) and $r == 'nao') alert-danger @endif" id="cpf" name="cpf"   value="{{isset($registro->cpf) ? $registro->cpf : ''}}@if(isset($r) and $r == 'nao'){{old('cpf')}}@endif" title="CPF: 11 dígitos (apenas números)" maxlength="11" required pattern="[0-9]{11}">
    </div>
    <div class="form-group col-md-5">
      <label for="rg">RG</label>
    <input type="text"  class="form-control" id="rg" name="rg"  value="{{isset($registro->rg) ? $registro->rg : ''}}@if(isset($r) and $r == 'nao'){{old('rg')}}@endif"  title="RG: 10 digitos (apenas números)" maxlength="10" required pattern="[0-9]{10}">
    </div>
  </div>
  <div class="form-group ">
    <label for="obs">Observações</label>
    <textarea type="text"  class="form-control text-uppercase" id="obs" name="observacao"   title="Observações" maxlength="190">{{isset($registro->observacao) ? $registro->observacao : ''}}@if(isset($r) and $r == 'nao'){{old('obs')}}@endif</textarea>
  </div>
  @if(isset($registro->situacaoVendedora))
  <div class="form-row">
    <div class="form-group col-md-4">
    <label for="situacao">Situação</label>
  <select class="custom-select bg-light  text-primary form-group col-md-3" id="situacao" name="situacaoVendedora">
    <option selected>{{isset($registro->situacaoVendedora) ? $registro->situacaoVendedora : ''}}</option>
    <option value="{{($registro->situacaoVendedora) == 'Desativado' ? 'Ativo' : 'Desativado '}}">{{($registro->situacaoVendedora) == 'Desativado' ? 'Ativo' : 'Desativado'}}</option>
  
  </select>
  </div>
 
  </div>
  @endif
  