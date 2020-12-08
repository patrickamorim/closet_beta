<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dataP extends Model
{
    protected $fillable=
    [
      'id','datasP','valorParcela','id_promissoria','mesesAtrasado','situacao',
    ];


    public function promissoria()
    {
        return $this->belongsTo(promissoria::class, 'id_promissoria');
    }

    public function juros()
    {

        return $this->hasMany(juro::class, 'id_data_ps');
    }


}
