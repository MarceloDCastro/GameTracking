<?php
require_once('../conexao.php');

$sql = $pdo->query("SELECT * FROM tb_Plataforma");
echo json_encode($sql->fetchAll(PDO::FETCH_ASSOC)); 
?>