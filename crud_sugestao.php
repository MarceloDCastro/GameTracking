<?php
    $urlSite = "http://localhost/GameTrackingOficialv3/"; //Para evitar problemas ao usar link de css ou imagens com htaccess

    if(!isset($_SESSION['email'])){
        //Deslogado
        include('404.php');
        die();
    } else{
        // Logado
        if($_SESSION['tipo'] != 0){
            // Usuario
            include('404.php');
            die();
        }
    }
?>

<h3>Sugestões</h3>

<div id="list-sugestao">
    <?php
        $sql = $pdo->query("SELECT * FROM tb_Sugestao ORDER BY dt_Sugestao");
        $dados = $sql->fetchAll(PDO::FETCH_ASSOC);

        foreach($dados as $x){
            $cdUsuario=$x['cd_Usuario'];
            $q = $pdo->query("SELECT nm_Usuario,ds_Email FROM tb_Usuario WHERE cd_Usuario = $cdUsuario");
            $r = $q->fetch();
                echo '
                    <div>
                        <h4>['.$x['cd_Sugestao'].'] '.$x['nm_Assunto'].'</h4>
                        <p id="mensagem">'.$x["ds_Mensagem"].'</p>
                        <p id="usuario">Enviada por: '.$r[0].' ('.$r['ds_Email'].')</p>
                    </div>
                ';
            }
    ?>
</div>