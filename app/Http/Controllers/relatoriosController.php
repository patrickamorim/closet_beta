<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\promissoria;
use App\haver;
use App\juro;
use App\caixa;
use App\itemCaixa;
use App\dataP;
use App\vendedora;

class relatoriosController extends Controller
{
    
public function getPromissorias(Request $req){
    $req->flash();
    $datas = $req->all();
   // dd($datas);

        if($datas != null){
        $registros = promissoria::whereBetween('created_at',[$datas['dataInicial'].' 00:00:00',$datas['dataFinal'].' 23:59:59'])->with('clientes')->orderBy('created_at')->get();

        $totalPromissorias = $registros->sum('valor');
        } 

    return view('relatorios/Promissorias/relatorioPromissorias', compact('registros','totalPromissorias'));

}

public function getContabil(Request $req){
    $req->flash();
    $datas = $req->all();

    if($datas != null){
        $valorPromissoriasAbertas = promissoria::select('valor')->where('status','aberta')->whereBetween('created_at',[$datas['dataInicial'].' 00:00:00',$datas['dataFinal'].' 23:59:59'])->get()->sum('valor');
        $valorPromissorias = dataP::select('valorParcela')->whereBetween('created_at',[$datas['dataInicial'].' 00:00:00',$datas['dataFinal'].' 23:59:59'])->get()->sum('valorParcela');
        $totalJuros = juro::select('valor')->whereBetween('created_at',[$datas['dataInicial'].' 00:00:00',$datas['dataFinal'].' 23:59:59'])->get()->sum('valor');
        $JurosAbertos = juro::select('valor')->where('situacao','aberto')->whereBetween('created_at',[$datas['dataInicial'].' 00:00:00',$datas['dataFinal'].' 23:59:59'])->get()->sum('valor');
        $JurosPagos = juro::select('valor')->where('situacao','pago')->whereBetween('created_at',[$datas['dataInicial'].' 00:00:00',$datas['dataFinal'].' 23:59:59'])->get()->sum('valor');
        $TotalHavers = haver::select('valor')->whereBetween('dataP',[$datas['dataInicial'].' 00:00:00',$datas['dataFinal'].' 23:59:59'])->get()->sum('valor');
        $totalVendas = itemCaixa::select('valor')->where('tipoEpag','!=','Saida')->where('tipoEpag','!=','Entrada')->where('tipoEpag','!=','Troco')->whereBetween('created_at',[$datas['dataInicial'].' 00:00:00',$datas['dataFinal'].' 23:59:59'])->get()->sum('valor');
        $totalSaidas = itemCaixa::select('valor')->where('tipoEpag','=','Saida')->whereBetween('created_at',[$datas['dataInicial'].' 00:00:00',$datas['dataFinal'].' 23:59:59'])->get()->sum('valor');
        $totalEntradas = itemCaixa::select('valor')->where('tipoEpag','=','Entrada')->whereBetween('created_at',[$datas['dataInicial'].' 00:00:00',$datas['dataFinal'].' 23:59:59'])->get()->sum('valor');
        $promissoriasAtrasadas = dataP::select('valorParcela')->where('mesesAtrasado','>',0)->where('situacao','aberta')->whereBetween('created_at',[$datas['dataInicial'].' 00:00:00',$datas['dataFinal'].' 23:59:59'])->get()->sum('valorParcela');

        $totalsaídas = itemCaixa::select('valor')->where('tipoEpag','==','Saida')->whereBetween('created_at',[$datas['dataInicial'].' 00:00:00',$datas['dataFinal'].' 23:59:59'])->get()->sum('valor');

        $aReceber = ($valorPromissorias+$totalJuros) - $TotalHavers;  
        $totalRecebidos = $TotalHavers+$totalVendas ;
        $aReceberAtrasados =  $promissoriasAtrasadas+$JurosAbertos/* - ($TotalHavers-$JurosPagos-$promissoriasPagas)*/;
    }
        //dd($aReceberAtrasados);

    return view('relatorios/Contabil/relatorioContabil', compact('aReceber','totalRecebidos','aReceberAtrasados','TotalHavers','valorPromissorias','JurosPagos','totalJuros','totalSaidas','totalEntradas'));
}

public function getVendedores(Request $req){
    $req->flash();
    $datas = $req->all();
    $total = 0;

    if($datas != null){
    //$registros =  vendedora::select()->with('itemCaixas')->with('promissorias')->get();
    //dd($registros[0]->promissorias);
    $registro = caixa::get_Vendas_vendedoras($datas['dataInicial'],$datas['dataFinal'],$datas['status']); 
    $registros = $registro->groupBy('vendedora');

    /*
    foreach ($registros as $key => $value) {
        $total += $value->sum('valor');
    } */

}

//dd($registros);
    return view('relatorios/Vendedoras/relatorioVendedoras', compact('registros','total'));
}


}
