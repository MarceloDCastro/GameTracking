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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

      <!-- CSS Geral -->
      <link rel="stylesheet" href="<?php echo $urlSite ?>css/geral.css">

      <!-- CSS Página Logar -->
      <link rel="stylesheet" href="<?php echo $urlSite ?>css/formularios.css">

    <title>Login | GameTracking</title>
  </head>
  <body>

    <header>
      <?php
        include('nav.php');
      ?>
    </header>

    <?php
        if(isset($_SESSION['email'])){
          // Logado
          echo '<div class="aviso-logado"><h2>Você já está logado!</h2><p>Não é possível logar em duas contas ao mesmo tempo.</p><a href="'.$urlSite.'"><button><i class="fas fa-arrow-circle-left"></i> Voltar para Página Inicial</button></a></div>';
          die();
        }
    ?>


    <div class="container login">

    <h2>Login</h2>

      <form method="POST">
        <div class="form-floating mb-3">
          <input type="email" name="email" placeholder=" " class="form-control" id="email" aria-describedby="emailHelp" autocomplete="off">
          <label for="exampleInputEmail1" class="form-label"><i class="fas fa-at"></i> Email</label>
        </div>
        <div class="form-floating mb-3">
          <input type="password" name="senha" placeholder=" " class="form-control" id="senha">
          <label for="exampleInputPassword1" class="form-label"><i class="fas fa-lock"></i> Senha</label>
        </div>
        <button type="submit" class="btn btn-primary" name="logar">Logar</button>
      </form>


    </div>
    
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>

<?php
    if(isset($_POST['logar'])){
        // Clicou em logar
        $email = $_POST['email'];
        $senha= $_POST['senha'];
        $caracteresProibidos = ["<",">",";",",","!","?","/","|","#","$","%","&","¨","*","(",")","{","}","[","]","'",'"'];
    
        if($email == '' || $senha == ''){
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
        } else{
            foreach($caracteresProibidos as $i){
                if (strpos($email, $i) || strpos($senha, $i)){
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
    
            $sql = $pdo->prepare("SELECT * FROM tb_Usuario WHERE ds_Email = ?");
            $sql->execute(Array($email));
            $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
    
            if(isset($dados[0]) && $dados[0]['cd_Senha'] == $senha){
                // Logado
                $_SESSION['email'] = $dados[0]['ds_Email'];
                $_SESSION['tipo'] = $dados[0]['ic_Tipo'];
                $_SESSION['nome'] = $dados[0]['nm_Usuario'];
                echo "<script>location.href='".$urlSite."'</script>";
            } else{
                // Erro
                echo "
                        <script language='javascript'>
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Email ou senha incorretos!',
                                showConfirmButton: false,
                                timer: 3000
                            })
                        </script>";
            }
        }
    }
?>