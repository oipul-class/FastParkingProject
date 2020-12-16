<?php

function listAllUsuario() {
    require_once('conexaoMysql.php');

    if(!$conex = conexaoMysql())
    {
        echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
        //die; //Finaliza a interpretação da página
    }

    $sql = "select * from tblUsuarios";
    $select = mysqli_query($conex, $sql);

    while($rsUsuario = mysqli_fetch_assoc($select)) {
        //varios itens para o json
        
        $dados[] = array (
            //          => - o que alimenta o dado de um array
            'idUsuario'                 => $rsUsuario['idUsuario'],
            'nome'                      => $rsUsuario['nome'],
            'senha'                     => $rsUsuario['senha'],
            'statusUsuario'             => $rsUsuario['statusUsuario'],
            'nivelAcesso'               => $rsUsuario['nivelAcesso']
        );  
    } 
    
    $headerDados = array (
        'status' => 'success',
        'Usuarios' => $dados
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

function listUsuarioPorId($id) {
    require_once('conexaoMysql.php');

    if(!$conex = conexaoMysql())
    {
        echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
        //die; //Finaliza a interpretação da página
    }

    $sql = "select * from tblUsuarios where idUsuario = ". $id ;
    $select = mysqli_query($conex, $sql);

    while($rsUsuario = mysqli_fetch_assoc($select)) {
        //varios itens para o json
        
        $dados[] = array (
            //          => - o que alimenta o dado de um array
            'idUsuario'                 => $rsUsuario['idUsuario'],
            'nome'                      => $rsUsuario['nome'],
            'senha'                     => $rsUsuario['senha'],
            'statusUsuario'             => $rsUsuario['statusUsuario'],
            'nivelAcesso'               => $rsUsuario['nivelAcesso']
        );  
    } 
    
    $headerDados = array (
        'status' => 'success',
        'Usuriao' => $dados
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

function insertUsuario($dados) {
    require_once('conexaoMysql.php');

    if(!$conex = conexaoMysql())
    {
        echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
        //die; //Finaliza a interpretação da página
    }


    $nome = (string) null;
    $senha = (string) null;
    $nivelAcesso = (int) null;

    $nome = $dados['nome'];
    $senha = $dados['senha'];
    $nivelAcesso = $dados['nivelAcesso'];

    $sql = "insert into tblUsuarios ( nome, senha, statusUsuario, nivelAcesso) values('". $nome ."', '". $senha ."', 1, ". $nivelAcesso .")";

    if (mysqli_query($conex, $sql))   
        return convertJson($dados);
    else
        return false;

    
}

function updateUsuario($dados) {
    require_once('conexaoMysql.php');

    if(!$conex = conexaoMysql())
    {
        echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
        //die; //Finaliza a interpretação da página
    }

    $idUsuario = (int) null;
    $nome = (string) null;
    $senha = (string) null;
    $nivelAcesso = (int) null;

    $idUsuario = $dados['idUsuario'];
    $nome = $dados['nome'];
    $senha = $dados['senha'];
    $nivelAcesso = $dados['nivelAcesso'];

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
            where idEstadia = ". $idUsuario ."
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