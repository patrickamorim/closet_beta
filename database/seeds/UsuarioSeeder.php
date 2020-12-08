<?php

use Illuminate\Database\Seeder;
use App\User;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $dado= [
           ['name' => 'admin',
           'email' => 'admin@gmail.com',
           'funcao' => 'administrador',
           'password' => bcrypt("121293"),],
           [
            'name' => 'operador',
           'email' => 'operador@gmail.com',
           'funcao' => 'caixa',
           'password' => bcrypt("123456"),
           ]
        
       ];

       foreach ($dado as $dados) {
         
       

       if(User::where('email','=',$dados['email'])->count()){
            $usuario = User::where('email','=',$dados['email'])->first();
            $usuario->update($dados);
       }else{
           User::create($dados);

       }
}
    }
}
