function getUsuario(){
    $.ajax({
        url: 'php/requisicoesUsuario/getUsuario.php',
        method: 'GET',
        dataType: 'json',
        success: (r)=>{
            $('#usuarios').html('');
            r.forEach(x => {
                if(x.ic_Tipo == 0){
                    var tipo = "Administrador";
                } else {
                    var tipo = "Usuário";
                }

                $('#usuarios').append('<div class="div-card col d-flex justify-content-between"><div class="d-flex"><img src="images/user.png" alt="Imagem de Perfil de '+x.nm_Usuario+'" width="100" height="100"><div class="infos"><p class="nome">'+x.nm_Usuario+'</p><p><i class="fas fa-hashtag"></i> '+x.cd_Usuario+'</p><p><i class="fas fa-user-tie"></i> '+tipo+'</p><p><i class="fas fa-envelope"></i> '+x.ds_Email+'</p><p><i class="fas fa-birthday-cake"></i> '+x.dt_Nascimento+'</p></div></div><div><button class="btn-del" onclick="delUsuario('+x.cd_Usuario+')"><i class="fas fa-times"></i></button></div></div>');
                
                if (x.ds_Telefone != "" && x.ds_Telefone != null){
                    $('.infos').last().append('<p><i class="fas fa-phone-alt"></i> '+x.ds_Telefone+'</p>');
                }
            });
        }
    })
}

getUsuario();

function addUsuario(){
    Swal.fire({
        title: 'Cadastro de Usuários',
        html:
          '<div class="input-group mb-3"><span class="input-group-text" id="basic-addon1">Nome</span><input type="text" name="nome" id="nome" class="form-control" placeholder="Nome"></div>',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Cadastrar',
        }).then((result) => {
            if (result.isConfirmed) {
                var nome = $("#nome").val();
                $.ajax({
                    url: 'php/requisicoesUsuario/addUsuario.php',
                    method: 'POST',
                    data: {
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
                        getUsuario();
                    }
                })
            }
        })
}

function delUsuario(cd){
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success mx-2',
          cancelButton: 'btn btn-danger mx-2'
        },
        buttonsStyling: false
      })
      
      swalWithBootstrapButtons.fire({
        title: 'Tem certeza?',
        text: "Deseja excluir este usuário?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sim',
        cancelButtonText: 'Não',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'php/requisicoesUsuario/delUsuario.php',
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
                    getUsuario();
                }
            })
        }
      })
}

function attEmail(cd){
    $.ajax({
        url: 'php/requisicoesUsuario/getUsuarioById.php',
        method: 'POST',
        data: {
            cd: cd
        },
        dataType: 'json',
        success: (r)=>{
            Swal.fire({
                title: 'Atualização de Gêneros',
                html:
                  '<div class="input-group mb-3"><span class="input-group-text" id="basic-addon1">Nome</span><input type="text" name="nome" id="nomeAtt" class="form-control" placeholder="Nome" value="'+r.nm_Usuario+'" aria-label="Username" aria-describedby="basic-addon1"></div>',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: 'Atualizar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        var nome = $('#nomeAtt').val();
                        $.ajax({
                            url: 'php/requisicoesUsuario/attUsuario.php',
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
                                getUsuario();
                            }
                        })
                    }
                })
        }
    })
}