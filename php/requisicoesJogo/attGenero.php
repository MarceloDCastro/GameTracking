<?php
require_once('../conexao.php');

$cd = $_POST['cd'];
$nome = $_POST['nome'];      
$caracteresProibidos = ["<",">",";",",","!","?","/","|","#","$","%","&","¨","*","(",")","{","}","[","]","'",'"'];

if ($nome == ''){
    // Campo nulo
    echo '{"icon":"error","title":"Preencha o campo!"}';
} else{
    foreach($caracteresProibidos as $i){
        if ( strpos($nome, $i)){
            // Tem caractere proibido                
            echo '{"icon":"error","title":"Existem caracteres proibídos!"}';
            die();
        }
    }
    // Genero cadastrado
    $sql = $pdo->prepare("UPDATE tb_Genero SET nm_Genero = ? WHERE cd_Genero = ?");
    $sql->execute(Array($nome,$cd));
    echo '{"icon":"success","title":"Gênero atualizado!"}';
}
?>