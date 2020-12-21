'use strict';

const carregarContainer = (option) => {
    const id = sessionStorage.getItem('userId');
    const url = `../api/index.php/usuario/${id}`;
    fetch(url).then(response => response.json()).then(data => nivelAcesso(data.Usuriao, option));
}

const nivelAcesso = (dados, option) => {

    const menuContainer = document.querySelectorAll('.menuItens');

    switch (option) {
        case ("entrada"):
            if (dados[0].nivelAcesso == 1 || dados[0].nivelAcesso == 3) {
                removeAll();
                menuContainer[0].classList.replace('ocultar', 'visualizarBlock');

            } else {
                alert("Você não tem permissão para acessar esta opção!")
            }
            break;
        case ("saida"):
            if (dados[0].nivelAcesso == 2 || dados[0].nivelAcesso == 3) {
                removeAll();
                menuContainer[1].classList.replace('ocultar', 'visualizarBlock');

            } else {
                alert("Você não tem permissão para acessar esta opção!")
            }
            break;
        case ("usuarios"):
            if (dados[0].nivelAcesso == 3) {
                removeAll();
                menuContainer[2].classList.replace('ocultar', 'visualizarBlock');

            } else {
                alert("Você não tem permissão para acessar esta opção!")
            }
            break;
        case ("dados"):
            if (dados[0].nivelAcesso == 3) {
                removeAll();
                menuContainer[3].classList.replace('ocultar', 'visualizarBlock');

            } else {
                alert("Você não tem permissão para acessar esta opção!")
            }
            break;
        default:
            break;
    }
}

const removeAll = (menuContainer) => {
    menuContainer = document.querySelectorAll('.menuItens');

    for (let i = 0; i <= menuContainer.length - 1; i++) {
        if (menuContainer[i].classList.contains('visualizar') || menuContainer[i].classList.contains('visualizarBlock')) {
            menuContainer[i].classList.remove('visualizar');
            menuContainer[i].classList.remove('visualizarBlock');
            menuContainer[i].classList.add('ocultar');
        }
    }
}

const logar = () => {
    const url = 'api/index.php/usuario';
    fetch(url).then(response => response.json()).then(dados => verificarUsuario(dados.Usuarios));
}

const verificarUsuario = (dados) => {
    const usuario = document.getElementById('loginUsuario').value;
    const senha = document.getElementById('senhaUsuario').value;
    const url = 'api/index.php/senha';
    const data = {
        "senha": senha
    }
    const options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    };
    fetch(url, options).then(response => response.json()).then(data => loginDados(usuario, data.senha, dados));
}

const loginDados = (usuario, senha, dados) => {
    console.log(dados)
    for (let index = 0; index < dados.length; index++) {
        if (usuario.toUpperCase() == dados[index].nome.toUpperCase() && dados[index].statusUsuario == 1) {
            
            if (senha == dados[index].senha) {
                sessionStorage.setItem('userId', dados[index].idUsuario);
                window.location.href = 'CMS/index.html';

            }
        }
    }
}