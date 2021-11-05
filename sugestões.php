<?php
  session_start();
  require_once('php/conexao.php');
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
      <!-- CSS Geral -->
      <link rel="stylesheet" href="<?php echo $urlSite ?>css/geral.css">

      <!-- CSS Página Sugestoes -->
      <link rel="stylesheet" href="<?php echo $urlSite ?>css/formularios.css">

    <title>Sugestões - GameTracking</title>
  </head>
  <body>

    <header>
      <?php
        include('nav.php');
      ?>
    </header>


    <div class="container login cadastro sugestoes">

      <h2>Sugestões</h2>

      <form method="POST">
        <div class="form-floating mb-3">
          <?php 
            if(isset($_SESSION['email'])){
              // Logado
              echo '<input type="email" class="form-control" disabled value="'.$_SESSION['email'].'" name="email" id="email" placeholder=" ">';
            }else{
              // Deslogado
              echo '<input type="email" class="form-control" disabled value="É necessário estar logado para enviar sugestões" name="email" id="email" placeholder=" " style="color: #FA8072 !important;">';
            }
          ?>
          <label for="email" class="form-label">Email:</label>
        </div>
        <div class="form-floating mb-3">
          <input type="text" minlength="3" maxlength="45" class="form-control" name="assunto" id="assunto" placeholder=" " autocomplete="off">
          <label for="tel" class="form-label">Assunto:</label>
        </div>
        <div class="form-floating mb-3 mensagens">
          <textarea class="form-control" id="msg" minlength="10" maxlength="300" name="mensagem" placeholder=" "></textarea>
          <label for="msg" class="form-label">Mensagem</label>
        </div>
        <?php 
            if(isset($_SESSION['email'])){
              // Logado
              echo '<button type="submit" class="btn btn-primary" name="enviar">Enviar sugestão</button>';
            }else{
              // Deslogado
              echo '<button type="submit" class="btn btn-primary" name="enviar" disabled>Enviar sugestão</button>';
            }
          ?>
      </form>
    </div>

    <br>
    
    <?php
         include('footer.php');
      ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>

<?php 
  if(isset($_POST['enviar'])){
    //Clicou em enviar
    $email = $_SESSION['email'];
    $assunto = $_POST['assunto'];
    $mensagem = $_POST['mensagem'];
    $caracteresProibidosSugestao = ["<",">",";","/","|","#","$","%","&","¨","*","(",")","{","}","[","]","'",'"'];

    if ($email == '' || $assunto == '' || $mensagem == ''){
        // Campo nulo
        echo "
        <script language='javascript'>
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Preencha os campos!',
                showConfirmButton: false,
                timer: 2000
            })
        </script>";
        die();
    } else{
        foreach($caracteresProibidosSugestao as $i){
            if ( strpos($email, $i) || strpos($assunto, $i) || strpos($mensagem, $i)){
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

        $sql = $pdo->prepare("SELECT cd_Usuario FROM tb_Usuario WHERE ds_Email = ?");
        $sql->execute(Array($email));
        $dados = $sql->fetch();
        
        $cdUsuario = $dados['cd_Usuario'];
        
        //Verificar quantidade de emails
        $sql = $pdo->prepare("SELECT count(cd_Sugestao) as qtSugestoes FROM tb_Sugestao WHERE cd_Usuario = ?");
        $sql->execute(Array($cdUsuario));
        $dados = $sql->fetch();
        if($dados['qtSugestoes'] >= 3){
            // Passou o limite de sugestões
            echo "
                    <script language='javascript'>
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Você excedeu o limite de sugestões (3)',
                            showConfirmButton: false,
                            timer: 4000
                        })
                    </script>";
            die();
        } else{
            // Sugestão enviada
            $sql = $pdo->prepare("INSERT INTO tb_Sugestao VALUES (null,?,?,NOW"."(),?)");
            $sql->execute(Array($assunto,$mensagem,$cdUsuario));
            $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
            echo "
                    <script language='javascript'>
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Sugestão enviada com sucesso!',
                            showConfirmButton: false,
                            timer: 3000
                        })
                    </script>";
        }
    }
  }
?>