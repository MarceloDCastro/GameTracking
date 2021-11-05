<?php
   session_start();
?>
<!doctype html>
<html lang="pt-br">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      
      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


         <!-- CSS Geral -->
      <link rel="stylesheet" href="<?php echo $urlSite ?>css/geral.css">

      <!-- CSS Página Sobre -->
      <link rel="stylesheet" href="<?php echo $urlSite ?>css/sobre-nos.css">

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

      <title>Sobre - GameTracking</title>
   </head>
   <body>
      <header>
         <?php
            include('nav.php');
         ?>
      </header>
      <div class="container sobre">
         <h1>Quem somos ?</h1>
         <p>
            A GameTracking surgiu da ideia de um site que facilite a forma de encontrar jogos gratuitos e com promoções na internet. Com a expansão do mercado de games, diversas plataformas surgiram como lojas digitais, mas não existe uma forma de compilar tudo isso e facilitar a buscar por jogos gratuitos ou em promoção.
            O interesse pelo mundo dos games e a necessidade <br><br> que a equipe já teve de alguma ferramenta desse tipo, 
            contribuiu para a concretização do nosso projeto, que tem em mente ajudar o público a encontrar jogos que estejam gratuitos em uma promoção tentadora para os que gostam de economizar. Nossa equipe é formada por 3 desenvolvedores, apaixonados por jogos e com intuito de auxiliar a comunidade gamer, que outrora era minoria, mas agora é um dos maiores empreendimentos do mundo.
         </p>
      </div>
      <br><br><br><br><br><br><br><br>
      <?php include('footer.php'); ?>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   </body>
</html>