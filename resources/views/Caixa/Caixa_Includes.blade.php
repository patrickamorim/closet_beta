@if($caixas->tipoEpag == 'Entrada')
class="table-success h6"
@endif

@if($caixas->tipoEpag == 'Saída' )
class="table-danger h6"

@else
class="h6"
@endif