'use strict';




const entradaDados = (option) => {
    let url = "";
    switch(option){
        case("entrada"):
            url = '../api/index.php/estadia';
            fetch(url).then(response => response.json()).then(data => preencher(data));
            break;
        case("saida"):
            url = '../api/index.php/estadia';
            fetch(url).then(response => response.json()).then(data => saida(data));
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
            <h1>${dados.placa}</h1>
            <h2>${dados.nome}</h2>
        </div>
        <div class="entradaHorario">
            <h1>Horário de Entrada:${dados.horaDaEntrada}</h1>
        </div>
    </div>
    `;

    return div;
}

const preencherSaida = (dados) => {
    const div = document.createElement('div');
    // div.classList.add('container1');

    const data = new Date();
    let hora = data.getHours() -1;
    const horaDeEntrada = dados.horaDaEntrada.split(':', 1);

    const resultado = 12 + ((hora - horaDeEntrada) * 6);

    console.log(dados);
    if(dados.horaDaSaida == null){
        div.innerHTML = `
        <div class="saidaCardContainer">
            <div class="saidaNome">
                <h1>${dados.placa}</h1>
                <h3>${dados.nome}</h3>
                <h2>Horário de Entrada:${dados.horaDaEntrada}</h2>
                <h6>Id:${dados.idEstadia}</h6>
            </div>
            <div class="saidaPreco">
                <h1>R$:` + resultado + `,00</h1>
                <button>Calcular saída</button>
            </div>
        </div>`
    }
;

    return div;
}


const preencher = (dados) => {
    const dadosJson = dados.estadias;
    const container = document.querySelector('.containerCard');
    
    dadosJson.forEach(element => {
        container.appendChild(preencherEntrada(element));
    });
}


const saida = (dados) => {
    const dadosJson = dados.estadias;
    const container = document.querySelector('#saidaCards');
    
    dadosJson.forEach(element => {
        container.appendChild(preencherSaida(element));
    });
}

entradaDados('entrada');
entradaDados('saida');
