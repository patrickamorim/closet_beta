

@if(isset($caixas))
{{date( 'H:i', strtotime($caixas->created_at))}}h {{($caixas->tipoEpag == ("AQUIÉHAVER") ) ? $caixas->formaPag : ''}}

@endIf
