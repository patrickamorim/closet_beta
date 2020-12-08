<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\promissoria;
use App\cliente;
use App\dataP;
use App\haver;
use App\juro;
use App\caixa;
use App\vendedora;
use App\valoresfixo;
use Illuminate\Support\Facades\Mail;
use App\mail\MailPrimeiro;
use DB;
use reponse;

class comprasController extends Controller
{


     

      public function MesesAtrasados(){
        //fazer esse para atualizar a ficha dfe cada cliente individualmente
      }



      public function listarCompras()
      {
        $caixa = caixa::where("status","=","aberto")->count();

          $promissorias = promissoria::where('id_cliente','>=',1)->orderBy('data','desc')->with('datasP')->with('havers')->with('juros')->with('clientes')->get();

          $haverTotal = $promissorias;
          

          //treixo dos meses atrasados:

              

              $datasP = DB::select('select * from data_ps where timestampdiff(month,datasP,curdate())>0 and situacao = "aberta" ');

              
                  foreach ($datasP as $datasPs) {
                    

                       $diasAtraso = DB::table('data_ps')->selectRaw('timestampdiff(month,datasP,curdate()) as dias')->where( 'id' ,'=',$datasPs->id )->get();
                                                                    //datediff(CURDATE(),datasP)/30 as dias    MUDOU AQUI POR ULTIMO
                            foreach ($diasAtraso as $diasAtrasos) {
                                $datasPs->mesesAtrasado= $diasAtrasos->dias; 
                                $arrayDataPs = array('id' => $datasPs->id, 'datasP' => $datasPs->datasP,'situacao' => $datasPs->situacao,
                                'mesesAtrasado' => $datasPs->mesesAtrasado,'valorParcela' => $datasPs->valorParcela,'id_promissoria' => $datasPs->id_promissoria);   
                                datap::find($datasPs->id)->update($arrayDataPs);  
                       
                            }

                     
                  }

        



      //  $promissorias = promissoria::paginate(10);
         $registros = cliente::all();

        return view('compras.listarCompras',compact('promissorias','registros','caixa'));
      }


