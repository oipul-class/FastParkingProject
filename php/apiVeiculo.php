<?php


function listAllVeiculos() {
    require_once('conexaoMysql.php');

    if(!$conex = conexaoMysql())
    {
        echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
        //die; //Finaliza a interpretação da página
    }

    $sql = "select * from tblVeiculo";
    $select = mysqli_query($conex, $sql);

    

    while($rsVeiculo = mysqli_fetch_assoc($select)) {
        //varios itens para o json
        
        $dados[] = array (
            //          => - o que alimenta o dado de um array
            'idVeiculo'         => $rsVeiculo['idVeiculo'],
            'placa'             => $rsVeiculo['placa'],
            'marca'             => $rsVeiculo['marca'],
            'modelo'            => $rsVeiculo['modelo']
        );  
    } 
    
    $headerDados = array (
        'status' => 'success',
        'Veiculos' => $dados
    );

    if (isset($dados))
        $listVeiculoJson = convertJson($headerDados);
    else 
        false;
    //verificar se foi gerado um arquivo json
    if (isset($listVeiculoJson)) 
        return $listVeiculoJson;
    else
        return false;

}

function listVeiculoPorPlaca($placa) {
    require_once('conexaoMysql.php');

    if(!$conex = conexaoMysql())
    {
        echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
        //die; //Finaliza a interpretação da página
    }

    $sql = "select * from tblVeiculo where placa = '" . $placa ."'";
    $select = mysqli_query($conex, $sql);

    

    while($rsVeiculo = mysqli_fetch_assoc($select)) {
        //varios itens para o json
        
        $dados[] = array (
            //          => - o que alimenta o dado de um array
            'idVeiculo'         => $rsVeiculo['idVeiculo'],
            'placa'             => $rsVeiculo['placa'],
            'marca'             => $rsVeiculo['marca'],
            'modelo'            => $rsVeiculo['modelo']
        );  
    } 
    
    $headerDados = array (
        'status' => 'success',
        'Veiculos' => $dados
    );

    if (isset($dados))
        $listVeiculoJson = convertJson($headerDados);
    else 
        false;
    //verificar se foi gerado um arquivo json
    if (isset($listVeiculoJson)) 
        return $listVeiculoJson;
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