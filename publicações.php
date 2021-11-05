<?php
    session_start();
    require_once('php/conexao.php');
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   
    
    
    <!-- CSS Geral -->
    <link rel="stylesheet" href="<?php echo $urlSite ?>css/geral.css">

    <!-- CSS Página inicial -->
    <link rel="stylesheet" href="<?php echo $urlSite ?>css/index.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <title>GameTracking - Jogos Grátis, Promoções e Lançamentos</title>
  </head>
  <body>
    <header>
      <?php
          include('nav.php');
      ?>
    </header>
    
        <div class="container busca">
            <form method="POST">
              <div class="input-group mb-3">
                  <input type="text" id="busca" class="form-control" placeholder="Busca" aria-label="Busca">
                  <button class="btn">
                      <i class="fab fa-sistrix"></i>
                  </button>
              </div>
            </form>
        </div>
    

    <div class="container cards">

        <h2>Publicações</h2>

        <div id="resultados"></div>
        <div class="row" id="publicacoes"></div>
    </div>

    <?php include('footer.php'); ?>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?php echo $urlSite ?>js/script.js"></script>
    <script src="<?php echo $urlSite ?>js/requisicoesPublicacao.js"></script>

  </body>
</html>