<?php
    require_once('../conexao.php');

    $cd = $_POST['cd'];

    $sql = $pdo->query("DELETE FROM tb_Plataforma WHERE cd_Plataforma = $cd");
        
    echo '{"icon":"success","title":"Plataforma deletada!"}';
?>