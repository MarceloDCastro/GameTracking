<?php
require_once('../conexao.php');

$sql = $pdo->query("SELECT cd_Usuario,nm_Usuario,ic_Tipo,ds_Email,cd_Senha,DATE_FORMAT(dt_Nascimento,'%d/%m/%Y') as dt_Nascimento,ds_Telefone,im_Usuario FROM tb_Usuario");
echo json_encode($sql->fetchAll(PDO::FETCH_ASSOC)); 
?>