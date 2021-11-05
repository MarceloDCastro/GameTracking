<?php
require_once('../conexao.php');

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
    //Verificar se plataforma já existe
    $sql = $pdo->prepare("SELECT count(cd_Plataforma) as qtPlataforma FROM tb_Plataforma WHERE nm_Plataforma = ?");
    $sql->execute(Array($nome));
    $dados = $sql->fetch();
    if($dados['qtPlataforma'] > 0){
        // Já existe esse plataforma
        echo '{"icon":"error","title":"Esta plataforma já existe!"}';
    } else{
        // Plataforma cadastrado
        $sql = $pdo->prepare("INSERT INTO tb_Plataforma VALUES (null,?)");
        $sql->execute(Array($nome));
        echo '{"icon":"success","title":"Plataforma adicionada!"}';
    }
}
?>