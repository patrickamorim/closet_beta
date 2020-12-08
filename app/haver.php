<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class haver extends Model
{

    public $timestamps = false;
    protected $fillable =
    [
    'id','valor','dataP','formaPag','dataRecebido','id_promissoria','status'
    ];


    public function promissorias()
    {
        return $this->belongsTo(promissoria::class, 'id_promissoria' );
    }

    



}
