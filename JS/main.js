'use strict';
const data = new Date();



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

const preencherSaida = (dados) => {
    const div = document.createElement('div');
    // div.classList.add('container1');
    let resultado = null;

    let hora = data.getHours() -1;
    let dia = data.getDate();
    
    const horaDeEntrada = dados.horaDaEntrada.split(':', 1);
    const dataDeEntrada = dados.dataDaEntrada.split('-',3);

    let diferencaDeHoras = hora - horaDeEntrada;
    
    if(dia == dataDeEntrada[2]){
        resultado = 12 + ((diferencaDeHoras) * 6);
    }else{
       
        let diferencaDeDias = (dia - dataDeEntrada[2])*24;
        console.log('dia:' + dia, 'diferença:' + diferencaDeHoras, 'dataDeEntrada:' + dataDeEntrada,);
        resultado = 12 + ((diferencaDeHoras + diferencaDeDias) * 6)
    }

    console.log(dados);
    if(dados.horaDaSaida == null){
        div.innerHTML = `
        <div class="saidaCardContainer">
            <div class="saidaNome">
                <h1>${dados.placaDoVeiculo}</h1>
                <h3>${dados.nomeDoCliente}</h3>
                <h2>Horário de Entrada:${dados.horaDaEntrada}</h2>
                <h6>Id:${dados.idEstadia}</h6>
            </div>
            <div class="saidaPreco">
                <h1>R$:` + resultado + `,00</h1>
                <div class="pagarSaida">
                    <button>Calcular</button>
                    <button>Pagar</button>
                </div>
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



function createEntrada( dados ) {
    const url = '../api/index.php/estadia';
    const options = {
        method: 'POST',
        body: JSON.stringify( dados )
    };
    fetch(url, options ).then(response => console.log(response))
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
        "pago":0,
        "valor":0.0
    };
    console.log(dados)


    createEntrada(dados);
}



  
//   createEntrada(dados);