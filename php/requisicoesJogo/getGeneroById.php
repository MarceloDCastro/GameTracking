<?php
require_once('../conexao.php');

$cd = $_POST['cd'];

$sql = $pdo->query("SELECT * FROM tb_Genero WHERE cd_Genero = $cd");
echo json_encode($sql->fetch()); 
?>