<?php 

//import do arquivo para iniciar as dependencias da API
require_once("vendor/autoload.php"); 

//Instancia da classe app
$app = new \Slim\App();

$app->get('/', function ($request, $response, $args){ // get ('/' = site/api/ (/pedido) ou raiz ,  function ($request, $response, $args){} 
    //request = pedido | response = dados/resposta | args = argumentos
    return $response->getBody()->write("API FastParking"); //para enviar dados no body do protocolo http ou escrever uma mensagem para o usuario
}); 

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

$app->get('/entradaPorId/{id}' , function ($request, $response, $args){
    
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

$app->get('/entradaPorPlaca/{placa}' , function ($request, $response, $args){
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


$app->run();