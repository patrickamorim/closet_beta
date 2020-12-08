<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class promissoria extends Model
{
  protected $fillable = [
      'id','data','valor','status','parcelas','id_cliente','vendedora','numeroPecas','id_vendedora',
  ];

  public function clientes()
  {
      return $this->belongsTo(cliente::class, 'id_cliente');
  }

  public function havers()
  {

      return $this->hasMany(haver::class, 'id_promissoria');
  }
  public function datasP()
  {

      return  $this->hasMany(dataP::class,'id_promissoria');
  }

  public function juros()
  {

      return $this->hasMany(juro::class, 'id_promissorias');
  }

  public function vendedoras()
  {
      return $this->belongsTo(vendedora::class, 'id_vendedora');
  }
}
