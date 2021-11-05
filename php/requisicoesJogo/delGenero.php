<?php
    require_once('../conexao.php');

    $cd = $_POST['cd'];

    $sql = $pdo->query("DELETE FROM tb_Genero WHERE cd_Genero = $cd");
        
    echo '{"icon":"success","title":"Gênero deletado!"}';
?>