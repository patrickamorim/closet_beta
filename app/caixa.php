<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class caixa extends Model
{
    //
    protected $fillable = [

        'id','abertura','fechamento','status','obs','user', 'dinheiro', 'cartao', 'outros', 
    ];

    public function item_caixas()
    {
        return $this->hasMany(itemCaixa::class, 'id_caixa')->orderBy('time','desc');
    }

    public static function get_item_caixa($caixa)
    {
          $item_caixas = null;
          $caixa = $caixa[0];

          if(isset($caixa) and $caixa->fechamento == null)
          $caixa->fechamento = date( 'Y-m-d H:i:s' ,  strtotime( '+6 months'  ,strtotime($caixa->abertura)));
      
          if(isset($caixa)){
        $item_caixas = collect(DB::select("select * from (select id, valor, tipoEpag, time, vendedora, observacao, id_caixa, created_at, tipoEpag as formaPag, cliente, parcelas
      from item_caixas 
      where id_caixa =" . $caixa->id ."
     
      union all

      select h.id as id, h.valor as valor, h.status, h.dataRecebido as dataRecebido, c.nome, null, h.id_promissoria as id_promissoria, h.dataRecebido as dataRecebido, h.formaPag as formaPag, c.nome as cliente, null
      from havers h
      join promissorias p on h.id_promissoria = p.id
      join clientes c on c.id = p.id_cliente
      where h.dataRecebido between '" . $caixa->abertura . "' and '" .$caixa->fechamento ."' ) 
      S 
      order by created_at desc ;"));
          }  

          //dd( $item_caixas->sum('valor'));
      return $item_caixas ;
    }

    public static function get_Vendas_vendedoras($dataInicial, $dataFinal, $status)
    {
 
        $item_caixas = collect(DB::select("select * from (select ic.id, ic.valor, ic.time, ic.vendedora, ic.created_at, ic.numeroPecas, ic.tipoEpag, v.id as id_vendedora, v.situacaoVendedora
      from item_caixas  ic
      join vendedoras v
      on v.nome = ic.vendedora

      where v.situacaoVendedora like '%".$status."%' and ic.time between '" . $dataInicial . " 00:00:00' and '" .$dataFinal ." 23:59:59' and tipoEpag <> ('Saída') and tipoEpag <> ('Troco') and tipoEpag <> ('Entrada')
     
      union all

      select p.id as id, p.valor as valor , p.created_at as time, p.vendedora as vendedora, p.created_at as created_at, p.numeroPecas as numeroPecas, p.status, v.id as id_vendedora, v.situacaoVendedora
      from promissorias p
       join vendedoras v
      on v.nome = p.vendedora
      where v.situacaoVendedora like '%".$status."%' and p.created_at between '". $dataInicial ." 00:00:00' and '".$dataFinal ." 23:59:59'  
      
      union 

      select null, null, null, v.nome, null, null, null, v.id, v.situacaoVendedora
      from vendedoras v
      where NOT EXISTS ((select p.id_vendedora from promissorias p where  p.id_vendedora = v.id))  and NOT EXISTS (select i.id_vendedora from item_caixas i where  i.id_vendedora = v.id)
      AND v.situacaoVendedora like '%".$status."%'
      )
      
      s 
      order by vendedora ;"));
         

      
          //dd($item_caixas);
      return $item_caixas ;
    }



}
