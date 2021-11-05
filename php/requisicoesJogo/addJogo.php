<?php
require_once('../conexao.php');

$nome = $_POST['nome'];
$generos = $_POST['generos'];
$imgs = $_FILES['imgs'];
$caracteresProibidos = ["<",">",";",",","!","?","/","|","#","$","%","&","¨","*","(",")","{","}","[","]","'",'"'];

if ($nome == '' | !isset($generos[0])){
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
    //Verificar se genero já existe
    $sql = $pdo->prepare("SELECT count(cd_Genero) as qtGenero FROM tb_Genero WHERE nm_Genero = ?");
    $sql->execute(Array($nome));
    $dados = $sql->fetch();
    if($dados['qtGenero'] > 0){
        // Já existe esse genero
        echo '{"icon":"error","title":"Este gênero já existe!"}';
    } else{
        // Genero cadastrado
        $sql = $pdo->prepare("INSERT INTO tb_Genero VALUES (null,?)");
        $sql->execute(Array($nome));
        echo '{"icon":"success","title":"Gênero adicionado!"}';
    }
}
?>