function getPlataforma(){
    $.ajax({
        url: 'php/requisicoesPlataforma/getPlataforma.php',
        method: 'GET',
        dataType: 'json',
        success: (r)=>{
            $('#plataformas').html('');
            r.forEach(x => {
                $('#plataformas').prepend('<tr><td>' + x.cd_Plataforma + '</td><td>' + x.nm_Plataforma + '</td><td><button class="btn btn-sm" x-data="{ cd: '+x.cd_Plataforma+' }" x-on:click="attPlataforma(cd)"><i class="fas fa-pencil-alt"></i></button><button class="btn btn-sm" x-data="{ cd: '+x.cd_Plataforma+' }" x-on:click="delPlataforma(cd)"><i class="fas fa-times"></i></button></td></tr>');
            });
        }
    })
}

getPlataforma();

function addPlataforma(){
    Swal.fire({
        title: 'Cadastro de Plataformas',
        html:
          '<div class="input-group mb-3"><span class="input-group-text" id="basic-addon1">Nome</span><input type="text" name="nome" id="nome" class="form-control" placeholder="Nome"></div>',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Cadastrar',
        }).then((result) => {
            if (result.isConfirmed) {
                var nome = $("#nome").val();
                $.ajax({
                    url: 'php/requisicoesPlataforma/addPlataforma.php',
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
                        getPlataforma();
                    }
                })
            }
        })
}

function delPlataforma(cd){
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success mx-2',
          cancelButton: 'btn btn-danger mx-2'
        },
        buttonsStyling: false
      })
      
      swalWithBootstrapButtons.fire({
        title: 'Tem certeza?',
        text: "Deseja excluir este plataforma?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sim',
        cancelButtonText: 'Não',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'php/requisicoesPlataforma/delPlataforma.php',
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
                    getPlataforma();
                }
            })
        }
      })
}

function attPlataforma(cd){
    $.ajax({
        url: 'php/requisicoesPlataforma/getPlataformaById.php',
        method: 'POST',
        data: {
            cd: cd
        },
        dataType: 'json',
        success: (r)=>{
            Swal.fire({
                title: 'Atualização de Plataformas',
                html:
                  '<div class="input-group mb-3"><span class="input-group-text" id="basic-addon1">Nome</span><input type="text" name="nome" id="nomeAtt" class="form-control" placeholder="Nome" value="'+r.nm_Plataforma+'" aria-label="Username" aria-describedby="basic-addon1"></div>',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: 'Atualizar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        var nome = $('#nomeAtt').val();
                        $.ajax({
                            url: 'php/requisicoesPlataforma/attPlataforma.php',
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
                                getPlataforma();
                            }
                        })
                    }
                })
        }
    })
}