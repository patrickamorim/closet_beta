<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cliente;
use App\vendedora;
use App\valoresfixo;

class clienteController extends Controller
{

    public function index()
    {

      $valoresFixo = valoresfixo::find(1);
     
      if($valoresFixo == null){

        try {
          $valoresFixo =  valoresfixo::create();
        } catch (\Throwable $th) {
          }
        }
    
      
      return View('index');
    }


        public function listarClientes()
        {


          $input = "";
          $pesquisa = "pesquisa";
          $registros = cliente::paginate(10);
        

          return View('clientes.clientesLista',compact('registros','pesquisa','input'));
        }


        public function cadastrarClientes()
        {


          return View('clientes.clientesAdicionar');
        }

        public function salvarClientes(Request $req)
        {
          $req->flash();
   

          $e = "Cliente cadastrado com sucesso !";
          $r = "sim";
          $registro = $req->all();
         

                  try {
                    cliente::create($registro);

                  } catch (\Exception $e) {
                    $e = "Erro ao adicionar cliente, tente novamente !!!";
                    $r = "nao";
                    $registro = $req->all();
                  } catch (\QueryException $e) {
                    $e = "CPF já cadastrado !!!";
                    $r = "nao";
                    $registro = $req->all();
                  }



            return View('clientes.clientesAdicionar',compact('e','r','registro'));
      //    return redirect()->route('site.clientes.listar', );
        }


        public function editarClientes($id)
        {
         
            $registro = cliente::find($id);
        
      
          return View('clientes.clientesEditar',compact('registro'));
        }


        public function atualizarClientes(Request $req, $id)
        {
          $req->flash();
          $e = "Cliente atualizado com sucesso !";
          $r = "sim";

          $registro = $req->all();

          try {
            cliente::find($id)->update($registro);
          } catch (\Throwable $th) {
        
            return redirect()->back()->withErrors(['Erro ao atualizar cliente, CPF '.$registro['cpf'].' já em uso !!!']);;
          }

          return redirect()->route('site.clientes.listar');
        }

        public function buscarClientes(Request $nome)
        {

          $input = $nome->all();
          $pesquisa = "pesquisa";
          $registros = cliente::busca($nome->nome);

          return View('clientes.clientesLista',compact('registros','pesquisa','input'));
        }


        //controllers para Vendedores  --------------------------------------------------------------------


        public function cadastrarVendedores(){

          return View('relatorios.Vendedoras.includes.adicionarVendedor');

        }

        public function salvarVendedores(Request $req){

          $req->flash();
   

          $e = "Vendedora cadastrado com sucesso !";
          $r = "sim";
          $registro = $req->all();
         

                  try {
                    vendedora::create($registro);

                  } catch (\Exception $e) {
                    $e = "Erro ao adicionar Vendedora, tente novamente !!!";
                    $r = "nao";
                    $registro = $req->all();
                  } catch (\QueryException $e) {
                    $e = "CPF já cadastrado !!!";
                    $r = "nao";
                    $registro = $req->all();
                  }



            return View('relatorios.Vendedoras.includes.adicionarVendedor',compact('e','r','registro'));
         

        }

        public function atualizarVendedores(Request $req, $id){

          $req->flash();
          $e = "Cliente cadastrado com sucesso !";
          $r = "sim";

          $registro = $req->all();
          //dd($registro);
          try {
            vendedora::find($id)->update($registro);
          } catch (\Throwable $th) {
        
            return redirect()->back()->withErrors(['Erro ao atualizar Vendedora, CPF '.$registro['cpf'].' já em uso !!!']);
          }

          return   redirect()->back()->with('success','Vendedora Atualizada !!!');
        }


        public function EditarVendedoras($id)
        {
         
            $registro = vendedora::find($id);
        
      //dd($registro);
          return View('relatorios\Vendedoras\includes\EditarVendedor',compact('registro'));
        }
        





}
