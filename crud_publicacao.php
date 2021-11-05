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

<h3>Publicações</h3>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="cadastrar-publicacao"><i class="fas fa-plus-circle"></i> Cadastrar Publicação
</button>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Cadastro de Publicações</h5>
        <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div id="cadastro-publicacao">
        <form method="POST" enctype="multipart/form-data">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" name="titulo" id="titulo" class="form-control">
                <br>
                <label for="texto" class="form-label">Texto:</label>
                <textarea class="form-control" name="texto" id="texto" rows="3" minlength="10" maxlength="300"></textarea>
                <br>
                <label for="tipo">Tipo:</label>
                <select name="tipo" id="tipo" class="form-select">
                    <option value="Grátis Tempo Limitado">Grátis Tempo Limitado</option>
                    <option value="Grátis">Grátis</option>
                    <option value="Promoção">Promoção</option>
                    <option value="Promoção">Lançameto</option>
                </select>
                <br>
                <label for="jogo">Jogo:</label>
                <select name="jogo" id="jogo" class="form-select">
                    <?php
                        $sql = $pdo->query("SELECT cd_Jogo,nm_Jogo FROM tb_Jogo");
                        $dados = $sql->fetchAll(PDO::FETCH_ASSOC);

                        foreach($dados as $x){
                            echo '
                            <option value="'.$x['cd_Jogo'].'">'.$x['nm_Jogo'].'</option>
                        ';
                        }
                    ?>
                </select>
                <br>
                <div id="div-genero">
                    <p id="botao-genero">Gêneros <i class="fas fa-chevron-right"></i></p>
                    <div id="div-generos" style="display: none;">
                        <?php
                            $sql = $pdo->query("SELECT cd_Genero, nm_Genero FROM tb_Genero");
                            $dados = $sql->fetchAll(PDO::FETCH_ASSOC);

                            foreach($dados as $x){
                                echo '
                                <div id="item-genero">
                                <input type="checkbox" name="generos[]" value="'.$x['cd_Genero'].'" id="'.$x['nm_Genero'].'">
                                <label for="'.$x['nm_Genero'].'">'.$x['nm_Genero'].'</label>
                                </div>';
                            }
                        ?>
                    </div>
                </div>
                <br>
                <div id="imagem-publicacao">
                    <label for="img-publicacao">Imagem:</label>
                    <input type="file" name="img-publicacao"> id="imgP">
                </div>
                    <img id="preview-imgP" src="">
                </div>
            </div>
            <input type="submit" name="cadastrar" id="cadastrar" value="Cadastrar">
        </form>
        </div>
      </div>
    </div>
  </div>
</div>

    <?php
    $sql = $pdo->query("SELECT * FROM tb_Publicacao ORDER BY nm_Titulo");
    $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
    foreach($dados as $x){
            echo '
                <div class="card mb-3" style="max-width: 1000px; margin: auto">
                    <div class="row g-0">
                    <span style="position: absolute; font-weight: 1000; font-size:20px">'.$x['cd_Publicacao'].'</span>
                        <div class="col-md-4">
                            <img src="..." class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body" style="border: 1px solid green; display: flex">
                                <div style="flex:15; border: solid 1px blue; margin-right: 10px;">
                                    <h4 class="card-title">'.$x['nm_Titulo'].'</h4>
                                    <p class="card-text">'.$x['ds_Publicacao'].'</p>
                                    <p class="card-text"><small class="text-muted">'.$x['dt_Publicacao'].'</small></p>
                                    <p class="card-text"><small class="text-muted">'.$x['ds_Tipo'].'</small></p>
                                </div>
                                <div style="flex:1">
                                    <button class="btn btn-primary btn-sm" style="margin-bottom:15px;">Editar</button>
                                    <button class="btn btn-danger btn-sm">Excluir</button>
                                </div>
                            </div>
                            <div style="display:flex; border: 1px solid red; margin-bottom:10px">
                                <img src="" width=100px height=100px" style="flex:1; margin-left:90px;">
                                <img src="" width=100px height=100px" style="flex:1">
                                <img src="" width=100px height=100px" style="flex:1">
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }

    if(isset($_POST['cadastrar'])){
        //Clicou em cadastrar

        $titulo = $_POST['titulo'];
        $texto = $_POST['titulo'];
        $data = $_POST['data'];
        $tipo = $_POST['tipo'];

        $caracteresProibidos = ["<",">",";",",","!","?","/","|","#","$","%","&","¨","*","(",")","{","}","[","]","'",'"'];

        if ($titulo == '' || $texto == '' || $data == ''|| $tipo == '' || !isset($_POST['generos']) || !isset($_POST['imgPerfil']) || !isset($_POST['imgUm']) || !isset($_POST['imgDois']) || !isset($_POST['imgTres'])){
            // Campo nulo
            echo "
            <script language='javascript'>
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Preencha todos os campos!',
                    showConfirmButton: false,
                    timer: 2000
                })
            </script>";
            die();
        } else{
            
            $generos = $_POST['generos'];
            $imgPerfil = $_POST['imgPerfil'];
            $imgUm = $_POST['imgUm'];
            $imgDois = $_POST['imgDois'];
            $imgTres = $_POST['imgTres'];
            foreach($caracteresProibidos as $i){
                if ( strpos($nome, $i) || strpos($email, $i) || strpos($senha, $i) || strpos($confirmarSenha, $i) || strpos($telefone, $i)){
                    // Tem caractere proibido                        
                    echo "
                        <script language='javascript'>
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Existem caracteres proibídos!',
                                showConfirmButton: false,
                                timer: 3000
                            })
                        </script>";
                    die();
                }
            }
             //Verificar se email já existe
            $sql = $pdo->prepare("SELECT count(ds_Email) as email FROM tb_Usuario WHERE ds_Email = ?");
            $sql->execute(Array($email));
            $dados = $sql->fetch();
            if($dados['email'] > 0){
                // Já existe esse email
                echo "
                        <script language='javascript'>
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Este email já foi cadastrado!',
                                showConfirmButton: false,
                                timer: 3000
                            })
                        </script>";
                die();
            } else{
                // Email cadastrado
                $sql = $pdo->prepare("INSERT INTO tb_Usuario VALUES (null,?,?,?,?,?,1)");
                $sql->execute(Array($nome,$email,$senha,$telefone,$nascimento));
                $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
                // Logado
                $sql = $pdo->prepare("SELECT * FROM tb_Usuario WHERE ds_Email = ?");
                $sql->execute(Array($email));
                $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
                $_SESSION['email'] = $dados[0]['ds_Email'];
                $_SESSION['tipo'] = $dados[0]['ic_Tipo'];
                $_SESSION['nome'] = $dados[0]['nm_Usuario'];
                header('location:index.php');
            }
        }
    }
?>