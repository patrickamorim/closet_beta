
<!DOCTYPE html>
<html lang="pt">
<head>
    <style>
        body {
          margin: 0;
          font-family: Arial, Helvetica, sans-serif;
        }
        
        .hero-image {
          background-image: url("https://scontent.fvdc1-1.fna.fbcdn.net/v/t1.0-9/15327506_690504841128023_7712183216928994345_n.jpg?_nc_cat=103&_nc_ohc=LCQ6Ile8ch4AX9RHSu9&_nc_ht=scontent.fvdc1-1.fna&oh=bc245d40d033d7c1859f7df8b91c43f6&oe=5E9028FA");
          background-color: #cccccc;
          height: 500px;
          background-position: center;
          background-repeat: no-repeat;
          background-size: cover;
          position: relative;
        }
        
        .hero-text {
          text-align: center;
          position: center;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          color: white;
          text-shadow: #000 2px 3px 2px;
        }
        

        </style>
    <title>Compra</title>
</head>
<body>
    
    <div align="center"  class="hero-image">

        <div  class="hero-text" style="color: white ">
          
        <h1 style="background-color:black">Obrigado por sua compra na Closet <span style="color:red ; font-size: 13px">■</span><span style="color:yellow ; font-size: 13px">■</span><span style="color:cyan ; font-size: 13px">■</span> </h1>
        <h2 style="background-color: black">
            <p >Cliente: {{$dados['nome']}}</p>
            <p>Valor: R$ {{$dados['valor']}}</p>
            <p>Parcelas: {{$dados['parcelas']}}x R$ {{number_format($dados['valor']/$dados['parcelas'], 2)}}</p>
            <p>Data da Promissoria: {{date('d/m/Y', strtotime($dados['data']))}}</p>
            <p>Vendedora: {{$dados['vendedora']}}</p>
            
         </h2>
        
        </div>
    </div>


</body>
</html>
  
