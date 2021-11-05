<?php
require_once('../conexao.php');

$cdJogo = $_POST['cdJogo'];

$sql = $pdo->query("SELECT cd_Genero FROM tb_JogoGenero WHERE cd_Jogo = $cdJogo");
echo json_encode($sql->fetchAll(PDO::FETCH_ASSOC)); 
?>