<?php

    

function listAllEstadia() {

    

    require_once('conexaoMysql.php');

    if(!$conex = conexaoMysql())
    {
        echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
        //die; //Finaliza a interpretação da página
    }

    $sql = "select tblCliente.*, tblVeiculo.*, tblEntrada.*, tblSaida.*, tblEstadia.* from tblCliente, tblVeiculo, tblEntrada, tblSaida, tblEstadia where tblEstadia.idCliente = tblCliente.idCliente and tblEstadia.idVeiculo = tblVeiculo.idVeiculo and tblEstadia.idEntrada = tblEntrada.idEntrada and tblEstadia.idSaida = tblSaida.idSaida";
    $select = mysqli_query($conex, $sql);
    while($rsEstadia = mysqli_fetch_assoc($select)) {
    
            $dadosComSaida[] = array (
                //          => - o que alimenta o dado de um array
                'idEstadia'             => $rsEstadia['idEstadia'],
                'idCliente'             => $rsEstadia['idCliente'],
                'nome'                  => $rsEstadia['nome'],
                'idVeiculo'             => $rsEstadia['idVeiculo'],
                'placa'                 => $rsEstadia['placa'],
                'marca'                 => $rsEstadia['marca'],
                'modelo'                => $rsEstadia['modelo'],
                'idEntrada'             => $rsEstadia['idEntrada'],
                'dataDeEntrada'         => $rsEstadia['dataDeEntrada'],
                'horaDeEntrada'         => $rsEstadia['horaDeEntrada'],
                'idSaida'               => $rsEstadia['idSaida'],
                'dataDeSaida'           => $rsEstadia['dataDeSaida'],
                'horaDeSaida'           => $rsEstadia['horaDeSaida'],
                'valor'                 => $rsEstadia['valor'],
                'pago'                  => $rsEstadia['pago']
            );  
        }  

    $sql = "select tblCliente.*, tblVeiculo.*, tblEntrada.*, tblEstadia.* from tblCliente, tblVeiculo, tblEntrada, tblSaida, tblEstadia where tblEstadia.idCliente = tblCliente.idCliente and tblEstadia.idVeiculo = tblVeiculo.idVeiculo and tblEstadia.idEntrada = tblEntrada.idEntrada and tblEstadia.idSaida is null";

    $select = mysqli_query($conex, $sql);
    while($rsEstadia = mysqli_fetch_assoc($select)) {
    
            $dadosSemSaida[] = array (
                //          => - o que alimenta o dado de um array
                'idEstadia'         => $rsEstadia['idEstadia'],
                'idCliente'         => $rsEstadia['idCliente'],
                'nome'              => $rsEstadia['nome'],
                'idVeiculo'         => $rsEstadia['idVeiculo'],
                'placa'             => $rsEstadia['placa'],
                'marca'             => $rsEstadia['marca'],
                'modelo'            => $rsEstadia['modelo'],
                'idEntrada'         => $rsEstadia['idEntrada'],
                'dataDeEntrada'     => $rsEstadia['dataDeEntrada'],
                'horaDeEntrada'     => $rsEstadia['horaDeEntrada'],
                'idSaida'           => $rsEstadia['idSaida'],
                'valor'             => $rsEstadia['valor'],
                'pago'              => $rsEstadia['pago']
            );  
        }       
    

    $headerDados = array (
        'status' => 'success',
        'ComSaidas' => $dadosComSaida,
        'SemSaidas' => $dadosSemSaida
    );

    if (isset($dadosComSaida) && isset($dadosSemSaida))
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

    $sql = "select tblCliente.*, tblVeiculo.*, tblEntrada.*, tblSaida.*, tblEstadia.* from tblCliente, tblVeiculo, tblEntrada, tblSaida, tblEstadia where tblEstadia.idCliente = tblCliente.idCliente and tblEstadia.idVeiculo = tblVeiculo.idVeiculo and tblEstadia.idEntrada = tblEntrada.idEntrada and tblEstadia.idSaida = tblSaida.idSaida and tblEstadia.idEstadia = " . $id;
    $select = mysqli_query($conex, $sql);

    if (is_null($rsEstadia = mysqli_fetch_assoc($select))) {
        $sql = "select tblCliente.*, tblVeiculo.*, tblEntrada.*, tblEstadia.* from tblCliente, tblVeiculo, tblEntrada, tblSaida, tblEstadia where tblEstadia.idCliente = tblCliente.idCliente and tblEstadia.idVeiculo = tblVeiculo.idVeiculo and tblEstadia.idEntrada = tblEntrada.idEntrada and tblEstadia.idSaida is null and tblEstadia.idEstadia = " . $id;
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
                'idEntrada'             => $rsEstadia['idEntrada'],
                'dataDeEntrada'         => $rsEstadia['dataDeEntrada'],
                'horaDeEntrada'         => $rsEstadia['horaDeEntrada'],
                'idSaida'               => $rsEstadia['idSaida'],
                'valor'                 => $rsEstadia['valor'],
                'pago'                  => $rsEstadia['pago']
            );  
        }
    } else {
        $dados[] = array (
            //          => - o que alimenta o dado de um array
            'idEstadia'             => $rsEstadia['idEstadia'],
            'idCliente'             => $rsEstadia['idCliente'],
            'nome'                  => $rsEstadia['nome'],
            'idVeiculo'             => $rsEstadia['idVeiculo'],
            'placa'                 => $rsEstadia['placa'],
            'marca'                 => $rsEstadia['marca'],
            'modelo'                => $rsEstadia['modelo'],
            'idEntrada'             => $rsEstadia['idEntrada'],
            'dataDeEntrada'         => $rsEstadia['dataDeEntrada'],
            'horaDeEntrada'         => $rsEstadia['horaDeEntrada'],
            'idSaida'               => $rsEstadia['idSaida'],
            'dataDeSaida'           => $rsEstadia['dataDeSaida'],
            'horaDeSaida'           => $rsEstadia['horaDeSaida'],
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



function convertJson($data) {
    header("Content-Type:applicantion/json"); // forçando o cabeçalho do arquivo a ser aplicação do tipo json
    $listJson = json_encode($data); // codificando em json   
    return $listJson;
}
