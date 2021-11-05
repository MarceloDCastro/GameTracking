<?php
   $urlSite = "http://localhost/GameTrackingOficialv3/"; //Para evitar problemas ao usar link de css ou imagens com htaccess

   if(!isset($_SESSION['email'])){
      //Deslogado
      include('404.php');
      die();
   } else{
       // Logado
       if($_SESSION['tipo'] != 0){
           // Usuario
           include('404.php');
           die();
       }
   }
?>

      <div class="container painel-adm">
         <h3 class="h1-painel verde">Painel</h3>
         <div class="container cadastrado">
            <h4 class="verde">Total cadastrado</h4>
            <div class="row">
               <div class="col-sm-6 mt-3">
                  <div class="items-caixa">
                     <div class="caixa">
                        <i class="fas fa-users"></i>
                     </div>
                     <div class="total">
                        <p class="azul" >Usuários: <span>
                           <?php
                              $sql = $pdo->query("SELECT count(cd_Usuario) as qtUsuario FROM tb_Usuario");
                              $dados = $sql->fetch();
                              echo $dados['qtUsuario'];
                           ?>
                        </span> </p>
                     </div>
                  </div>
                  <div class="items-caixa">
                     <div class="caixa">
                        <i class="fas fa-gamepad"></i>
                     </div>
                     <div class="total">
                        <p class="azul">Jogos: <span>
                           <?php
                              $sql = $pdo->query("SELECT count(cd_Jogo) as qtJogo FROM tb_Jogo");
                              $dados = $sql->fetch();
                              echo $dados['qtJogo'];
                           ?>
                        </span> </p>
                     </div>
                  </div>
                  <div class="items-caixa">
                     <div class="caixa">
                        <i class="fas fa-users"></i>
                     </div>
                     <div class="total">
                        <p class="azul">Publicações: <span>
                           <?php
                              $sql = $pdo->query("SELECT count(cd_Publicacao) as qtPublicacao FROM tb_Publicacao");
                              $dados = $sql->fetch();
                              echo $dados['qtPublicacao'];
                           ?>
                        </span> </p>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 mt-3">
                  <div class="items-caixa">
                     <div class="caixa">
                     <i class="fas fa-info-circle"></i>
                     </div>
                     <div class="total">
                        <p class="azul">Gêneros: <span>
                           <?php
                              $sql = $pdo->query("SELECT count(cd_Genero) as qtGenero FROM tb_Genero");
                              $dados = $sql->fetch();
                              echo $dados['qtGenero'];
                           ?>
                        </span> </p>
                     </div>
                  </div>
                  <div class="items-caixa">
                     <div class="caixa">
                     <i class="fas fa-laptop"></i>
                     </div>
                     <div class="total">
                        <p class="azul">Plataforma: <span>
                        <?php
                              $sql = $pdo->query("SELECT count(cd_Plataforma) as qtPlataforma FROM tb_Plataforma");
                              $dados = $sql->fetch();
                              echo $dados['qtPlataforma']
                           ?>
                        </span> </p>
                     </div>
                  </div>
                  <div class="items-caixa">
                     <div class="caixa">
                     <i class="far fa-comment-dots"></i>
                     </div>
                     <div class="total">
                        <p class="azul">Sugestões: <span>
                        <?php
                              $sql = $pdo->query("SELECT count(cd_Sugestao) as qtSugestoes FROM tb_Sugestao");
                              $dados = $sql->fetch();
                              echo $dados['qtSugestoes'];
                           ?>
                        </span> </p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>