      public function listarComprasClientes($id)
      {
        $caixa = caixa::where("status","=","aberto")->count();
        $idset = $id; //para dessetar os links
        $vendedores = vendedora::select('id','nome')->where('situacaoVendedora','Ativo')->get(); //COLOCAR AQUI SÓ OS ATIVOS

    

        //lista de parcelas atradas
    $parcelas =   DB::table('data_ps','promissorias')->select('data_ps.id','promissorias.id_cliente','data_ps.id_promissoria','data_ps.datasP','data_ps.mesesAtrasado' )
    ->join('promissorias', 'promissorias.id', '=', 'data_ps.id_promissoria')
    ->join('clientes', 'clientes.id', '=', 'promissorias.id_cliente')->where('promissorias.id_cliente','=',$idset)->where('data_ps.situacao','=','aberta')
    ->orderBy('data_ps.datasP','asc')->get();    
    //dd($parcelas);
    
    $promissorias = promissoria ::where('id_cliente','=',$idset)->orderBy('data','desc')->with('datasP')->with('havers')->with('juros')->with('clientes')->get();

    //treixo dos meses atrasados:

    foreach ($promissorias as $promissoria) {    
      $datasP = DB::select('select * from data_ps where timestampdiff(month,datasP,curdate())>0 and situacao = "aberta" and id_promissoria = '.$promissoria->id);        
          foreach ($datasP as $datasPs) {
      

              $diasAtraso = DB::table('data_ps')->selectRaw('timestampdiff(month,datasP,curdate()) as dias')->where( 'id' ,'=',$datasPs->id )->get();
                                                            //datediff(CURDATE(),datasP)/30 as dias    MUDOU AQUI POR ULTIMO
                    foreach ($diasAtraso as $diasAtrasos) {
                        $datasPs->mesesAtrasado= $diasAtrasos->dias; 
                        $arrayDataPs = array('id' => $datasPs->id, 'datasP' => $datasPs->datasP,'situacao' => $datasPs->situacao,
                        'mesesAtrasado' => $datasPs->mesesAtrasado,'valorParcela' => $datasPs->valorParcela,'id_promissoria' => $datasPs->id_promissoria);   
                        datap::find($datasPs->id)->update($arrayDataPs);  
              
                    }

         }
    }

    

        $registros =  cliente::where("id","=",$id)->get();
  
        //resumo da ficha no cabeçalho 
        $totalH =  array_first(DB::select('select sum(h.valor) as haverTotal from havers h, promissorias p, clientes c where (h.id_promissoria = p.id) and (p.id_cliente = c.id) and c.id ='.$idset));
        $totalP =  array_first(DB::select('select sum(pa.valorParcela) as total from data_ps pa, promissorias p, clientes c where (pa.id_promissoria = p.id) and (p.id_cliente = c.id) and c.id ='.$idset));
        $juros =  array_first(DB::select('select sum(j.valor) as juros from juros j, promissorias p, clientes c where (j.id_promissorias = p.id) and (p.id_cliente = c.id) and c.id ='.$idset.' and (j.situacao = "aberto")'));
        $jurosPagos =  array_first(DB::select('select sum(j.valor) as jurosPagos from juros j, promissorias p, clientes c where (j.id_promissorias = p.id) and (p.id_cliente = c.id) and c.id ='.$idset.' and (j.situacao = "pago")'));
        $totalPP =  array_first(DB::select('select sum(pa.valorParcela) as pagas from data_ps pa, promissorias p, clientes c where (pa.id_promissoria = p.id) and (p.id_cliente = c.id) and pa.situacao = "pago" and c.id  ='.$idset));
        $totalPA =  array_first(DB::select('select sum(pa.valorParcela) as atrasadas from data_ps pa, promissorias p, clientes c where (pa.id_promissoria = p.id) and (p.id_cliente = c.id) and pa.situacao = "aberta" and pa.mesesAtrasado  > 0 and c.id  ='.$idset));
        $totalPAbertas =  array_first(DB::select('select sum(pa.valorParcela) as abertas from data_ps pa, promissorias p, clientes c where (pa.id_promissoria = p.id) and (p.id_cliente = c.id) and pa.situacao = "aberta"  and pa.mesesAtrasado < 1 and c.id  ='.$idset));
        $totalPhoje =  array_first(DB::select('select sum(pa.valorParcela) as hoje from data_ps pa, promissorias p, clientes c where (pa.id_promissoria = p.id) and (p.id_cliente = c.id) and pa.situacao = "aberta"  and pa.datasP = CURRENT_DATE() and c.id  ='.$idset));
        $parcelastotal = DB::table('promissorias')->where('id_cliente','=',$idset)->sum('valor');
      
     
        $totalAtrasadasCjuros = $totalPA->atrasadas+$juros->juros ;
        $totalPatrasadas = $totalPA->atrasadas ;
        $aPagar =  $totalP->total + $jurosPagos->jurosPagos - $totalH->haverTotal +$juros->juros ;
        $totalPAbertas->abertas = $totalPAbertas->abertas - ($totalH->haverTotal - $totalPP->pagas) + $jurosPagos->jurosPagos;

        $resumo = array($totalH->haverTotal ,$totalAtrasadasCjuros,$totalPatrasadas,$juros->juros,$totalPAbertas->abertas, $totalPhoje->hoje, $aPagar );
       //dd($registros);
      
        return view('compras.listarCompras',compact('promissorias','registros','parcelas','resumo','caixa','vendedores'));
      }



      public function salvarCompras(Request $req)
      {
          $registros = $req->all();
          $clienteEmail = cliente::select('email','nome')->where('id',$registros['id_cliente'])->first();
       
          $vendedornome = vendedora::select('nome as vendedora')->where('id',$registros['id_vendedora'])->get();
          $vendedornome = $vendedornome->all();
          
          $registros = array_merge(['vendedora' => $vendedornome[0]->vendedora], $registros);
        
        
          $dadosParcelas =  promissoria::create($registros);

              $parcelas =  ['datasP' => '0','valorParcela' => '','id_promissoria'=> '0'];



                  $dias = 0;
                for ($i=1; $i <= $registros['parcelas'] ; $i++) {
                  $dias += 1;

                  if($i == $registros['parcelas']){

                    $parcelas['valorParcela'] =($registros['valor'])-(number_format(($registros['valor']/$registros['parcelas']), 2)*($i-1));
                    
                  }  else {
                      
                    $parcelas['valorParcela'] = ($registros['valor'])/$registros['parcelas'];

                    }
                    $parcelas['datasP'] = date('Y/m/d', strtotime("+$dias months", strtotime($registros['data'])));
                    $parcelas['id_promissoria'] = $dadosParcelas['id'];



                    dataP::create($parcelas);
                  
                } 
 
                if($clienteEmail->email != null){
                 

                   
                     $dados = ['email' => $clienteEmail->email, 'nome' => $clienteEmail->nome, 'valor'=> number_format($dadosParcelas->valor, 2), 'parcelas' => $dadosParcelas->parcelas, 'vendedora' => $dadosParcelas->vendedora, 'data' => $dadosParcelas->data,'acao' => 'Nova Compra'];
                     
                     Mail::send(new MailPrimeiro($dados));
                     //return view('mail.envioEmail', compact('dados'));
              
                    }

          return redirect()->route('site.compras.listar.clientes', $registros['id_cliente'])->with('success','Compra de R$ '.number_format($registros['valor'], 2).' na data: '.date('d/m/Y', strtotime( $registros['data'])).' realizada com sucesso !!!');;
      }

