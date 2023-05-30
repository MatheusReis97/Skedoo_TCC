var baseURL = "https://chat-skedoo-2ae51-default-rtdb.firebaseio.com/";
var mensagensURL = baseURL + "mensagens.json";
var novaMensagem = "";
var id_remetente = "";
var id_destinatario = "";
var divMensagens = document.getElementById('div-mensagens');

function getRemetente() {
    fetch("/remetente", { mode: "no-cors" })
        .then((response) => response.text())
        .then((data) => {
            return (id_remetente = parseInt(data));
        });
}
getRemetente();

function getID(id) {
    id_destinatario = id;
    document.getElementById("nomeChat").innerHTML = document.getElementById(
        "nm" + id
    ).innerHTML;
    divMensagens.innerHTML =
        "<h3 style='height:100%; width:100%; text-align:center;'>Carregando...</h3>";
    atualizarMensagens();
    setTimeout(autoScroll,1000)
}

function enviarMensagem() {
    entrada = document.getElementById("mensagem");
    mensagemdig = entrada.value;
    if(mensagemdig == ""){
      return
    }
    entradaData = document.getElementById("data-atual").innerHTML;
    entradaHora = document.getElementById("hora-atual").innerHTML;
    fetch(
        "https://chat-skedoo-2ae51-default-rtdb.firebaseio.com/mensagens.json",
        {
            method: "POST",
            headers: { "Content-type": "application/json" },
            body: JSON.stringify({
                mensagem: mensagemdig,
                data: entradaData,
                hora: entradaHora,
                remetente: id_remetente,
                destinatario: id_destinatario,
            }),
        }
    );
    entrada.value = "";
    atualizarMensagens();
    setTimeout(autoScroll,1000)
}
function atualizarMensagens() {
    fetch(mensagensURL)
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            Object.values(data).forEach((mensagem) => {
                if (
                    mensagem.remetente == id_remetente &&
                    mensagem.destinatario == id_destinatario
                ) {
                    novaMensagem +=
                        "<div class='mensagem enviada'><p>" +
                        mensagem.mensagem +
                        "</p><span>" +
                        mensagem.data +
                        "</span></div>";
                }
                if (
                    mensagem.remetente == id_destinatario &&
                    mensagem.destinatario == id_remetente
                ) {
                    novaMensagem +=
                        "<div class='mensagem recebida'><p>" +
                        mensagem.mensagem +
                        "</p><span>" +
                        mensagem.data +
                        "</span></div>";
                }
            });
            if(divMensagens.innerHTML !="" || novaMensagem != ""){
              divMensagens.innerHTML = novaMensagem;
              novaMensagem = "";
            }
            if(divMensagens.innerHTML =="" && novaMensagem == ""){
              divMensagens.innerHTML =
              "<h3 style='height:100%; width:100%; text-align:center;'>Sem mensagens...</h3>";
            }
        })
        .catch((error) => {
            console.error(error);
        });
}

function autoScroll() {
  divMensagens.scrollTop = divMensagens.scrollHeight;
}

setInterval(atualizarMensagens,1000);