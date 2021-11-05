<?php
   session_start();
   require_once('php/conexao.php');

   if(isset($url[1])){
      // Se o título for passado na url

      $url = array_filter(explode('/',$_GET['url'])); // Transforma a url em uma lista
   
      $urlPub = str_replace("-"," ",strtolower($url[1]));
      $sql = $pdo->prepare("SELECT * FROM tb_Publicacao WHERE lower(nm_Titulo) = ?");
      $sql->execute(Array($urlPub));
      $dados = $sql->fetch();

      if(!isset($dados['cd_Publicacao'])){
         //Se a publicação não existir
         include('404.php');
         die();
      }
   } else {
      include('404.php');
      die();
   }
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
      <link rel="stylesheet" href="<?php echo $urlSite ?>css/geral.css">
      <link rel="stylesheet" href="<?php echo $urlSite ?>css/publicacao.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
      <title><?php echo $dados['nm_Titulo'] ?> - GameTracking</title>
   </head>
   <body>
      <header>
         <?php include('nav.php'); ?>
      </header>

      <div class="container jogo">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-6">
                  <div class="container imagem-jogo">
                     <img src="https://gametracking.github.io/site/imgs/rkt3.jpg" alt="">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="container infos-jogo">
                     <h2><?php echo $dados['nm_Titulo'] ?></h2>
                     <button type="button" class="btn btn-primary">Obter Jogo</button>
                     <a href="<?php echo $urlSite ?>sugestões"><button type="button" class="btn btn-primary">Enviar Sugestão</button></a>
                  </div>
               </div>
            </div>
            <div class="container descricao-jogo">
               <p class="desc-jogo">
                  <?php echo $dados['ds_Publicacao'] ?>
               </p>
            </div>
            <div class="container imagens">
               <h2>Galeria</h2>
               <div id="carouselExampleIndicators" class="carousel carousel-dark slide" data-bs-ride="carousel">
                  <div class="carousel-indicators">
                     <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                     <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                     <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                  </div>
                  <div class="carousel-inner">
                     <div class="carousel-item active">
                        <img src="https://gametracking.github.io/site/imgs/rkt3.jpg" class="d-block" alt="...">
                     </div>
                     <div class="carousel-item">
                        <img src="https://gametracking.github.io/site/imgs/rkt.jpg" class="d-block" alt="...">
                     </div>
                     <div class="carousel-item">
                        <img src="https://gametracking.github.io/site/imgs/rkt2.jpg" class="d-block" alt="...">
                     </div>
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                  </button>
               </div>
            </div>
         </div>
      </div>

      <?php include('footer.php'); ?>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   </body>
</html>