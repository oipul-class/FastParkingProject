<?php 

//import do arquivo para iniciar as dependencias da API
require_once("vendor/autoload.php"); 

//Instancia da classe app
$app = new \Slim\App();

$app->get('/', function ($request, $response, $args){ // get ('/' = site/api/ (/pedido) ou raiz ,  function ($request, $response, $args){} 
    //request = pedido | response = dados/resposta | args = argumentos
    return $response->getBody()->write("API FastParking"); //para enviar dados no body do protocolo http ou escrever uma mensagem para o usuario
}); 

// GET'S --->
// Estadias
$app->get('/estadia' , function ($request, $response, $args){
    
    require_once("../php/apiEstadia.php");


    $listEstadia = listAllEstadia();

    if($listEstadia) { // função para listar todos os contatos 
        return $response    -> withStatus(200)
                            -> withHeader('Content-Type', 'application/json')
                            -> write($listEstadia);
    }else {
        return $response    -> withStatus(204);
    } 

});

$app->get('/estadia/{id}' , function ($request, $response, $args){

    $id = $args['id'];
    
    require_once("../php/apiEstadia.php");

    $listEstadia = listEstadiaById( $id );

    if($listEstadia) { // função para listar todos os contatos 
        return $response    -> withStatus(200)
                            -> withHeader('Content-Type', 'application/json')
                            -> write($listEstadia);
    }else {
        return $response    -> withStatus(204);
    } 

});


//usuarios
$app->get('/usuario', function ($request, $response, $args){
    require_once("../php/apiUsuario.php");

    $listUsuario = listAllUsuario();

    if($listUsuario) { // função para listar todos os contatos 
        return $response    -> withStatus(200)
                            -> withHeader('Content-Type', 'application/json')
                            -> write($listUsuario);
    }else {
        return $response    -> withStatus(204);
    } 
});

$app->get('/usuario/{id}', function ($request, $response, $args){
    require_once("../php/apiUsuario.php");

    $id = $args['id'];

    $listUsuario = listUsuarioPorId($id);

    if($listUsuario) { // função para listar todos os contatos 
        return $response    -> withStatus(200)
                            -> withHeader('Content-Type', 'application/json')
                            -> write($listUsuario);
    }else {
        return $response    -> withStatus(204);
    } 
});

//preços
$app->get('/preco', function ($request, $response, $args){
    require_once("../php/apiPreco.php");

    $listPreco = listPreco();

    if($listPreco) { // função para listar todos os contatos 
        return $response    -> withStatus(200)
                            -> withHeader('Content-Type', 'application/json')
                            -> write($listPreco);
    }else {
        return $response    -> withStatus(204);
    } 
});
// <---

