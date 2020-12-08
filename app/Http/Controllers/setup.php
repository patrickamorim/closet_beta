<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\valoresfixo;
class setup extends Controller
{
    
    public function getConfiguracao(){

      

       

        $valoresFixo = valoresfixo::find(1);
         
   
 

        return view('setup.configuracao', compact('valoresFixo'));
    }

    public function salvarConfiguracao(Request $req){

        $registros = $req->all();

        if($registros == null)
        dd($registros);

        valoresfixo::find(1)->update($registros);
        $valoresFixo = valoresfixo::find(1);

        return view('setup.configuracao', compact('valoresFixo'))->with('success','Configuração salva com sucesso !!!');

    }



}
