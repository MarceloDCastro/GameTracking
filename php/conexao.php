<?php

try{
    $pdo = new PDO('mysql:host=localhost;dbname=gametracking','root','root');
} catch (Exception $e){
    echo nl2br("Erro ao conectar com o banco de dados! \n").$e;
}
?>