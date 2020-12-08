<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\caixa;
use App\promissoria;
use App\haver;
use App\itemCaixa;
use App\vendedora;
use Auth;
class caixaController extends Controller
{

    
    public function getCaixa(Request $Req){
       $Req->flush();   
       $Req = $Req->all();
       $caixasDoDia = [1];
       //dd($Req); caixasDoDia
       $vendedores = vendedora::select('id','nome')->where('situacaoVendedora','Ativo')->get(); //COLOCAR AQUI SÓ OS ATIVOS
       $timestamp =  DB::select("select now() as time");
     
        if($Req == null){
         $caixa = caixa::where("status","=","aberto")->with('item_caixas')->get();
         $dateAbertura = $timestamp[0]->time;
        }else if ($Req != null ){

          if(!isset($Req['caixaEscolhido']))
            $caixa = caixa::whereRaw(" date(abertura) = '".$Req['dataCaixa']."'")->with('item_caixas')->orderBy('id', 'desc')->get();
          else if (isset($Req['caixaEscolhido'])){
                if(isset($Req['caixaEscolhido']) and $Req['caixaEscolhido'] != "null")
                $caixa = caixa::whereRaw(" id = ".$Req['caixaEscolhido'])->with('item_caixas')->get();
                if(isset($Req['caixaEscolhido']) and $Req['caixaEscolhido'] == "null")
                $caixa = caixa::whereRaw(" date(abertura) = '".$Req['dataCaixa']."'")->with('item_caixas')->get();
              
                $caixasDoDia = caixa::whereRaw(" date(abertura) = '".$Req['dataCaixa']."'")->with('item_caixas')->orderBy('id', 'desc')->get();
            
          }
         $dateAbertura = $Req['dataCaixa'];
       }

     //  dd($caixa);
;
       if($caixa->count() > 0)
       $item_caixas = caixa::get_item_caixa($caixa); 
       
       
       
      
        return view("Caixa.caixa", compact('timestamp','caixa','item_caixas','dateAbertura','caixasDoDia','vendedores'));

    }

    public function novoCaixa(Request $Req){
    
       $caixas = null;
       $caixa = $Req->all();
       $itenscaixa  = $Req->all();
       $vendedores = vendedora::select('id','nome')->where('situacaoVendedora','Ativo')->get(); //COLOCAR AQUI SÓ OS ATIVOS
       $timestamp =  DB::select("select now() as time"); 
       $caixaAberto = null;
       $caixaAberto = DB::table('caixas')->where("status","=","aberto")->sum("id");
       
      
        if($caixaAberto > 0){
        $caixa = caixa::where("id","=",$caixaAberto)->with('item_caixas')->get();
        $item_caixas = caixa::get_item_caixa($caixa); 

        return view("Caixa.caixa",compact('caixa','timestamp','item_caixas','vendedores'))->with('error','Caixa já aberto, Encerre-o para poder criar um novo !!! ');
        }
    
      
         $caixa = caixa::create($caixa);
         $novoTroco = array('id_caixa' => $caixa->id,'tipoEpag' => 'Troco', 'valor' => $Req->all()['valor'], 'vendedora' => $Req->all()['user']); 
         
         $itemCaixa = itemCaixa::create($novoTroco);
         
        
        $caixa =  caixa::where("id","=",$caixa->id)->with('item_caixas')->get();
        $item_caixas = caixa::get_item_caixa($caixa); 
      

      return view("Caixa.caixa", compact('timestamp','caixa','item_caixas','vendedores'))->with('success','Caixa aberto com sucesso !!! ');

    }


    public function novoMovimento(request $req){
      $vendedores = vendedora::select('id','nome')->where('situacaoVendedora','Ativo')->get(); //COLOCAR AQUI SÓ OS ATIVOS
  
      $mensagem = ['success',' adcionada com sucesso !!! '];
      $timestamp =  DB::select("select now() as time");
        

      $caixa = caixa::where("status","=","aberto")->get();
      $movimento = $req->all();
  
      if(isset($req['vendedora']))
      $vendedornome = vendedora::select('id','nome')->where('id',$req['vendedora'])->first();

      //dd($req['vendedora']);
      //dd($req);
        if( $req['tipoEpag'] == "Saída"){   //deixando quando for saída negativo o valor
          $req['valor'] = $req['valor'] * (-1);
        }


        if( $req['tipoEpag'] == "Saída" or $req['tipoEpag'] == "Entrada" or !isset($req['tipoEpag']))
         $novoTroco = array('id_caixa' => $caixa[0]->id,'tipoEpag' => $req['tipoEpag'], 'valor' => $req['valor'], 'vendedora' => $caixa[0]->user, 'observacao' => $req['observacao']); 
        else
        $novoTroco = array('id_caixa' => $caixa[0]->id,'tipoEpag' =>  $req['tipoEpag'], 'valor' => $req['valor'],'parcelas' => $req['parcelas'] ,'vendedora' => $vendedornome->nome, 'cliente' => $req['cliente'],'id_vendedora' => $req['vendedora'],'numeroPecas' => $req['numeroPecas'], 'observacao' => $req['obs']); 

      
      $caixa = caixa::where("status","=","aberto")->with('item_caixas')->get();
      
     
      $item_caixas = caixa::get_item_caixa($caixa);
  
          if($req['valor'] + $item_caixas->sum('valor') >= 0){
              $itemCaixa = itemCaixa::create($novoTroco);
              $item_caixas = caixa::get_item_caixa($caixa);
              
          }else{
              $mensagem = ["error"," não pode ser adicionado por falta de saldo em caixa !!! "];
          }

      return view("Caixa.caixa",compact('timestamp','caixa','item_caixas','vendedores'))->with($mensagem[0],$req['tipoEpag'].' (R$ '.number_format($req['valor'], 2).')'.$mensagem[1] );

    }

    public function fecharCaixa(request $req){

      //dd($req->userFechamento);
    
      $timestamp =  DB::select("select now()  as time");
     
      $caixa = caixa::where("status","=","aberto")->update(['fechamento' => $timestamp[0]->time,'status' => $req->status,'dinheiro' => $req->dinheiro, 'cartao' => $req->cartao, 'outros' => $req->outros, 'obs' => $req->obs.' - Fechado por ['.$req->userFechamento.']' ]);
      $dateAbertura = $timestamp[0]->time;
      
      
      return view("Caixa.caixa",compact('timestamp','dateAbertura'))->with('success','caixa fechado com sucesso !!! ');
    }

}
