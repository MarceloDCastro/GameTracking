function getGenero(){
    $.ajax({
        url: 'php/requisicoesGenero/getGenero.php',
        method: 'GET',
        dataType: 'json',
        success: (r)=>{
            $('#generos').html('');
            r.forEach(x => {
                $('#generos').prepend('<tr><td>' + x.cd_Genero + '</td><td>' + x.nm_Genero + '</td><td><button class="btn btn-sm" x-data="{ cd: '+x.cd_Genero+' }" x-on:click="attGenero(cd)"><i class="fas fa-pencil-alt"></i></button><button class="btn btn-sm" x-data="{ cd: '+x.cd_Genero+' }" x-on:click="delGenero(cd)"><i class="fas fa-times"></i></button></td></tr>');
            });
        }
    })
}

getGenero();

function addGenero(){
    Swal.fire({
        title: 'Cadastro de Gêneros',
        html:
          '<div class="input-group mb-3"><span class="input-group-text" id="basic-addon1">Nome</span><input type="text" name="nome" id="nome" class="form-control" placeholder="Nome"></div>',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Cadastrar',
        }).then((result) => {
            if (result.isConfirmed) {
                var nome = $("#nome").val();
                $.ajax({
                    url: 'php/requisicoesGenero/addGenero.php',
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
                        getGenero();
                    }
                })
            }
        })
}

function delGenero(cd){
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
                url: 'php/requisicoesGenero/delGenero.php',
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
                    getGenero();
                }
            })
        }
      })
}

function attGenero(cd){
    $.ajax({
        url: 'php/requisicoesGenero/getGeneroById.php',
        method: 'POST',
        data: {
            cd: cd
        },
        dataType: 'json',
        success: (r)=>{
            Swal.fire({
                title: 'Atualização de Gêneros',
                html:
                  '<div class="input-group mb-3"><span class="input-group-text" id="basic-addon1">Nome</span><input type="text" name="nome" id="nomeAtt" class="form-control" placeholder="Nome" value="'+r.nm_Genero+'" aria-label="Username" aria-describedby="basic-addon1"></div>',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: 'Atualizar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        var nome = $('#nomeAtt').val();
                        $.ajax({
                            url: 'php/requisicoesGenero/attGenero.php',
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
                                getGenero();
                            }
                        })
                    }
                })
        }
    })
}