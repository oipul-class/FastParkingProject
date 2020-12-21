'use strict';
const data = new Date();
let precoInicial = 12;
let precoPorHora = 6;

const insertDadosPreco = (dados) => {
    if (dados==undefined) {
        const urlPreco = '../api/index.php/preco'
        fetch(urlPreco).then(response => response.json()).then(data => insertDadosPreco(data.Preco[0]));
    } else {
        precoInicial = dados.precoEntrada;
        precoPorHora = dados.precoAdicional;
    }

}

insertDadosPreco(undefined);

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
            <img src="../images/erase.svg" alt="Foto da option erase" onclick="excluirEstadia('${dados.idEstadia}')" class="excluirEstadia">
        </div>
    </div>
    `;

    return div;
}
const preencherUsuarios = (dados) => {
    let imagemStatus = "right.svg";
    if(dados.statusUsuario == 0){
        imagemStatus = "right_desativado.svg"
    }

    const div = document.createElement('div');
    div.innerHTML = `
    <div class="usuariosContainer">
        <div class="usuarioFoto">
            <div class="alterarFoto">
                <div class="usuarioIcon">
                    <img src="../userPictures/${dados.foto}" alt="Foto do usuário">
                </div>
            </div>
                <div class="usuarioNome">
                    <h1>${dados.nome}</h1>
                    <h2>Função:${dados.nivelAcesso}</h2>
                </div>
            
        </div>
        <div class="usuarioOptions">
            <div class="containerOptions">
                <img src="../images/pen.svg" alt="Foto da option edit" onclick="editarUsuario(${dados.idUsuario})">
                <img src="../images/erase.svg" alt="Foto da option erase" onclick="excluirUsuario('${dados.idUsuario}')">
                <img src="../images/${imagemStatus}" alt="Foto da option activate" onclick="ativarUsuario('${dados.idUsuario}')">
            </div>
        </div>
    </div>
    `;

    return div;
}

const preencherSaida = (dados) => {
    
    const div = document.createElement('div')
    const horaDeEntrada = dados.horaDaEntrada.split(':', 1);
    const dataDeEntrada = dados.dataDaEntrada.split('-', 3);
    let diferenca = dados.diferenca;
    let resultado = precoInicial;

    console.log(resultado);
    if (diferenca != null) {
        diferenca = dados.diferenca.split(':', 1) - 1;
    }

    if (diferenca < 0) {
        diferenca = 0;
    }

    const conta = (diferenca * precoPorHora)
    
    if (conta!=0) {
        resultado += resultado + conta
    }
    
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
                    <button onclick="pagarSaida(${dados.idEstadia}, 1, ${resultado})">Pagar</button>
                </div>
                <img src="../images/erase.svg" alt="Foto da option erase" onclick="excluirEstadia('${dados.idEstadia}')" class="excluirEstadia">
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
            container = document.querySelector('#users');
            container.innerHTML = "";

            dadosJson.forEach(element => {
                container.appendChild(preencherUsuarios(element))
            });
            break;
    }
}

const excluirEstadia = (id) => {
    if (confirm("Deseja mesmo excluir este usuário?")) {
        const url = `../api/index.php/estadia/${id}`;
        const options = {
            method: 'DELETE'
        };

        fetch(url, options)
        setTimeout(() => {
            entradaDados('saida');
        }, 2000);
        setTimeout(() => {
            entradaDados('entrada');
        }, 2000);
    }
}

const showModal = (option, dados) => {
    const modal = document.querySelector('#modal');
    const modalContainer = document.querySelector('#modalContainer');
    if (modal.classList[0] == "ocultar") {
        setTimeout(() => {
            modal.classList.replace("ocultar", "visualizar");
        }, 500);
        modalContainer.innerHTML = "";
        switch (option) {
            case ("editar"):
                modalContainer.innerHTML = `
                <div id="modalImg">
                    <img src="../images/erase.svg" alt="imagem para fechar" onclick='fecharModal()'>
                </div>
                <div class="camposEdit">
                    <label>
                        Digite o nome:
                    </label>
                    <input type="text" placeholder="Nome do Usuário" value="${dados.nome}" id="editName">
                </div>
                <div class="camposEdit">
                    <label>
                        Digite a senha:
                    </label>
                    <input type="password" placeholder="Senha" value="${dados.senha}" id="editPassword">
                </div>
                <div class="camposEdit">
                    <label>
                        Nível de Acesso:
                    </label>
                    <select id="editSelect">
                        <option value="0">Nenhum</option>
                        <option value="1">Entrada</option>
                        <option value="2">Saída</option>
                        <option value="3">Administrador</option>
                    </select>
                </div>
                <div class="camposEdit">
                    <label>
                        Mudar a foto:
                    </label>
                    <form action="../api/index.php/usuario/Imagem/${dados.idUsuario}" enctype="multipart/form-data" method="POST">
                        <div class="enviarFoto">
                            <label for="fileForm">Clique aqui para enviar uma foto</label>
                            <input type="file" id="fileForm" name="foto">
                            <input type="submit">
                        </div>
                    </form>
                </div>
                <button class="buttonEnviar" onclick="updateUsuario(${dados.idUsuario}, ${dados.statusUsuario})">
                    Registrar
                </button>
                `;
                const select = document.getElementById('editSelect');
                select.selectedIndex = dados.nivelAcesso;
                break;
            case ("buscar"):
                let dataSaida = null;
                let valor = null;
                let pago = null;
                if (dados.dataDaSaida == null || dados.horaDaSaida == null) {
                    dataSaida = "Não foi atribuida.";
                    valor = "Não foi atribuido.";
                    pago = "Não foi pago"
                } else {
                    dataSaida = dados.dataDaSaida + ":" +
                        dados.horaDaSaida;
                    valor = dados.valor;
                    pago = "Pago";
                }

                modalContainer.innerHTML = `
                    <div id="modalImg">
                        <img src="../images/erase.svg" alt="imagem para fechar" onclick='fecharModal()'>
                    </div>
                    <div class="camposEdit">
                        <label>
                            Id da Estadia:
                        </label>
                        <h1>${dados.idEstadia}</h1>
                    </div>
                    <div class="camposEdit">
                        <label>
                            Placa do Cliente:
                        </label>
                        <h1>${dados.placaDoVeiculo}</h1>
                    </div>
                    <div class="camposEdit">
                        <label>
                            Nome do Cliente:
                        </label>
                        <h1>${dados.nomeDoCliente}</h1>
                    </div>
                    <div class="camposEdit">
                        <label>
                            Hora e data da entrada:
                        </label>
                        <h1>${dados.dataDaEntrada}:${dados.horaDaEntrada}</h1>
                    </div>
                    <div class="camposEdit">
                        <label>
                            Hora e data da saida:
                        </label>
                        <h1>${dataSaida}</h1>
                    </div>
                    <div class="camposEdit">
                        <label>
                            Valor da a ser pago:
                        </label>
                        <h1>${valor}</h1>
                    </div>
                    <div class="camposEdit">
                        <label>
                            Se foi pago:
                        </label>
                        <h1>${pago}</h1>
                    </div>`;
                break;
        }
    }
}

const fecharModal = () => {
    const modal = document.querySelector('#modal');
    setTimeout(() => {
        modal.classList.replace("visualizar", "ocultar");
    }, 100);
}

const editarUsuario = (id) => {
    const url = `../api/index.php/usuario/${id}`;
    fetch(url).then(response => response.json()).then(data => showModal("editar", data.Usuriao[0]));
}

const buscarEstadia = () => {
    const id = document.getElementById('buscarRegistros').value;
    const url = `../api/index.php/estadia/${id}`;
    fetch(url).then(response => response.json()).then(data => showModal("buscar", data.Encontrado[0]));
}

const updateUsuario = (id, statusUsuario) => {
    const name = document.getElementById('editName').value;
    const password = document.getElementById('editPassword').value;
    const nivel = document.querySelector('#editSelect').selectedIndex;

    const dados = {
        "idUsuario": id,
        "nome": name,
        "senha": password,
        "nivelAcesso": nivel,
        "statusUsuario": statusUsuario
    };

    const url = "../api/index.php/usuario";
    const options = {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(dados)
    };

    fetch(url, options).then(response => modal.classList.replace("visualizar", "ocultar"));
    setTimeout(() => {
        entradaDados('usuarios');
    }, 250);
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

const pagarSaida = (id, pago, valor) => {
    const time = data.getHours() + ":" + data.getMinutes() + ":" + data.getSeconds();
    const dataTime = data.getFullYear() + "-" + (data.getMonth() + 1) + "-" + data.getDate();


    const dados = {
        "idEstadia": id,
        "pago": pago,
        "valor": valor,
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
    setTimeout(() => {
        entradaDados('saida');
    }, 2000);
}

const getDados = (option) => {
    let dados = null;
    switch (option) {
        case ('entrada'):
            const nomeDoCliente = document.querySelector('#entradaNome').value;
            const placaDoCliente = document.querySelector('#placaCliente').value;
            const time = data.getHours() + ":" + data.getMinutes() + ":" + data.getSeconds();
            const dataInsert = data.getFullYear() + "-" + (data.getMonth() + 1) + "-" + data.getDate();

            dados = {
                "nomeDoCliente": nomeDoCliente,
                "placaDoVeiculo": placaDoCliente,
                "dataDaEntrada": dataInsert,
                "horaDaEntrada": time,
                "pago": 0,
                "valor": 0.0
            };


            createEntrada(dados);
            break;
        case ('usuario'):
            const nomeDoUsuario = document.querySelector('#userName').value;
            const senhaDoUsuario = document.querySelector('#userPassword').value;
            const nivelDeAcesso = document.querySelector('#userLevel').selectedIndex;

            dados = {
                "nome": nomeDoUsuario,
                "senha": senhaDoUsuario,
                "nivelAcesso": nivelDeAcesso,
                "foto": "noImage.png"
            };

            insertUsers(dados);
            break;
    }
}

const excluirUsuario = (usuarioId) => {
    if (confirm("Deseja mesmo excluir este usuário?")) {
        const url = `../api/index.php/usuario/${usuarioId}`;
        const options = {
            method: 'DELETE'
        };

        fetch(url, options).then(
            setTimeout(() => {
                entradaDados('saida');
            }, 450));

    }
}

const ativarUsuario = (usuarioId) => {
    const dados = {
        'idUsuario': usuarioId
    };
    const url = `../api/index.php/usuario/ativarDesativar/${usuarioId}`;
    const options = {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(dados)
    };
    console.log(options)


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
const insertUsers = (dados) => {
    const url = '../api/index.php/usuario';
    const options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(dados)
    };
    fetch(url, options).then(response => console.log(response));
    setTimeout(() => {
        entradaDados('usuarios');
    }, 250);
    console.log(dados);
}

const atualizarPreco = () => {
    const precoPorHora = document.getElementById('inputPrecoHora').value;
    const precoInicial = document.getElementById('inputPrecoInicial').value;
    const dados = {
        "precoEntrada": precoInicial.replace(',', "."),
        "precoAdicional": precoPorHora.replace(',', ".")
    }
    const url = '../api/index.php/preco';
    const options = {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(dados)
    };
    // console.log(dados);
    fetch(url, options) //.then(response => console.log(response));

}

const inputRelatorio = document.getElementById('relatorioInput');

const filtrarData = () => inputRelatorio.value == inputRelatorio.value;


const loadRelatorio = () => {
    const url = '../api/index.php/estadia';
    const dataDividida = inputRelatorio.value.split('-', 3);

    fetch(url).then(response => response.json()).then(data => {
        const dados = data.estadias
        const porDias = (dados) => dados.dataDaEntrada == inputRelatorio.value;
        const porMeses = (dados) => dados.dataDaEntrada.split('-', 3)[1] == dataDividida[1];
        const porAno = (dados) => dados.dataDaEntrada.split('-', 3)[0] == dataDividida[0];
        const soma = (n1, n2) => n1 + n2;
        const ganhos = document.querySelectorAll('.ganhos');
        console.log(ganhos)


        const dataPorDias = dados.filter(porDias);
        const dataPorMeses = dados.filter(porMeses);
        const dataPorAno = dados.filter(porAno);
        let totalMeses = calcularValor(dataPorMeses)
        let totalDias = calcularValor(dataPorDias)
        let totalAno = calcularValor(dataPorAno)


        ganhos[0].innerHTML = `R$:${totalDias.reduce(soma, 0)}`;
        ganhos[1].innerHTML = `R$:${totalMeses.reduce(soma, 0)}`;
        ganhos[2].innerHTML = `R$:${totalAno.reduce(soma, 0)}`;
    });
}

inputRelatorio.addEventListener('blur', loadRelatorio);


const calcularValor = (dados) => {
    let numeros = [];
    const soma = (a, b) => a + a;

    for (let i = 0; i <= dados.length - 1; i++) {
        numeros[i] = parseFloat(dados[i].valor);
        // console.log(numeros);
    }
    return numeros;
}


entradaDados('entrada');
entradaDados('saida');
entradaDados('usuarios');