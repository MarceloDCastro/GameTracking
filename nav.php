<?php
    $urlSite = "http://localhost/GameTrackingOficialv3/"; //Para evitar problemas ao usar link de css ou imagens com htaccess (variável está em index.php, nav.php e geral.js)

    
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light menu-principal">
    <div class="container-fluid items-menu">
        <a class="navbar-brand" href="<?php echo $urlSite ?>">
            <img src="<?php echo $urlSite ?>images/logo.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
            <h1>GameTracking</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?php echo $urlSite ?>">Publicações</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $urlSite ?>sobre">Sobre Nós</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $urlSite ?>sugestões">Sugestões</a>
                </li>
                <?php
                    if(isset($_SESSION['email'])){
                        // Logado

                        if($_SESSION['tipo'] == 0){
                            // Admin
                            echo '
                                <li class="nav-item">
                                    <a class="nav-link" href="'.$urlSite.'admin.php?painel">Área Admin</a>
                                </li>';
                        }

                        echo '
                            <li>
                                <img class="nav-img" src="'.$urlSite.'images/semImagem.jpg">
                            </li>';
                        
                        /*echo '
                            <li class="nav-item">
                                <a class="nav-link" href="'.$urlSite.'?logout">Sair</a>
                            </li>';*/
                        
                    } else{
                        // Deslogado
                        echo '
                            <li class="nav-item">
                                <a class="nav-link" href="'.$urlSite.'cadastro">Cadastrar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="'.$urlSite.'login">Logar</a>
                            </li>';
                    }

                    if(isset($_GET['logout'])){
                        // Menu Logado
                        session_destroy();
                        header('location:'.$urlSite);
                    }
                ?>
            </ul>
            </div>
        </div>
</nav>