        public function salvarHaver(Request $req)
        {
          
          
            $carencia = valoresfixo::select('mesesParaCobrar')->first()->sum('mesesParaCobrar');
            $juroPorcentagem = valoresfixo::select('juros')->first()->sum('juros');
            $Restante = 0; //para definir o status dfa promissoria ao final do calculo dos juros
            $request = $req->all();


      // dd($request);
            $promissorias = promissoria::where('id_cliente','=',$request['id_cliente'])->
            orderBy('data','desc')->with('datasP')->with('havers')->with('juros')->with('clientes')->get();
            $promissoriaAtualizar = promissoria::find($request['id_promissoria']);

           
            $JurosTotal =juro::where('id_promissorias','=',$request['id_promissoria'])->get()->sum('valor');
           
                //treixo que calcula os juros
                //pega o que sobrou das parcelas aqui
                  $resto = 0;
                  $haver = haver::where('id_promissoria','=',$request['id_promissoria'])->get()->sum('valor');
                  $valorParcela =dataP::where('id_promissoria','=',$request['id_promissoria'])->get()->avg('valorParcela');
                  $valorParcelasTotal =dataP::where('id_promissoria','=',$request['id_promissoria'])->get()->sum('valorParcela');
                 
                      for ($i = $haver; $i >= 0; $i=$i-$valorParcela) { 
                              $resto=$i;
                      }


                 //dd($resto, date('d/m/Y'));
                      
                //um foreach dos havers q ainda não estão quitados 
                $parcelas =dataP::where('id_promissoria','=',$request['id_promissoria'])->Where('situacao','=','aberta')->
                orderBy('datasP','asc')->get(); 
                      

                
                       $restoMaisHaver = $resto+$request['valor'];
                       $totalSaldo = $haver; 

                      //dd($restoMaisHaver);

                    //if($request['valor']+$totalSaldo ){   //teste se a soma do haver mais o q tem de haver é menor do q o total da divida

                          foreach($parcelas as $parcela ){
                              
                                //resolver esse if
                                if($restoMaisHaver>=($valorParcela - 0.009) and $request['valor']>0){

                                      if($parcela->mesesAtrasado > $carencia){ //AQUI ESSE VALOR VAI VAREAR DEPENDENDO DO MESES DE CARENCIA NO BD 
                                       
                                          //dd($parcela->mesesAtrasado);
                                        $arrayJuroDaParcela = array('data' => $request['dataP'], 'valor' => number_format((($valorParcela-$resto)*($parcela->mesesAtrasado*$juroPorcentagem))/100, 2),  //2%
                                      'referencia' => 'Juro referente à parcela do dia "'.date( 'd/m/Y' , strtotime($parcela->datasP)).'" com '.$parcela->mesesAtrasado. 
                                      ' mês(es) atrasado(s) em '.date('d/m/Y', strtotime($request['dataP'])),'id_data_ps' => $parcela->id, 'id_promissorias' => $parcela->id_promissoria);
                                      
                                      $JurosTotal =  $JurosTotal + number_format((($valorParcela-$resto)*($parcela->mesesAtrasado*$juroPorcentagem))/100, 2) ; //somando juros para o status da promissoria
                                        
                                     // dd($arrayJuroDaParcela); 
                                      if($juroPorcentagem > 0)
                                        juro::create($arrayJuroDaParcela);
                                      
                                       }
                                    
                                      $parcela->situacao ='pago';
                                   
                                      datap::find($parcela->id)->update($parcela->getAttributes()); 
                                      
                                      
                                     

                                }  
                                else if($restoMaisHaver<$valorParcela and $request['valor']>0 and $restoMaisHaver>0){
                                    //só cria o haver sem fazer nada, já que o valor não alcança o valor de uma parcela
                                           // dd('segundo if');

                                           if($parcela->mesesAtrasado > $carencia){ //AQUI ESSE VALOR VAI VAREAR DEPENDENDO DO MESES DE CARENCIA NO BD 
                                       
                                            //dd($parcela->mesesAtrasado);
                                          $arrayJuroDaParcela = array('data' => $request['dataP'], 'valor' => number_format((($restoMaisHaver)*($parcela->mesesAtrasado*$juroPorcentagem))/100, 2),  //2%
                                        'referencia' => 'Juro referente à parcela :'.date( 'd/m/Y' , strtotime($parcela->datasP)).' com '.$parcela->mesesAtrasado. 
                                        ' mês(es) atrasado(s) em '.date('d/m/Y', strtotime($request['dataP'])),'id_data_ps' => $parcela->id, 'id_promissorias' => $parcela->id_promissoria);
                                        
                                        $JurosTotal =  $JurosTotal + number_format((($valorParcela-$resto)*($parcela->mesesAtrasado*$juroPorcentagem))/100, 2) ; // ***ADICIONEI NUMBER FORMAT somando juros para o status da promissoria
  
                                       // dd($arrayJuroDaParcela); 
                                       if($juroPorcentagem > 0)
                                        juro::create($arrayJuroDaParcela);
                                        
                                         }
                                         
                                         $restoMaisHaver = $restoMaisHaver - $valorParcela;
                                }
                               
                                         $resto = 0;
                                         $restoMaisHaver = $restoMaisHaver - $valorParcela;

                            }      
                    // }
                    
                   $Restante = $JurosTotal +  $valorParcelasTotal -  $request['valor'] - $haver;
                   $JurosDaPromissoria =juro::where('id_promissorias','=',$request['id_promissoria'])->get(); // lista de juros desta promissoria

                   
                   if($Restante <= 0.0099){
                    $promissoriaAtualizar['status'] = 'fechada';
                    $request['status'] = 'QUITAÇÃO'; // aqui tem q colocar um array com os dados da promissoria mais mudança do status para QUITAÇÃO
                   
                    promissoria::find($request['id_promissoria'])->update($promissoriaAtualizar->getAttributes()); 

                    foreach ($JurosDaPromissoria as $JuroDaPromissoria) {
                     
                      $JuroDaPromissoria['situacao'] = 'pago';
                      juro::find($JuroDaPromissoria['id'])->update($JuroDaPromissoria->getAttributes());

                    }

                   }
            
          
                  
               if($request['id_promissoria'] == null or $request == null){
                return redirect()->route('site.compras.listar.clientes',$request['id_cliente'])->with('error','ERRO AO ADICIONAR HAVER');
               }
               
              haver::create($request);  //cria um haver
              
            $registros =  cliente::find($request['id_cliente']); //acha as promissorias do cliente


              return redirect()->route('site.compras.listar.clientes',$request['id_cliente'])->with('success','Haver de R$ '.number_format($request['valor'], 2).' salvo com sucesso !!!');

        }




