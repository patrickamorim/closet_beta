
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
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          color: white;
        }
        </style>
    <title>Compra</title>
</head>
<body>
    
    <div align="center"  class="hero-image"  >

        <div  class="hero-text">
            <div style="background-color:black" class="block">
        <h1>Obrigado por sua compra na Closet </h1>
        <h2>
            <p>cliente: {{$dados['nome']}}</p>
            <p>valor: R$ {{$dados['valor']}}</p>
            <p>parcelas: {{$dados['parcelas']}}</p>
            <p>vendedora: {{$dados['vendedora']}}</p>
            <p>data Promissoria: {{date('d/m/Y', strtotime($dados['data']))}}</p>
         </h2>
        </div>
        </div>
    </div>


</body>
</html>
  