//POST'S --->
//Estadia
$app->post('/estadia', function ($request, $response, $args){

    $contentType = $request->getHeaderLine('Content-Type'); // getHeaderLine permite pegar conteudo sobre o header

    if ($contentType == "application/json") {
        //recebe todos os dados enviados para a api
        $dadosJson = $request->getParsedBody(); 
        
        if ($dadosJson=="" || $dadosJson==null) {

            return $response    -> withStatus(400)
                                -> withHeader('Content-Type', 'application/json')
                                -> write('
                                    {
                                        "status":"Fail",
                                        "Message":"Dados enviados não podem ser nulos"
                                    }
                                    ');

        }else {
            //Require das funções
            require_once("../php/apiEstadia.php");
            
            
            //dados inseridos com sucesso
            $dados = insertEstadia($dadosJson);
            
            if ($dados) {
                return $response    -> withStatus(201)
                                    -> withHeader('Content-Type', 'application/json')
                                    -> write($dados); 
            }else { //falha na inserção dos dados
                return $response    -> withStatus(401)
                                    -> withHeader('Content-Type', 'application/json')
                                    -> write('
                                            {
                                                "status":"Fail",
                                                "Message":"Falha ao inserir os dados no BD. Verificar se os dados enviados estão corretos"
                                            }
                                            ');
            }
        }
    }
});

$app->post('/usuario', function ($request, $response, $args){

    $contentType = $request->getHeaderLine('Content-Type'); // getHeaderLine permite pegar conteudo sobre o header

    if ($contentType == "application/json") {
        //recebe todos os dados enviados para a api
        $dadosJson = $request->getParsedBody(); 
        
        if ($dadosJson=="" || $dadosJson==null) {

            return $response    -> withStatus(400)
                                -> withHeader('Content-Type', 'application/json')
                                -> write('
                                    {
                                        "status":"Fail",
                                        "Message":"Dados enviados não podem ser nulos"
                                    }
                                    ');

        }else {
            //Require das funções
            require_once("../php/apiUsuario.php");
            
            
            //dados inseridos com sucesso
            $dados = insertUsuario($dadosJson);
            
            if ($dados) {
                return $response    -> withStatus(201)
                                    -> withHeader('Content-Type', 'application/json')
                                    -> write($dados); 
            }else { //falha na inserção dos dados
                return $response    -> withStatus(401)
                                    -> withHeader('Content-Type', 'application/json')
                                    -> write('
                                            {
                                                "status":"Fail",
                                                "Message":"Falha ao inserir os dados no BD. Verificar se os dados enviados estão corretos"
                                            }
                                            ');
            }
        }
    }
});
//<---

//PUT'S --->
//Estadia
$app->put('/estadia', function($request, $response, $args){
    $contentType = $request->getHeaderLine('Content-Type'); // getHeaderLine permite pegar conteudo sobre o header

    if ($contentType == "application/json") {
        //recebe todos os dados enviados para a api
        $dadosJson = $request->getParsedBody(); 
        
        if ($dadosJson=="" || $dadosJson==null) {

            return $response    -> withStatus(400)
                                -> withHeader('Content-Type', 'application/json')
                                -> write('
                                    {
                                        "status":"Fail",
                                        "Message":"Dados enviados não podem ser nulos"
                                    }
                                    ');

        }else {
            //Require das funções
            require_once("../php/apiEstadia.php");
            
            
            //dados inseridos com sucesso
            $dados = updateEstadia($dadosJson);
            
            if ($dados) {
                return $response    -> withStatus(201)
                                    -> withHeader('Content-Type', 'application/json')
                                    -> write($dados); 
            }else { //falha na inserção dos dados
                return $response    -> withStatus(401)
                                    -> withHeader('Content-Type', 'application/json')
                                    -> write('
                                            {
                                                "status":"Fail",
                                                "Message":"Falha ao inserir os dados no BD. Verificar se os dados enviados estão corretos"
                                            }
                                            ');
            }
        }
    }
});

$app->put('/estadia/saida', function($request, $response, $args){
    $contentType = $request->getHeaderLine('Content-Type'); // getHeaderLine permite pegar conteudo sobre o header

    if ($contentType == "application/json") {
        //recebe todos os dados enviados para a api
        $dadosJson = $request->getParsedBody(); 
        
        if ($dadosJson=="" || $dadosJson==null) {

            return $response    -> withStatus(400)
                                -> withHeader('Content-Type', 'application/json')
                                -> write('
                                    {
                                        "status":"Fail",
                                        "Message":"Dados enviados não podem ser nulos"
                                    }
                                    ');

        }else {
            //Require das funções
            require_once("../php/apiEstadia.php");
            
            
            //dados inseridos com sucesso
            $dados = updateSaidaEstadia($dadosJson);
            
            if ($dados) {
                return $response    -> withStatus(201)
                                    -> withHeader('Content-Type', 'application/json')
                                    -> write($dados); 
            }else { //falha na inserção dos dados
                return $response    -> withStatus(401)
                                    -> withHeader('Content-Type', 'application/json')
                                    -> write('
                                            {
                                                "status":"Fail",
                                                "Message":"Falha ao inserir os dados no BD. Verificar se os dados enviados estão corretos"
                                            }
                                            ');
            }
        }
    }
});

//Usuarios
$app->put('/usuario', function($request, $response, $args){
    $contentType = $request->getHeaderLine('Content-Type'); // getHeaderLine permite pegar conteudo sobre o header

    if ($contentType == "application/json") {
        //recebe todos os dados enviados para a api
        $dadosJson = $request->getParsedBody(); 
        
        if ($dadosJson=="" || $dadosJson==null) {

            return $response    -> withStatus(400)
                                -> withHeader('Content-Type', 'application/json')
                                -> write('
                                    {
                                        "status":"Fail",
                                        "Message":"Dados enviados não podem ser nulos"
                                    }
                                    ');

        }else {
            //Require das funções
            require_once("../php/apiUsuario.php");
            
            
            //dados inseridos com sucesso
            $dados = updateUsuario($dadosJson);
            
            if ($dados) {
                return $response    -> withStatus(201)
                                    -> withHeader('Content-Type', 'application/json')
                                    -> write($dados); 
            }else { //falha na inserção dos dados
                return $response    -> withStatus(401)
                                    -> withHeader('Content-Type', 'application/json')
                                    -> write('
                                            {
                                                "status":"Fail",
                                                "Message":"Falha ao inserir os dados no BD. Verificar se os dados enviados estão corretos"
                                            }
                                            ');
            }
        }
    }
});

//Preços
$app->put('/preco', function($request, $response, $args){
    $contentType = $request->getHeaderLine('Content-Type'); // getHeaderLine permite pegar conteudo sobre o header

    if ($contentType == "application/json") {
        //recebe todos os dados enviados para a api
        $dadosJson = $request->getParsedBody(); 
        
        if ($dadosJson=="" || $dadosJson==null) {

            return $response    -> withStatus(400)
                                -> withHeader('Content-Type', 'application/json')
                                -> write('
                                    {
                                        "status":"Fail",
                                        "Message":"Dados enviados não podem ser nulos"
                                    }
                                    ');

        }else {
            //Require das funções
            require_once("../php/apiPreco.php");
            
            
            //dados inseridos com sucesso
            $dados = updatePrecos($dadosJson);
            
            if ($dados) {
                return $response    -> withStatus(201)
                                    -> withHeader('Content-Type', 'application/json')
                                    -> write($dados); 
            }else { //falha na inserção dos dados
                return $response    -> withStatus(401)
                                    -> withHeader('Content-Type', 'application/json')
                                    -> write('
                                            {
                                                "status":"Fail",
                                                "Message":"Falha ao inserir os dados no BD. Verificar se os dados enviados estão corretos"
                                            }
                                            ');
            }
        }
    }
});
//<---

//DELETES --->
//Usuarios
$app->delete('/usuario/{id}', function($request, $response, $args){
    
    $id = $args['id'];
    
    require_once("../php/apiUsuario.php");

    $listUsuario = deleteUsuario( $id );

    if($listUsuario) { // função para listar todos os contatos 
        return $response    -> withStatus(202)
                            -> withHeader('Content-Type', 'application/json')
                            -> write("Usuario deletado");
    }else {
        return $response    -> withStatus(204);
    } 
});

$app->delete('/estadia/{id}', function($request, $response, $args){
    
    $id = $args['id'];
    
    require_once("../php/apiEstadia.php");

    $listUsuario = deleteEstadia( $id );

    if($listUsuario) { // função para listar todos os contatos 
        return $response    -> withStatus(202)
                            -> withHeader('Content-Type', 'application/json')
                            -> write("Estadia deletada");
    }else {
        return $response    -> withStatus(204);
    } 
});



//<---

$app->run();