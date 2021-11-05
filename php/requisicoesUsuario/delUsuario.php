<?php
    require_once('../conexao.php');

    $cd = $_POST['cd'];

    $sql = $pdo->query("DELETE FROM tb_Usuario WHERE cd_Usuario = $cd");
        
    echo '{"icon":"success","title":"Usuário deletado!"}';
?>