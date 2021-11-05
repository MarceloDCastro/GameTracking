<?php
    require_once('conexao.php');
    
    $sql = $pdo->query("SELECT cd_Publicacao,nm_Titulo,ds_Publicacao,DATE_FORMAT(dt_Publicacao, '%d/%m/%Y %H:%i') as dt_Publicacao,ds_Tipo,nm_Imagem FROM tb_Publicacao");
    if($sql->rowCount() > 0){
        $dados = $sql->fetchAll(PDO::FETCH_ASSOC);

        $i = 0;

        /*for($i = 0; $i <= 1; $i++){
            if(strlen($x['ds_Publicacao']) > 100){
                // Texto maior que 100 caracteres
                $str = substr($dados[$i]['ds_Publicacao'], 0, 100) + '...';
                $dados[$i]['ds_Publicacao'] = $str;
            }
            $i++;
        }

        foreach($dados as $x){
            if(strlen($x['ds_Publicacao']) > 100){
                // Texto maior que 100 caracteres
                $str = substr($x['ds_Publicacao'], 0, 100) + '...';
                $dados[$i]['ds_Publicacao'] = $str;
                $i++
            }
        }*/

        echo json_encode($dados); 
    }else{
        echo json_encode("Nenhum gênero encontrado"); 
    }
?>