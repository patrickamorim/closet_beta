<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class itemCaixa extends Model
{
    protected $fillable = [

       'id','valor','tipoEpag','time','id_caixa','vendedora','observacao','numeroPecas','cliente','parcelas','id_vendedora'

    ];



    public function Caixas()
    {
        return $this->belongsTo(Caixa::class, 'id_caixa')->orderBy('abertura','desc');
    }

    public function vendedoras()
    {
        return $this->belongsTo(vendedora::class, 'id_vendedora');
    }
}
