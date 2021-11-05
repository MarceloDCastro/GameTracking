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

    <!-- CSS Página Cadastro -->
    <link rel="stylesheet" href="<?php echo $urlSite ?>css/formularios.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <title>Cadastro | GameTracking</title>
  </head>
  <body>

    <header>
      <?php include('nav.php'); ?>
    </header>

    <?php
        if(isset($_SESSION['email'])){
          // Logado
          echo '<div class="aviso-logado"><h2>Você já está logado!</h2><p>Não é possível realizar o cadastro de uma conta se já estiver logado.</p><a href="'.$urlSite.'"><button><i class="fas fa-arrow-circle-left"></i> Voltar para Página Inicial</button></a></div>';
          die();
        }
    ?>

    <div class="container login cadastro">

      <h2>Cadastro</h2>

      <form method="POST">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" name="nome" id="nome" placeholder=" " minlength="3" maxlength="45">
          <label for="nome">Nome</label>
        </div>

        <div class="form-floating mb-3">
          <input type="email" class="form-control" name="email" id="email" placeholder=" ">
          <label for="email" class="form-label">Email</label>
        </div>

        <div class="form-floating mb-3">
          <input type="password" class="form-control" name="senha" id="senha" placeholder=" ">
          <label for="senha" class="form-label">Senha</label>
        </div>

        <div class="form-floating mb-3">
          <input type="password" class="form-control" name="confirmarSenha" id="confirmarSenha" placeholder=" ">
          <label for="confirmarSenha" class="form-label">Confirmar Senha</label>
        </div>

        <div class="form-floating mb-3">
          <input type="text" class="form-control " name="telefone" id="telefone" placeholder=" " oninput="mascaraTelefone()" maxlength="15">
          <label for="tel" class="form-label">Telefone</label>
        </div>

        <div class="form-floating mb-3">
          <input type="date" class="form-control" id="nascimento" name="nascimento">
          <label for="nascimento" class="form-label">Data de Nascimento:</label>  
        </div>

        <button type="submit" class="btn btn-primary" name="cadastrar">Cadastrar</button>
      </form>

    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="<?php echo $urlSite ?>js/geral.js"></script>

  </body>
</html>

<?php
    if(isset($_POST['cadastrar'])){
        //Clicou em cadastrar
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $confirmarSenha = $_POST['confirmarSenha'];
        $telefone = $_POST['telefone'];
        $nascimento = $_POST['nascimento'];
        $caracteresProibidos = ["<",">",";",",","!","?","/","|","#","$","%","&","¨","*","(",")","{","}","[","]","'",'"'];

        if ($nome == '' || $email == '' || $senha == ''|| $confirmarSenha == '' || $nascimento == ''){
            // Campo nulo
            echo "
            <script language='javascript'>
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Preencha os campos necessários!',
                    showConfirmButton: false,
                    timer: 2000
                })
            </script>";
            die();
        } elseif ($senha !== $confirmarSenha){
            echo "
                <script language='javascript'>
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Senhas diferentes!',
                        showConfirmButton: false,
                        timer: 3000
                    })
                </script>";
            die();
        } else{
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
                $sql = $pdo->prepare("INSERT INTO tb_Usuario VALUES (null,?,?,?,?,?,1,null)");
                $sql->execute(Array($nome,$email,$senha,$telefone,$nascimento));
                $dados = $sql->fetchAll(PDO::FETCH_ASSOC);

                    // Logado
                $sql = $pdo->prepare("SELECT * FROM tb_Usuario WHERE ds_Email = ?");
                $sql->execute(Array($email));
                $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
                $_SESSION['email'] = $dados[0]['ds_Email'];
                $_SESSION['tipo'] = $dados[0]['ic_Tipo'];
                $_SESSION['nome'] = $dados[0]['nm_Usuario'];
                echo "<script>location.href='".$urlSite."'</script>";
            }
        }
    }
?>