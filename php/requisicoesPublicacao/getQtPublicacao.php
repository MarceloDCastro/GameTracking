<?php
require_once('../conexao.php');

$sql = $pdo->query("SELECT count(cd_Publicacao) FROM tb_Publicacao");
echo json_encode($sql->fetch());
?>