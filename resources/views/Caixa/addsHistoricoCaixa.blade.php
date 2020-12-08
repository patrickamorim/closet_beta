


@if( $caixas->tipoEpag == 'HAVER' or $caixas->tipoEpag == "QUITAÇÃO")
{{$caixas->cliente.' ('.$caixas->formaPag.')'}}

@elseif( $caixas->tipoEpag == 'Entrada' or $caixas->tipoEpag == "Saída" or $caixas->tipoEpag == "Troco")
{{isset($caixas->cliente) ? $caixas->cliente : (isset($caixas->observacao) ? $caixas->observacao : $caixas->vendedora) }}

@elseif($caixas->tipoEpag != 'HAVER' or $caixas->tipoEpag != "QUITAÇÃO"  or $caixas->tipoEpag != "Entrada" or $caixas->tipoEpag  != "Saída")
[VENDA] [ Vendedora: {{$caixas->vendedora}}  {{(isset($caixas->observacao) ) ? '] [ Obs: '.$caixas->observacao : ''}} {{$caixas->observacao == "" ? "Sem observações ]" : " ]"}}

@endif




