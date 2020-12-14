<?php

function listAllCliente() {
    require_once('conexaoMysql.php');

    if(!$conex = conexaoMysql())
    {
        echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
        //die; //Finaliza a interpretação da página
    }

    $sql = "select * from tblCliente";
    $select = mysqli_query($conex, $sql);

    

    while($rsCliente = mysqli_fetch_assoc($select)) {
        //varios itens para o json
        
        $dados[] = array (
            //          => - o que alimenta o dado de um array
            'idCliente'         => $rsCliente['idCliente'],
            'nome'             => $rsCliente['nome']

        );  
    } 
    
    $headerDados = array (
        'status' => 'success',
        'Clientes' => $dados
    );

    if (isset($dados))
        $listClienteJson = convertJson($headerDados);
    else 
        false;
    //verificar se foi gerado um arquivo json
    if (isset($listClienteJson)) 
        return $listClienteJson;
    else
        return false;

}

function listClientePorNome( $nome ) {

    require_once('conexaoMysql.php');

    if(!$conex = conexaoMysql())
    {
        echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
        //die; //Finaliza a interpretação da página
    }

    $sql = "select * from tblCliente where nome like '%". $nome . "%'";
    $select = mysqli_query($conex, $sql);

   
    

    while($rsCliente = mysqli_fetch_assoc($select)) {
        //varios itens para o json
        
        $dados[] = array (
            //          => - o que alimenta o dado de um array
            'idCliente'         => $rsCliente['idCliente'],
            'nome'             => $rsCliente['nome']

        );  
    } 
    
    $headerDados = array (
        'status' => 'success',
        'Clientes' => $dados
    );

    if (isset($dados))
        $listClienteJson = convertJson($headerDados);
    else 
        false;
    //verificar se foi gerado um arquivo json
    if (isset($listClienteJson)) 
        return $listClienteJson;
    else
        return false;

}

function insertCliente($dados) {
    require_once('conexaoMysql.php');

    if(!$conex = conexaoMysql())
    {
        echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
        //die; //Finaliza a interpretação da página
    }

    $nome = (string) null;

    $nome = $dados['nome'];

    $sql = "insert into tblCliente (nome) values('" . $nome . "')";
    
    if (mysqli_query($conex, $sql))   
    return convertJson($dados);
    else
    return false;

    
}


function convertJson($data) {
    header("Content-Type:applicantion/json"); // forçando o cabeçalho do arquivo a ser aplicação do tipo json
    $listJson = json_encode($data); // codificando em json   
    return $listJson;
}