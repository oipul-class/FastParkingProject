'use strict';
const data = new Date();



const entradaDados = (option) => {
    let url = "";
    switch (option) {
        case ("entrada"):
            url = '../api/index.php/estadia';
            fetch(url).then(response => response.json()).then(data => preencher(data, 'entrada'));
            break;
        case ("saida"):
            url = '../api/index.php/estadia';
            fetch(url).then(response => response.json()).then(data => preencher(data, 'saida'));
            break;
        case ("usuarios"):
            url = '../api/index.php/usuario';
            fetch(url).then(response => response.json()).then(data => preencher(data, 'usuarios'));
            break;
    }
}

const preencherEntrada = (dados) => {
    const div = document.createElement('div');
    div.classList.add('container');
    console.log(dados);
    div.innerHTML = `
    <div class="entradaCard">
        <div class="entradaNome">
            <h1>${dados.placaDoVeiculo}</h1>
            <h2>${dados.nomeDoCliente}</h2>
        </div>
        <div class="entradaHorario">
            <h1>Horário de Entrada:${dados.horaDaEntrada}</h1>
        </div>
    </div>
    `;

    return div;
}
const preencherUsuarios = (dados) => {
    const div = document.createElement('div');
    console.log(dados);
    div.innerHTML = `
    <div class="usuariosContainer">
        <div class="usuarioFoto">
            <div class="usuarioIcon">
                <img src="../images/user.svg" alt="Foto do usuário">
            </div>
            <div class="usuarioNome">
                <h1>${dados.nome}</h1>
                <h2>Função:${dados.nivelAcesso}</h2>
            </div>
        </div>
        <div class="usuarioOptions">
            <div class="containerOptions">
                <img src="../images/view.svg" alt="Foto da option view">
                <img src="../images/pen.svg" alt="Foto da option edit">
                <img src="../images/erase.svg" alt="Foto da option erase" onclick="excluirUsuario('${dados.idUsuario}')">
                <img src="../images/right.svg" alt="Foto da option activate" onclick="ativarUsuario('${dados.idUsuario}')">
            </div>
        </div>
    </div>
    `;

    return div;
}

const preencherSaida = (dados) => {
    const div = document.createElement('div');
    // div.classList.add('container1');
    let resultado = null;

    let dataInicio = new Date(dados.dataDaEntrada);
    let dataFim = new Date(data.getFullYear() + "-" + (data.getMonth() + 1) + "-" + data.getDate());
    let diffMilissegundos = dataFim - dataInicio;
    let diffSegundos = diffMilissegundos / 1000;
    let diffMinutos = diffSegundos / 60;
    let diffHoras = diffMinutos / 60;
    let diffDias = diffHoras / 24;
    let diffMeses = diffDias / 30;

    let hora = data.getHours() - 1;
    let dia = data.getDate();

    const horaDeEntrada = dados.horaDaEntrada.split(':', 1);
    const dataDeEntrada = dados.dataDaEntrada.split('-', 3);

    let diferencaDeHoras = horaDeEntrada - hora;
    console.log(diferencaDeHoras)

    if (diffDias == 0) {
        resultado = 12 + ((diferencaDeHoras) * 6);
    } else {
        let diferencaDeDias = (dia - dataDeEntrada[2]) * 24;
        resultado = 12 + ((diferencaDeHoras + diffDias) * 6)
    }

    if (dados.horaDaSaida == null) {
        div.innerHTML = `
        <div class="saidaCardContainer">
            <div class="saidaNome">
                <h1>${dados.placaDoVeiculo}</h1>
                <h3>${dados.nomeDoCliente}</h3>
                <h2>Horário de Entrada:${dados.horaDaEntrada}</h2>
                <h6>Id:${dados.idEstadia}</h6>
            </div>
            <div class="saidaPreco">
                <h1>R$:${resultado},00</h1>
                <div class="pagarSaida">
                    <button>Calcular</button>
                    <button>Pagar</button>
                </div>
            </div>
        </div>`
    };

    return div;
}


const preencher = (dados, opcao) => {
    let dadosJson = null;
    let container = null;
    switch(opcao){

        case("entrada"):
            dadosJson = dados.estadias;
            container = document.querySelector('.containerCard');

            dadosJson.forEach(element => {
                container.appendChild(preencherEntrada(element));
            });

        break;

        case("saida"):
            dadosJson = dados.estadias;
            container = document.querySelector('#saidaCards');
        
            dadosJson.forEach(element => {
                container.appendChild(preencherSaida(element));
            });
        break;
            
        case("usuarios"):
            dadosJson = dados.Usuarios;
            container = document.querySelector('#usuarios');
        
            dadosJson.forEach(element => {
                container.appendChild(preencherUsuarios(element))
            });
        break;
    }
}

entradaDados('entrada');
entradaDados('saida');
entradaDados('usuarios');



function createEntrada(dados) {
    const url = '../api/index.php/estadia';
    const options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(dados)
    };
    fetch(url, options).then(response => console.log(response))
}

const getDados = () => {
    const nomeDoCliente = document.querySelector('#entradaNome').value;
    const placaDoCliente = document.querySelector('#placaCliente').value;
    const time = data.getHours() + ":" + data.getMinutes() + ":" + data.getSeconds();
    const dataInsert = data.getFullYear() + "-" + (data.getMonth() + 1) + "-" + data.getDate();

    const dados = {
        "nomeDoCliente": nomeDoCliente,
        "placaDoVeiculo": placaDoCliente,
        "dataDaEntrada": dataInsert,
        "horaDaEntrada": time,
        "pago": 0,
        "valor": 0.0
    };
    console.log(dados)


    createEntrada(dados);
}

const excluirUsuario = (usuarioId) => {
    const url = `../api/index.php/usuario/${usuarioId}`;
    const options = {
        method: 'DELETE'
    };

    fetch(url, options).then(response => console.log(response));
}




//   createEntrada(dados);