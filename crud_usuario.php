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

<h3>Usuários</h3>

<?php
    $sql = $pdo->query("SELECT * from tb_Usuario");
    $dados = $sql->fetchAll(PDO::FETCH_ASSOC);

    
?>

<div id="usuarios" class="row">
    <!--<div class="div-card d-flex">
        <img src="images/user.png" width="100" height="100">
        <div class="infos">
            <p class="nome"> nome nome nome</p>
            <p><i class="fas fa-hashtag"></i> 123</p>
            <p><i class="fas fa-user-tie"></i> tipoooo</p>
            <p><i class="fas fa-envelope"></i> emailemail@email.com</p>
            <p><i class="fas fa-birthday-cake"></i> nascimento</p>
            <p><i class="fas fa-phone-alt"></i> telefone</p>
        </div>
        <div>
            <button class="btn-del"><i class="fas fa-times"></i></button>
        </div>
    </div>-->
</div>

<script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
<script src="js/requisicoesUsuario.js"></script>