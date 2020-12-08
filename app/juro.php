<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class juro extends Model
{

    protected $fillable=[

        'id','data','valor','referencia','id_data_ps','id_promissorias','situacao',
    ];

    public function promissorias()
    {
        return $this->belongsTo(promissoria::class, 'id_promissoria');
    }

}
