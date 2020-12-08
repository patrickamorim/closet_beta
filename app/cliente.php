<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
  protected $fillable = [
      'id','cpf','situacao','nome',
      'observacao','rg','nascimento',
      'rua','cidade','bairro',
      'numero','telefone','celular','email','limite',
  ];

  public function promissorias()
  {
      return $this->hasMany(promissoria::class, 'id_cliente')->orderBy('data','desc');
  }


  public static function busca($nome)

  {
    if($nome == null)
    return static::paginate(10);
   // $nome = "";
    return static::where('nome','LIKE','%'.$nome.'%')->orWhere('cpf','LIKE','%'.$nome.'%')->orWhere('observacao','LIKE','%'.$nome.'%')->orderBy('nome','asc')->paginate(10);
  }

  public function join(){
return  $this->hasMany('cliente')
      ->join('promissorias', 'promissorias.id_cliente', '=', 'cliente.id')
      ->select('cliente.nome', 'promissorias.status', 'promissorias.parcelas')
      ->get();
    }



}
