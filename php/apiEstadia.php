<?php

    

function listAllEstadia() {

    

    require_once('conexaoMysql.php');

    if(!$conex = conexaoMysql())
    {
        echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
        //die; //Finaliza a interpretação da página
    }

    $sql = "select tblCliente.*, tblVeiculo.*, tblEstadia.* from tblCliente, tblVeiculo,  tblEstadia where tblEstadia.idCliente = tblCliente.idCliente and tblEstadia.idVeiculo = tblVeiculo.idVeiculo";
    $select = mysqli_query($conex, $sql);
    while($rsEstadia = mysqli_fetch_assoc($select)) {
    
            $dados[] = array (
                //          => - o que alimenta o dado de um array
                'idEstadia'             => $rsEstadia['idEstadia'],
                'idCliente'             => $rsEstadia['idCliente'],
                'nome'                  => $rsEstadia['nome'],
                'idVeiculo'             => $rsEstadia['idVeiculo'],
                'placa'                 => $rsEstadia['placa'],
                'marca'                 => $rsEstadia['marca'],
                'modelo'                => $rsEstadia['modelo'],
                'dataDaEntrada'         => $rsEstadia['dataDaEntrada'],
                'horaDaEntrada'         => $rsEstadia['horaDaEntrada'],
                'dataDaSaida'           => $rsEstadia['dataDaSaida'],
                'horaDaSaida'           => $rsEstadia['horaDaSaida'],
                'valor'                 => $rsEstadia['valor'],
                'pago'                  => $rsEstadia['pago']
            );  
        }  

    $headerDados = array (
        'status' => 'success',
        'estadias' => $dados
    );

    if (isset($dados))
        $listEstadiasJson = convertJson($headerDados);
    else 
        false;
    //verificar se foi gerado um arquivo json
    if (isset($listEstadiasJson)) 
        return $listEstadiasJson;
    else
        return false;
    
}

function listEstadiaById( $id ) {
    require_once('conexaoMysql.php');

    if(!$conex = conexaoMysql())
    {
        echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
        //die; //Finaliza a interpretação da página
    }

    $sql = "select tblCliente.*, tblVeiculo.*, tblEstadia.* from tblCliente, tblVeiculo, tblEstadia where tblEstadia.idCliente = tblCliente.idCliente and tblEstadia.idVeiculo = tblVeiculo.idVeiculo and tblEstadia.idEstadia = " . $id;
    $select = mysqli_query($conex, $sql);
    
    if ($rsEstadia = mysqli_fetch_assoc($select)) {
      
        $dados[] = array (
            //          => - o que alimenta o dado de um array
            'idEstadia'             => $rsEstadia['idEstadia'],
            'idCliente'             => $rsEstadia['idCliente'],
            'nome'                  => $rsEstadia['nome'],
            'idVeiculo'             => $rsEstadia['idVeiculo'],
            'placa'                 => $rsEstadia['placa'],
            'marca'                 => $rsEstadia['marca'],
            'modelo'                => $rsEstadia['modelo'],
            'dataDaEntrada'         => $rsEstadia['dataDaEntrada'],
            'horaDaEntrada'         => $rsEstadia['horaDaEntrada'],
            'dataDaSaida'           => $rsEstadia['dataDaSaida'],
            'horaDaSaida'           => $rsEstadia['horaDaSaida'],
            'valor'                 => $rsEstadia['valor'],
            'pago'                  => $rsEstadia['pago']
        );  
    }
    
    $headerDados = array (
        'status' => 'success',
        'Encontrado' => $dados
    );

    if (isset($dados))
        $listEstadiasJson = convertJson($headerDados);
    else 
        false;
    //verificar se foi gerado um arquivo json
    if (isset($listEstadiasJson)) 
        return $listEstadiasJson;
    else
        return false;
}

function insertEstadia($dados) {
    require_once('conexaoMysql.php');

    if(!$conex = conexaoMysql())
    {
        echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
        //die; //Finaliza a interpretação da página
    }

    $idCliente = (int) null;
    $idVeiculo = (int) null;
    $dataDaEntrada = (string) null;
    $horaDaEntrada = (string) null;
    $dataDaSaida = (string) null;
    $horaDaSaida = (string) null;
    $pago = (bool) null;
    $valor = (double) null;

    $idCliente = $dados['idCliente'];
    $idVeiculo = $dados['idVeiculo'];
    $dataDaEntrada = $dados['dataDaEntrada'];
    $horaDaEntrada = $dados['horaDaEntrada'];
    $dataDaSaida = $dados['dataDaSaida'];
    $horaDaSaida = $dados['horaDaSaida'];
    $pago = $dados['pago'];
    $valor = $dados['valor'];

    $sql = "insert into tblEstadia (idCliente, idVeiculo, dataDaEntrada, horaDaEntrada, dataDaSaida, horaDaSaida, pago, valor) values(". $id .")";

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
