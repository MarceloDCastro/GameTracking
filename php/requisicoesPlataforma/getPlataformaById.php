<?php
require_once('../conexao.php');

$cd = $_POST['cd'];

$sql = $pdo->query("SELECT * FROM tb_Plataforma WHERE cd_Plataforma = $cd");
echo json_encode($sql->fetch()); 
?>