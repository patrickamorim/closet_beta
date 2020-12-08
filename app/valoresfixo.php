<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class valoresfixo extends Model
{
    protected $fillable=[

        'id','juros', 'mesesParaCobrar','fonte','comissao',
    ];
}
