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

    const horaDeEntrada = dados.horaDaEntrada.split(':', 1);
    const dataDeEntrada = dados.dataDaEntrada.split('-', 3);
    let diferenca = dados.diferenca;
    let resultado = 12;
    if (diferenca != null) {
        diferenca = dados.diferenca.split(':', 1) - 1;
        console.log(diferenca);
    }

    if (diferenca < 0) {
        diferenca = 0;
    }

    resultado += (diferenca * 6);

    if (dados.pago == 0) {
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
                    <button onclick="calcularSaida(${dados.idEstadia})">Calcular</button>
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
    switch (opcao) {

        case ("entrada"):
            dadosJson = dados.estadias;
            container = document.querySelector('.containerCard');
            container.innerHTML = "";

            dadosJson.forEach(element => {
                container.appendChild(preencherEntrada(element));
            });

            break;

        case ("saida"):
            dadosJson = dados.estadias;
            container = document.querySelector('#saidaCards');
            container.innerHTML = "";

            dadosJson.forEach(element => {
                container.appendChild(preencherSaida(element));
            });
            break;

        case ("usuarios"):
            dadosJson = dados.Usuarios;
            container = document.querySelector('#usuarios');
            container.innerHTML = "";

            dadosJson.forEach(element => {
                container.appendChild(preencherUsuarios(element))
            });
            break;
    }
}


const calcularSaida = (id) => {
    const time = data.getHours() + ":" + data.getMinutes() + ":" + data.getSeconds();
    const dataTime = data.getFullYear() + "-" + (data.getMonth() + 1) + "-" + data.getDate();


    const dados = {
        "idEstadia": id,
        "pago": 0,
        "valor": 0.0,
        "dataDaSaida": dataTime,
        "horaDaSaida": time
    };

    const url = `../api/index.php/estadia/saida`;
    const options = {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(dados)
    };

    fetch(url, options);

    setTimeout(() => {
        entradaDados('saida');
    }, 250);
}



function createEntrada(dados) {
    const url = '../api/index.php/estadia';
    const options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(dados)
    };
    fetch(url, options);
    setTimeout(() => {
        entradaDados('entrada');
    }, 250);
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


    createEntrada(dados);
}

const excluirUsuario = (usuarioId) => {
    if (confirm("Deseja mesmo excluir este usuário?")) {
        const url = `../api/index.php/usuario/${usuarioId}`;
        const options = {
            method: 'DELETE'
        };

        fetch(url, options).then(response => console.log(response));
        setTimeout(() => {
            entradaDados('usuarios');
        }, 250);
    }
}

const ativarUsuario = (usuarioId) => {
    const dados = {
        "idUsuario": usuarioId
    };
    console.log(dados);
    const url = `../api/index.php/usuario/ativarDesativar/${usuarioId}`;
    const options = {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(dados)
    };


    fetch(url, options).then(response => console.log(response));
    setTimeout(() => {
        entradaDados('usuarios');
    }, 250);
}


const checkInput = (element) => {
    if (element.value == "") {
        alert('Sem tempo irmão');
    }
}




entradaDados('entrada');
entradaDados('saida');
entradaDados('usuarios');