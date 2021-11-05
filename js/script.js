window.addEventListener("load", () => {
    // Ao carregar a página

    // Botão de busca
    var btnBusca = document.querySelector('#btn-busca');
    if (btnBusca) {
        btnBusca.addEventListener('click', () => {
            buscar();
        })
    }
    // Barra de busca
    var barraBusca = document.querySelector('#busca');
    if (barraBusca) {
        barraBusca.addEventListener('keyup', () => {
            buscar();
        })
    }

    // Botão gênero
    var botaoGenero = document.querySelector('#botao-genero');
    if (botaoGenero) {
        botaoGenero.addEventListener('click', () => {
            if(document.querySelector(".fa-chevron-right")){
                mostrarGeneros();
            } else{
                esconderGeneros();
            }
        })
    }
});

// Buscar
function buscar(){
    
    // Input do usuário
    var input = document.querySelector('#busca').value;

    // Div com informações dos jogos
    var conteudo = document.querySelectorAll('.card-body');

    conteudo.forEach((x)=>{
        var nomeJogo = x.childNodes[1].innerHTML;

        var resultado = nomeJogo.toUpperCase().indexOf(input.toUpperCase());

        if(resultado >= 0){
            x.parentNode.parentNode.style.display = "";  
        }
        else{
            x.parentNode.parentNode.style.display = "none"     ;      
        }
    })
}

function mostrarGeneros(){
    let generos = document.querySelector('#div-generos');
    generos.style.display = 'block';

    let botao = document.querySelector('#botao-genero');
    botao.innerHTML = "Gêneros <i class='fas fa-chevron-down'></i>";
    botao.style.border = 'none';

    let div = document.querySelector('#div-genero');
    div.style.border = '1px solid #2ecc71';
    div.style.borderRadius = '10px';
}

function esconderGeneros(){
    let generos = document.querySelector('#div-generos');
    generos.style.display = 'none';

    let botao = document.querySelector('#botao-genero');
    botao.innerHTML = "Gêneros <i class='fas fa-chevron-right'></i>";
    botao.style.border = '1px solid #2ecc71';

    let div = document.querySelector('#div-genero');
    div.style.border = 'none';
}