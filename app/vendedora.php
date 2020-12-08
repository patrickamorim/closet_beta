<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vendedora extends Model
{
    protected $fillable = [
        'id','cpf','situacao','nome',
        'observacao','rg','nascimento',
        'rua','cidade','bairro',
        'numero','telefone','celular','email','limite','situacaoVendedora',
    ];

    public function promissorias()
  {
      return $this->hasMany(promissoria::class, 'id_vendedora')->orderBy('created_at','desc');
  }

  public function itemCaixas()
  {
      return $this->hasMany(itemCaixa::class, 'id_vendedora')->orderBy('created_at','desc');
  }
  
  
}
