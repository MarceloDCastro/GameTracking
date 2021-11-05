<?php
require_once('../conexao.php');

$inicio = $_POST['resultadoInicial'];
$qtResultadosPag = $_POST['qtResultadosPag'];

if (isset($_POST['resultadoInicial'])){
    $sql = $pdo->query("SELECT cd_Publicacao,nm_Titulo,ds_Publicacao,DATE_FORMAT(dt_Publicacao, '%d/%m/%Y %H:%i') as dt_Publicacao,ds_Tipo,im_Publicacao FROM tb_Publicacao Order by dt_Publicacao DESC LIMIT $inicio,$qtResultadosPag");
    echo json_encode($sql->fetchAll(PDO::FETCH_ASSOC));
}
?>