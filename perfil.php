<?php
   session_start();
   require_once('php/conexao.php');

   if(!isset($_SESSION['email'])){
   // Deslogago
   header('location:'.$urlSite);
   } else{
      // Logado
      $sql = $pdo->prepare("SELECT nm_Usuario,ds_Email,cd_Senha,ds_Telefone,DATE_FORMAT(dt_Nascimento, '%d/%m/%Y') as dt_Nascimento, im_Usuario FROM tb_Usuario WHERE ds_Email = ?");
      $sql->execute(Array($_SESSION['email']));
      $dados = $sql->fetch();
   }

   if(isset($_GET['logout'])){
      // Sair
      session_destroy();
      header('location:'.$urlSite);
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
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
      <link rel="stylesheet" href="<?php echo $urlSite ?>css/geral.css">
      <link rel="stylesheet" href="<?php echo $urlSite ?>css/perfil.css">
      <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
      <title>GameTracking - Perfil do Usuário</title>
   </head>
   <header>
      <?php include('nav.php'); ?>
   </header>
      <div class="container perfil">
         <h1 class="azul-gt" >Perfil</h1>¨
         <hr>
         <img src="
         <?php
            if ($dados['im_Usuario'] != null){
               echo $urlSite.'im_Usuario';
            } else {
               echo $urlSite.'images/user.png';
            }
         ?>"
         alt="Imagem de Perfil de <?php echo $dados['nm_Usuario'] ?>" class="d-block">
         <h2 class="azul-gt" ><?php echo $dados['nm_Usuario'] ?></h2>
         <div class="container infos-perfil">
            <div class="informacoes-usuario">
               <div class="col justify-content-between">
                  <p class="azul-gt d-inline-block">Email:</p>
                  <p class="info-usuario d-inline-block"><?php echo $dados['ds_Email'] ?></p>
                  <button class="btn-edit"><i class="fas fa-edit azul-gt"></i></button>
               </div>
               <div class="col justify-content-between">
                  <p class="azul-gt d-inline-block">Telefone:</p>
                  <p class="info-usuario d-inline-block">
                     <?php
                        if($dados['ds_Telefone'] == null){
                           echo "Não cadastrado";
                        } else{
                           echo $dados['ds_Telefone'];
                        }
                     ?>
                  </p>
                  <button class="btn-edit"><i class="fas fa-edit azul-gt"></i></button>
               </div>
               <div class="col justify-content-between">
                  <p class="azul-gt d-inline-block">Nascimento:</p>
                  <p class="info-usuario d-inline-block"><?php echo $dados['dt_Nascimento'] ?></p>
                  <button class="btn-edit"><i class="fas fa-edit azul-gt"></i></button>
               </div>
               <div class="col justify-content-between">
                  <p class="azul-gt d-inline-block">Senha:</p>
                  <p class="info-usuario d-inline-block">
                     <?php 
                        for($i=1; $i <= strlen($dados['cd_Senha']); $i++){
                           echo "*";   
                        }
                     ?>
                  </p>
                  <button class="btn-edit"><i class="fas fa-edit azul-gt"></i></button>
               </div>
               <div class="col-12">
                  <div class="form-check form-switch">
                     <label class="form-check-label  azul-gt" for="noti">Receber notificações por Email</label>
                     <input class="form-check-input" type="checkbox" id="noti">
                  </div>
               </div>
               <div class="d-flex justify-content-center">
                  <button type="submit" class="btn btn-sair azul-gt" onclick="confirmarLogout()"><i class="fas fa-sign-out-alt"></i> Sair</button>
               </div>
            </div>
         </div>
      </div>
      <br><br><br><br><br>
      <?php include('footer.php') ?>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      <script src="<?php echo $urlSite ?>js/geral.js"></script>
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   </body>
</html>