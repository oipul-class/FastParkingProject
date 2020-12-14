'use strict';

const entradaDados = () => {
    const url = '../api/index.php/estadia';

    fetch(url).then(response => response.json()).then(data => preenche(data));

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


const preenche = (dados) => {
    const dadosJson = dados.estadias;
    const container = document.querySelector('.containerCard');
    
    dadosJson.forEach(element => {
        container.appendChild(preencherEntrada(element));
    });
}

entradaDados();
