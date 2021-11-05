const urlSite = "http://localhost/GameTrackingOficialv3/"; //Para evitar problemas ao usar link de css ou imagens com htaccess (variável está em index.php, nav.php e geral.js)

function confirmarLogout(){
    Swal.fire({
        title: 'Não nos abandone <i class="far fa-sad-tear"></i>',
        text: "Deseja mesmo sair da sua conta?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d44',
        confirmButtonText: 'Sim',
        cancelButtonText: 'Não'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href= urlSite+'?logout'
        }
      })
}

function mascaraTelefone(){
  var inputTel = document.querySelector("#telefone");
  var tel = inputTel.value;
  var final = tel[(tel.length-1)];

  if ("0123456789".includes(final)){
      // Se ultimo elemento for um número e a string for menor que 12:
      tel = tel.replace('(','').replace(")","").replace(" ","").replace("-",""); // Deixa apenas numeros

      if(tel.length < 3){
          tel = "("+tel+")";
      } else if(tel.length < 7){
          tel = "("+tel.substring(0,2)+") "+tel.substring(2,(tel.length));
      } else if(tel.length < 11){
          tel = "("+tel.substring(0,2)+") "+tel.substring(2,6)+"-"+tel.substring(6,(tel.length));
      } else if(tel.length < 12){
          tel = "("+tel.substring(0,2)+") "+tel.substring(2,7)+"-"+tel.substring(7,(tel.length));
      } else{
          // Maior que o limite
          tel = tel.substring(0,11);
          tel = "("+tel.substring(0,2)+") "+tel.substring(2,7)+"-"+tel.substring(7,(tel.length));
      }


  } else{
       // Se não for um número, o ultimo elemento é excluído:
       var tel = tel.slice(0, -1);
  }

  inputTel.value = tel;
}