// Listar Jogos

function getJogo(){
    $.ajax({
        url: 'php/requisicoesJogo/getJogo.php',
        method: 'GET',
        dataType: 'json',
        success: (r)=>{
            $('#jogos').html('');
            r.forEach(x => {
                $('#jogos').prepend('<div class="card-jogo"><div class="header-jogo"><p class="titulo-jogo">['+x.cd_Jogo+'] '+x.nm_Jogo+'</p><div class="acoes-jogo"><button><i class="fas fa-pencil-alt"></i></button><button><i class="fas fa-times"></i></button></div></div><div id="generos'+x.cd_Jogo+'"></div><div style="display:flex; justify-content: space-around" id="imgs'+x.cd_Jogo+'"></div></div>');
                getGenerosByJogo(x.cd_Jogo);
                // Listar imagens
                if(x.nm_Imagem1){
                    $('#imgs'+x.cd_Jogo).prepend('<img class="img-jogo" src="images/'+x.nm_Imagem1+'" alt="Primeira imagem do jogo">')
                } else{
                    $('#imgs'+x.cd_Jogo).prepend('<img class="img-jogo" src="images/semImagem.jpg" alt="Imagem não encontrada">')
                }
                if(x.nm_Imagem1){
                    $('#imgs'+x.cd_Jogo).prepend('<img class="img-jogo" src="images/'+x.nm_Imagem2+'" alt="Segunda imagem do jogo">')
                } else{
                    $('#imgs'+x.cd_Jogo).prepend('<img class="img-jogo" src="images/semImagem.jpg" alt="Imagem não encontrada">')
                }
                if(x.nm_Imagem1){
                    $('#imgs'+x.cd_Jogo).prepend('<img class="img-jogo" src=images/"'+x.nm_Imagem3+'" alt="Terceira imagem do jogo">')
                } else{
                    $('#imgs'+x.cd_Jogo).prepend('<img class="img-jogo" src="images/semImagem.jpg" alt="Imagem não encontrada">')
                }
            });
        }
    })
}

function getGenerosByJogo(cdJogo){
    $.ajax({
        url: 'php/requisicoesGenero/getGeneroByJogo.php',
        method: 'POST',
        data:{
            cdJogo: cdJogo
        },
        dataType: 'json',
        success: (r)=>{
            for(let i = 0; i < r.length; i++){
                $.ajax({
                    url: 'php/requisicoesGenero/getGeneroById.php',
                    method: 'POST',
                    data:{
                        cd: r[i].cd_Genero
                    },
                    dataType: 'json',
                    success: (r)=>{
                        $('#generos'+cdJogo).prepend('<p class="genero-jogo">'+r.nm_Genero+'</p>');
                    }
                })
            }
        }
    })
}

getJogo();

// Adicionar Jogos

function addJogo(){
    Swal.fire({
        title: 'Cadastro de Jogos',
        html:
          '<div class="input-group mb-3"><span class="input-group-text" id="basic-addon1">Nome</span><input type="text" name="nome" id="nome" class="form-control" placeholder="Nome"></div><div class="input-group mb-3"><div id="div-generos" x-data="{ open: false }"><button class="btn" @click="open = !open">Gêneros</button><div x-show="open" id="inputs-generos"></div></div></div><div class="mb-3"><input type="file" name="img1" id="img1" class="form-control"></div><div class="mb-3"><input type="file" name="img2" id="img2" class="form-control"></div><div class="mb-3"><input type="file" name="img3" id="img3" class="form-control"></div>',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Cadastrar',
        }).then((result) => {
            if (result.isConfirmed) {
                var nome = $("#nome").val();
                var generos= [];
                var imgs = new FormData();
                imgs.append('img1', $('#img1'));
                imgs.append('img2', $('#img2'));
                imgs.append('img3', $('#img3'));
                //Add generos
                var checkGeneros = $(".check-genero");
                for(let i=0; i<checkGeneros.length; i++){
                    if(checkGeneros[i].checked){
                        generos.push(checkGeneros[i]);
                    }
                }

                $.ajax({
                    url: 'php/requisicoesJogo/addJogo.php',
                    method: 'POST',
                    data: {
                        nome: nome,
                        generos: generos
                    },
                    dataType: 'json',
                    success: (r)=>{
                        Swal.fire({
                            icon: r.icon,
                            title: r.title,
                            showConfirmButton: false,
                            timer: 2000
                        });
                        getJogo();
                    }
                })
            }
        })
    getGeneros();
}

function getGeneros(){
    $.ajax({
        url: 'php/requisicoesGenero/getGenero.php',
        method: 'POST',
        dataType: 'json',
        success: (r)=>{
            for(let i = 0; i < r.length; i++){
                $('#inputs-generos').prepend('<div class="n-selecionado"><input class="check-genero" type="checkbox" name="generos[]" value="'+r[i].cd_Genero+'" id="'+r[i].nm_Genero+'"><label for="'+r[i].nm_Genero+'" onclick="mudaCorGenero(this)">'+r[i].nm_Genero+'</label></div>')
            }
        }
    })
}

function delJogo(cd){
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success mx-2',
          cancelButton: 'btn btn-danger mx-2'
        },
        buttonsStyling: false
      })
      
      swalWithBootstrapButtons.fire({
        title: 'Tem certeza?',
        text: "Deseja excluir este gênero?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sim',
        cancelButtonText: 'Não',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'php/requisicoesJogo/delJogo.php',
                method: 'POST',
                data: {
                    cd: cd
                },
                dataType: 'json',
                success: (r)=>{
                    Swal.fire({
                        icon: r.icon,
                        title: r.title,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    getJogo();
                }
            })
        }
      })
}

function attJogo(cd){
    $.ajax({
        url: 'php/requisicoesJogo/getJogoById.php',
        method: 'POST',
        data: {
            cd: cd
        },
        dataType: 'json',
        success: (r)=>{
            Swal.fire({
                title: 'Atualização de Gêneros',
                html:
                  '<div class="input-group mb-3"><span class="input-group-text" id="basic-addon1">Nome</span><input type="text" name="nome" id="nomeAtt" class="form-control" placeholder="Nome" value="'+r.nm_Jogo+'" aria-label="Username" aria-describedby="basic-addon1"></div>',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: 'Atualizar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        var nome = $('#nomeAtt').val();
                        $.ajax({
                            url: 'php/requisicoesJogo/attJogo.php',
                            method: 'POST',
                            data: {
                                cd: cd,
                                nome: nome
                            },
                            dataType: 'json',
                            success: (r)=>{
                                Swal.fire({
                                    icon: r.icon,
                                    title: r.title,
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                                getJogo();
                            }
                        })
                    }
                })
        }
    })
}

// Outros

function mudaCorGenero(x){
    var div = x.parentNode;
    if (div.className != "selecionado"){
        div.className = "selecionado";
    } else{
        div.className = "n-selecionado";
    }
}