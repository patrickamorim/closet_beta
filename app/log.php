<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class log extends Model
{
    //
    protected $fillable=[

      'id','usuario','acao','timestamp',
    ];
}
