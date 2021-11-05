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

<h3>Jogos</h3>

<button onclick="addJogo()" class="btn btn-primary botao-cadastrar"><i class="fas fa-plus-circle"></i> Cadastrar Jogo</button>

<div id="jogos">

</div>

<div class="card-jogo">
    <div class="header-jogo">
      <p class="titulo-jogo">[1] Rocket League</p>
      <div class="acoes-jogo">
        <button><i class="fas fa-pencil-alt"></i></button>
        <button><i class="fas fa-times"></i></button>
      </div>
    </div>
    <div>
      <p class="genero-jogo">Ação</p>
      <p class="genero-jogo">Aventura</p>
      <p class="genero-jogo">Tiro</p>
      <p class="genero-jogo">Corrida</p>
      <p class="genero-jogo">Futebol</p>
    </div>
    <div style="display:flex; justify-content: space-around">
      <img class="img-jogo" src="https://rocketleague.media.zestyio.com/rl_s4_rp_core_nologo_16_9.jpg?optimize=high" alt="...">
      <img class="img-jogo" src="https://rocketleague.media.zestyio.com/rl_s4_rp_core_nologo_16_9.jpg?optimize=high" alt="...">
      <img class="img-jogo" src="https://rocketleague.media.zestyio.com/rl_s4_rp_core_nologo_16_9.jpg?optimize=high" alt="...">
    </div>
  </div>

<script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
<script src="js/requisicoesJogo.js"></script>




          <div class="mb-3">    
                <label for="img1" class="form-label">Imagem 1:</label>
                <input type="file" name="img1" id="img1" class="form-control">
            </div>
            <div class="mb-3">    
                <label for="img2" class="form-label">Imagem 2:</label>
                <input type="file" name="img2" id="img2" class="form-control">
            </div>
            <div class="mb-3">    
                <label for="img3" class="form-label">Imagem 3:</label>
                <input type="file" name="img3" id="img3" class="form-control">
            </div>
            <input type="submit" name="cadastrar" value="Cadastrar" id="cadastrar" class="btn">