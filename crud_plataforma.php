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

<h3>Plataformas</h3>

<button onclick="addPlataforma()" class="btn btn-primary botao-cadastrar"><i class="fas fa-plus-circle"></i> Cadastrar Plataforma</button>

<table id="plataformas">
    <tr>
        <th>Id</th>
        <th>Nome</th>
        <th>Ações</th>
    </tr>
</table>

<script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
<script src="js/requisicoesPlataforma.js"></script>