        public function verJuros(Request $req){


          $carencia = valoresfixo::select('mesesParaCobrar')->first()->sum('mesesParaCobrar');
          $juroPorcentagem = valoresfixo::select('juros')->first()->sum('juros');
          $request = $req->all(); 
//dd($request);
          $array = array();
          $cont = 0; 

          // dd($request);
                $promissorias = promissoria::where('id_cliente','=',$request['id_cliente'])->
                orderBy('data','desc')->with('datasP')->with('havers')->with('juros')->with('clientes')->get();
    
    
    
                    //treixo que calcula os juros
                    //pega o que sobrou das parcelas aqui
                      $resto = 0;
                      $haver = haver::where('id_promissoria','=',$request['id_promissoria'])->get()->sum('valor');
                      $valorParcela =dataP::where('id_promissoria','=',$request['id_promissoria'])->get()->avg('valorParcela');
                      $valorParcelasTotal =dataP::where('id_promissoria','=',$request['id_promissoria'])->get()->sum('valorParcela');
                     
                          for ($i = $haver; $i >= 0; $i=$i-$valorParcela) { 
                                  $resto=$i;
                          }
    
    
                     //dd($resto, date('d/m/Y'));
                          
                    //um foreach dos havers q ainda não estão quitados 
                    $parcelas =dataP::where('id_promissoria','=',$request['id_promissoria'])->Where('situacao','=','aberta')->
                    orderBy('datasP','asc')->get(); 
                          
                           // dd($parcelas);
                    
                           $restoMaisHaver = $resto+$request['valor'];
                           $totalSaldo = $haver; 
    
                          //dd($restoMaisHaver);
    
                      if($request['valor']+$totalSaldo){   //teste se a soma do haver mais o q tem de haver é menor do q o total da divida
    
                              foreach($parcelas as $parcela ){
                                
                                    //resolver esse if
                                    if($restoMaisHaver>=$valorParcela and $restoMaisHaver>0){
    
                                          if($parcela->mesesAtrasado> $carencia){ //AQUI ESSE VALOR VAI VAREAR DEPENDENDO DO MESES DE CARENCIA NO BD , o zero é teste
                                           
                                              //dd($parcela->mesesAtrasado);
                                            $arrayJuroDaParcela = array('datas' => $request['dataP'], 'valor' => (($valorParcela-$resto)*($parcela->mesesAtrasado*$juroPorcentagem))/100,  //2%
                                          'referencia' => 'Juro referente à parcela do dia "'.date( 'd/m/Y' , strtotime($parcela->datasP)).'" com '.$parcela->mesesAtrasado. 
                                          ' mês(es) atrasado(s) em '.date('d/m/Y', strtotime($request['dataP'])),'id_data_ps' => $parcela->id, 'id_promissorias' => $parcela->id_promissoria);
                                       
                                          $array[$cont] = $arrayJuroDaParcela;
                                       
                                          $resto=0;
                                         // dd($arrayJuroDaParcela); 
                                          //juro::create($arrayJuroDaParcela);
                                          //dd($arrayJuroDaParcela);
                                         
                                           }
                                   }else if($restoMaisHaver<$valorParcela and $restoMaisHaver>0){
                                    //só cria o haver sem fazer nada, já que o valor não alcança o valor de uma parcela
                                           // dd('segundo if');

                                           if($parcela->mesesAtrasado>$carencia){ //AQUI ESSE VALOR VAI VAREAR DEPENDENDO DO MESES DE CARENCIA NO BD , o zero é teste
                                       
                                            //dd($parcela->mesesAtrasado);
                                          $arrayJuroDaParcela = array('datas' => $request['dataP'], 'valor' => (( $restoMaisHaver)*($parcela->mesesAtrasado*$juroPorcentagem))/100,  //2%
                                        'referencia' => 'Juro referente à parcela do dia:'.date( 'd/m/Y' , strtotime($parcela->datasP)).' com '.$parcela->mesesAtrasado. 
                                        ' mês(es) atrasado(s) em '.date('d/m/Y', strtotime($request['dataP'])),'id_data_ps' => $parcela->id, 'id_promissorias' => $parcela->id_promissoria);
                                        
  
                                       
                                       // juro::create($arrayJuroDaParcela);
                                      
                                       $array[$cont]  = $arrayJuroDaParcela;
                                      
                                      
                                         }
                                         

                                }
                                $cont++;
                                $restoMaisHaver = $restoMaisHaver - $valorParcela;
                                $resto = 0;
                              } 
                      }
                      //dd($array); 

           //dd($array);
           $response = array(
            'status' => 'success',
            'msg' => ' eh isso mermo',
        );
        return \Response::json($array);

        }

        public function ExcluirCompras($idPromissoria, $idCliente){

         if(haver::select()->where('id_promissoria',$idPromissoria)->count() == 0){

              promissoria::find($idPromissoria)->delete();

          return redirect()->route('site.compras.listar.clientes',$idCliente)->with('success','Promissória Exluída com sucesso !!!');
          

         }elseif(haver::select()->where('id_promissoria',$idPromissoria)->count() > 0){
        
          return redirect()->route('site.compras.listar.clientes',$idCliente)->with('error','Pormissória não pode ser excluída por conter haver(s) !!!');
          }
       

        }

}
