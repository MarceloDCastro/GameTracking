<?php

    $urlSite = "http://localhost/GameTrackingOficialv3/"; //Para evitar problemas ao usar link de css ou imagens com htaccess (variável está em index.php, nav.php e geral.js)

    $url = (isset($_GET['url'])) ? $_GET['url']:'publicações'; //Se existir a variável url, pega seu valor. Se não, deixa vazio
    $url = array_filter(explode('/',$url)); //Separa pela barra, tirando o ultimo item se for vazio

    $file = $url[0].'.php';

    if(is_file($file)){
        include($file);
    } else{
        include('404.php');
    }

?>