function mudarPagina(pagina){
    window.scrollTo({top: 180});
    getPublicacao(pagina);
}

function getPublicacao(pagina){
    // Resultados por página
    var qtResultadosPag = 12;
    $.ajax({
        url: 'php/requisicoesPublicacao/getQtPublicacao.php',
        method: 'POST',
        dataType: 'json',
        success: (r)=>{
            // Quantidade de resultados
            var qtResultados = r[0];
            if (qtResultados > 0){
                $('#resultados').html('<p>'+ qtResultados +' resultados encontrados</p>');
                // Quantidade de páginas
                var qtPaginas = Math.trunc(qtResultados/qtResultadosPag);
                if (qtResultados > qtResultadosPag && qtResultados%qtResultadosPag > 0){
                    qtPaginas = parseInt(qtPaginas) + 1;
                }
                // Resultado Inicial
                var resultadoInicial = (pagina - 1) * qtResultadosPag;

                $.ajax({
                    url: 'php/requisicoesPublicacao/getPublicacao.php',
                    method: 'POST',
                    data: {
                        resultadoInicial: resultadoInicial,
                        qtResultadosPag: qtResultadosPag
                    },
                    dataType: 'json',
                    success: (r)=>{
                        $('#publicacoes').html('');
                        r.forEach(x => {
                            if(x['ds_Publicacao']){
                                var dsPub = (x['ds_Publicacao']).slice(0,80) + "...";
                            }else{
                                var dsPub = x['ds_Publicacao'];
                            }
            
                            $('#publicacoes').append('<div class="col-md-4"><div class="card"><img src="#" alt="Imagem da publicação ' + x['nm_Titulo'] + '"><div class="card-header"><i class="fas fa-dollar-sign"></i> ' + x['ds_Tipo'] + '</div><div class="card-body"><h3 class="card-title">' + x['nm_Titulo'] + '</h3><p class="card-text texto">' + dsPub + '</p><a href="publicação/' + x['nm_Titulo'].replace(" ","-") + '" class="btn"> <i class="far fa-eye"></i> Ver Mais</a><span>' + x['dt_Publicacao'] + '</span></div></div></div>');
                        });
                        
                        // Paginação
                        $('#publicacoes').append('<div class="div-paginacao"><nav aria-label="Page navigation example"><ul class="pagination" id="lista-paginacao"></ul></nav></div>');

                        // Página anterior
                        if(pagina != 1){
                            $('#lista-paginacao').append('<li class="page-item"><button class="page-link" onclick="mudarPagina('+(pagina-1)+')"><span aria-hidden="true">&laquo;</span></button></li>');
                        }
                        
                        // Botões das páginas
                        if (qtPaginas <= 5){
                            for(let i = 1; i <= qtPaginas; i++){
                                if (pagina == i){
                                    // Página atual
                                    $('#lista-paginacao').append('<li class="page-item"><button class="page-link pagina-atual" id="'+i+'" onclick="mudarPagina('+i+')">'+i+'</button></li>');
                                }else{
                                    $('#lista-paginacao').append('<li class="page-item"><button class="page-link" id="'+i+'" onclick="mudarPagina('+i+')">'+i+'</button></li>');
                                }
                            }
                        } else if(pagina < 3){
                            for(let i = 1; i <= 5; i++){
                                if (pagina == i){
                                    // Página atual
                                    $('#lista-paginacao').append('<li class="page-item"><button class="page-link pagina-atual" id="'+i+'" onclick="mudarPagina('+i+')">'+i+'</button></li>');
                                }else{
                                    $('#lista-paginacao').append('<li class="page-item"><button class="page-link" id="'+i+'" onclick="mudarPagina('+i+')">'+i+'</button></li>');
                                }
                            }
                        } else if(pagina > (qtPaginas-2)){
                            for(let i = (qtPaginas-4); i <= qtPaginas; i++){
                                if (pagina == i){
                                    // Página atual
                                    $('#lista-paginacao').append('<li class="page-item"><button class="page-link pagina-atual" id="'+i+'" onclick="mudarPagina('+i+')">'+i+'</button></li>');
                                }else{
                                    $('#lista-paginacao').append('<li class="page-item"><button class="page-link" id="'+i+'" onclick="mudarPagina('+i+')">'+i+'</button></li>');
                                }
                            }
                        } else{
                            for(let i = (pagina-2); i <= (pagina+2); i++){
                                if (pagina == i){
                                    // Página atual
                                    $('#lista-paginacao').append('<li class="page-item"><button class="page-link pagina-atual" id="'+i+'" onclick="mudarPagina('+i+')">'+i+'</button></li>');
                                }else{
                                    $('#lista-paginacao').append('<li class="page-item"><button class="page-link" id="'+i+'" onclick="mudarPagina('+i+')">'+i+'</button></li>');
                                }
                            }
                        }
                        
                        // Próxima página
                        if(pagina != qtPaginas){
                            $('#lista-paginacao').append('<li class="page-item"><button class="page-link" onclick="mudarPagina('+(pagina+1)+')"><span aria-hidden="true">&raquo;</span></button></li>');
                        }
                    }
                })

            } else{
                // Nenhum resultado encontrado
            }
        }
    })
}

getPublicacao(1);