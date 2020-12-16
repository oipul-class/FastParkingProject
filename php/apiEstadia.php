<?php

    

function listAllEstadia() {

    

    require_once('conexaoMysql.php');

    if(!$conex = conexaoMysql())
    {
        echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
        //die; //Finaliza a interpretação da página
    }

    $sql = "select * from tblEstadia";
    $select = mysqli_query($conex, $sql);
    while($rsEstadia = mysqli_fetch_assoc($select)) {
    
            $dados[] = array (
                //          => - o que alimenta o dado de um array
                'idEstadia'             => $rsEstadia['idEstadia'],
                'nomeDoCliente'         => $rsEstadia['nomeDoCliente'],
                'placaDoVeiculo'        => $rsEstadia['placaDoVeiculo'],
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

    $sql = "select * from tblEstadia where idEstadia = " . $id;
    $select = mysqli_query($conex, $sql);
    
    if ($rsEstadia = mysqli_fetch_assoc($select)) {
      
        $dados[] = array (
            //          => - o que alimenta o dado de um array
            'idEstadia'             => $rsEstadia['idEstadia'],
            'nomeDoCliente'         => $rsEstadia['nomeDoCliente'],
            'placaDoVeiculo'        => $rsEstadia['placaDoVeiculo'],
            'dataDaEntrada'         => $rsEstadia['dataDaEntrada'],
            'horaDaEntrada'         => $rsEstadia['horaDaEntrada'],
            'dataDaSaida'           => $rsEstadia['dataDaSaida'],
            'horaDaSaida'           => $rsEstadia['horaDaSaida'],
            'valor'                 => $rsEstadia['valor'],
            'pago'                  => $rsEstadia['pago']
        );     }
    
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






    $nomeDoCliente = (string) null;
    $placaDoVeiculo = (string) null;
    $dataDaEntrada = (string) null;
    $horaDaEntrada = (string) null;
    $pago = (bool) null;
    $valor = (double) null;

    $nomeDoCliente = $dados['nomeDoCliente'];
    $placaDoVeiculo = $dados['placaDoVeiculo'];
    $dataDaEntrada = $dados['dataDaEntrada'];
    $horaDaEntrada = $dados['horaDaEntrada'];
    $pago = $dados['pago'];
    $valor = $dados['valor'];

    $sql = "insert into tblEstadia (nomeDoCliente, placaDoVeiculo, dataDaEntrada, horaDaEntrada, pago, valor) values('". $nomeDoCliente ."', '". $placaDoVeiculo ."', '". $dataDaEntrada ."', '". $horaDaEntrada ."',  ". $pago .", '". $valor ."')";

    if (mysqli_query($conex, $sql))   
        return convertJson($dados);
    else
        return false;

    
}

function updateEstadia($dados) {
    require_once('conexaoMysql.php');

    if(!$conex = conexaoMysql())
    {
        echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
        //die; //Finaliza a interpretação da página
    }

    $idEstadia = (int) null;
    $nomeDoCliente = (string) null;
    $placaDoVeiculo = (string) null;
    $dataDaEntrada = (string) null;
    $horaDaEntrada = (string) null;
    $dataDaSaida = (string) null;
    $horaDaSaida = (string) null;
    $pago = (bool) null;
    $valor = (double) null;

    $idEstadia = $dados['idEstadia'];
    $nomeDoCliente = $dados['nomeDoCliente'];
    $placaDoVeiculo = $dados['placaDoVeiculo'];
    $dataDaEntrada = $dados['dataDaEntrada'];
    $horaDaEntrada = $dados['horaDaEntrada'];
    $dataDaSaida = $dados['dataDaSaida'];
    $horaDaSaida = $dados['horaDaSaida'];
    $pago = $dados['pago'];
    $valor = $dados['valor'];


    if ($idEstadia!=null || $idEstadia!=0) {

        $sql = "update tblEstadia set 
        
            nomeDoCliente = '". $nomeDoCliente ."',
            placaDoVeiculo = '". $placaDoVeiculo ."',
            dataDaEntrada = '". $dataDaEntrada ."',
            horaDaEntrada = '". $horaDaEntrada ."',
            dataDaSaida = '". $dataDaSaida ."',
            horaDaSaida = '". $horaDaSaida ."',
            pago = ". $pago .",
            valor = ". $valor ."
            where idEstadia = ". $idEstadia ."
        ";

        if (mysqli_query($conex, $sql))   
            return convertJson($dados);
        else
            return false;
    } else {
        return false;
    }
    

    
}

function updateSaidaEstadia($dados) {
    require_once('conexaoMysql.php');

    if(!$conex = conexaoMysql())
    {
        echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
        //die; //Finaliza a interpretação da página
    }

    $idEstadia = (int) null;
    $dataDaSaida = (string) null;
    $horaDaSaida = (string) null;
    $pago = (bool) null;
    $valor = (double) null;

    $idEstadia = $dados['idEstadia'];
    $dataDaSaida = $dados['dataDaSaida'];
    $horaDaSaida = $dados['horaDaSaida'];
    $pago = $dados['pago'];
    $valor = $dados['valor'];


    if ($idEstadia!=null || $idEstadia!=0) {

        $sql = "update tblEstadia set 
        
            dataDaSaida = '". $dataDaSaida ."',
            horaDaSaida = '". $horaDaSaida ."',
            pago = ". $pago .",
            valor = ". $valor ."
            where idEstadia = ". $idEstadia ."
        ";

        if (mysqli_query($conex, $sql))   
            return convertJson($dados);
        else
            return false;
    } else {
        return false;
    }
    

    
}


function convertJson($data) {
    header("Content-Type:applicantion/json"); // forçando o cabeçalho do arquivo a ser aplicação do tipo json
    $listJson = json_encode($data); // codificando em json   
    return $listJson;
}
