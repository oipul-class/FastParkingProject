<?php 

//import do arquivo para iniciar as dependencias da API
require_once("vendor/autoload.php"); 

//Instancia da classe app
$app = new \Slim\App();

$app->get('/', function ($request, $response, $args){ // get ('/' = site/api/ (/pedido) ou raiz ,  function ($request, $response, $args){} 
    //request = pedido | response = dados/resposta | args = argumentos
    return $response->getBody()->write("API FastParking"); //para enviar dados no body do protocolo http ou escrever uma mensagem para o usuario
}); 

// GETS --->

// Entradas
$app->get('/entrada' , function ($request, $response, $args){
    
    require_once("../php/apiEntrada.php");

    $listEntradas = listarEntradas(0,"");

    if($listEntradas) { // função para listar todos os contatos 
        return $response    -> withStatus(200)
                            -> withHeader('Content-Type', 'application/json')
                            -> write($listEntradas);
        //widthStatus (status http)
        //widthHeader ('Content-Type' , 'application/tipo')
        //write() escreve na tela
    }else {
        return $response    -> withStatus(204);
    } 

});

$app->get('/entrada/{id}' , function ($request, $response, $args){
    
    $id = $args['id'];

    require_once("../php/apiEntrada.php");

    $listEntradas = listarEntradas($id,"");

    if($listEntradas) { // função para listar todos os contatos 
        return $response    -> withStatus(200)
                            -> withHeader('Content-Type', 'application/json')
                            -> write($listEntradas);
        //widthStatus (status http)
        //widthHeader ('Content-Type' , 'application/tipo')
        //write() escreve na tela
    }else {
        return $response    -> withStatus(204);
    } 

});

$app->get('/entrada/placa/{placa}' , function ($request, $response, $args){
    $placa = (string) null;
    $placa = $args['placa'];
    
    require_once("../php/apiEntrada.php");

    $listEntradas = listarEntradas(0, $placa);

    if($listEntradas) { // função para listar todos os contatos 
        return $response    -> withStatus(200)
                            -> withHeader('Content-Type', 'application/json')
                            -> write($listEntradas);
        //widthStatus (status http)
        //widthHeader ('Content-Type' , 'application/tipo')
        //write() escreve na tela
    }else {
        return $response    -> withStatus(204);
    } 

});

// Saidas
$app->get('/saida' , function ($request, $response, $args){
    
    require_once("../php/apiSaida.php");

    $listSaidas = ListarSaida(0,"");

    if($listSaidas) { // função para listar todos os contatos 
        return $response    -> withStatus(200)
                            -> withHeader('Content-Type', 'application/json')
                            -> write($listSaidas);
        //widthStatus (status http)
        //widthHeader ('Content-Type' , 'application/tipo')
        //write() escreve na tela
    }else {
        return $response    -> withStatus(204);
    } 

});

$app->get('/saida/{id}' , function ($request, $response, $args){
    
    $id = $args['id'];

    require_once("../php/apiSaida.php");

    $listSaidas = ListarSaida($id,"");

    if($listSaidas) { // função para listar todos os contatos 
        return $response    -> withStatus(200)
                            -> withHeader('Content-Type', 'application/json')
                            -> write($listSaidas);
        //widthStatus (status http)
        //widthHeader ('Content-Type' , 'application/tipo')
        //write() escreve na tela
    }else {
        return $response    -> withStatus(204);
    } 

});

$app->get('/saida/placa/{placa}' , function ($request, $response, $args){
    $placa = (string) null;
    $placa = $args['placa'];
    
    require_once("../php/apiSaida.php");

    $listSaidas = ListarSaida(0, $placa);

    if($listSaidas) { // função para listar todos os contatos 
        return $response    -> withStatus(200)
                            -> withHeader('Content-Type', 'application/json')
                            -> write($listSaidas);
        //widthStatus (status http)
        //widthHeader ('Content-Type' , 'application/tipo')
        //write() escreve na tela
    }else {
        return $response    -> withStatus(204);
    } 

});

// Estadias

$app->get('/estadia' , function ($request, $response, $args){
    
    require_once("../php/apiEstadia.php");

    $listEstadia = listAllEstadia();

    if($listEstadia) { // função para listar todos os contatos 
        return $response    -> withStatus(200)
                            -> withHeader('Content-Type', 'application/json')
                            -> write($listEstadia);
        //widthStatus (status http)
        //widthHeader ('Content-Type' , 'application/tipo')
        //write() escreve na tela
    }else {
        return $response    -> withStatus(204);
    } 

});

// <---

$app->run();