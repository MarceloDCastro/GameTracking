<?php
    session_start();
    require_once('php/conexao.php');

    if(!isset($_SESSION['email'])){
        //Deslogado
        header('location:'.$urlSite.'publicações');
    } else{
        // Logado
        if($_SESSION['tipo'] != 0){
            // Usuario
            header('location:'.$urlSite.'publicações');
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    
    
    <link rel="stylesheet" href="css/geral.css">

    <link rel="stylesheet" href="css/admin.css">
        
    <link rel="stylesheet" href="css/formularios.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <title>Admin | GameTracking</title>
</head>
<body>
    <?php
        include('nav.php');
    ?>

    <h2>Área do Administrador</h2>

    <div class="menu-admin">
        <div>
            <a href="?painel">Painel</a>
        </div>
        <div>
            <a href="?publicacao">Publicações</a>
        </div>
        <div>
            <a href="?sugestao">Sugestões</a>
        </div>
        <div>
            <a href="?jogo">Jogos</a>
        </div>
        <div>
            <a href="?genero">Gêneros</a>
        </div>
        <div>
            <a href="?usuario">Usuários</a>
        </div>
        <div>
            <a href="?plataforma">Plataformas</a>
        </div>
    </div>

    <?php
        if(isset($_GET['publicacao'])){
            include('crud_publicacao.php');
        } elseif(isset($_GET['painel'])){
            include('painel.php');
        } elseif(isset($_GET['sugestao'])){
            include('crud_sugestao.php');
        } elseif(isset($_GET['genero'])){
            include('crud_genero.php');
        } elseif(isset($_GET['jogo'])){
            include('crud_jogo.php');
        } elseif(isset($_GET['usuario'])){
            include('crud_usuario.php');
        } elseif(isset($_GET['plataforma'])){
            include('crud_plataforma.php');
        }

        include('footer.php');
    ?>

<script src="js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>