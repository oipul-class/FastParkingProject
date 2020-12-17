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

    $sql = "insert into tblUsuarios ( nome, senha, statusUsuario, nivelAcesso) values('". $nome ."', '". $senha ."', 0, ". $nivelAcesso .")";

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
    $statusUsuario = (bool) null;
    $nivelAcesso = (int) null;

    $idUsuario = $dados['idUsuario'];
    $nome = $dados['nome'];
    $senha = $dados['senha'];
    $statusUsuario = $dados['statusUsuario'];
    $nivelAcesso = $dados['nivelAcesso'];

    if ($idUsuario!=null || $idUsuario!=0) {

        $sql = "update tblUsuarios set 
        
            nome = '". $nome ."',
            senha = '". $senha ."',
            statusUsuario = ". $statusUsuario .",
            nivelAcesso = ". $nivelAcesso ."
            where idUsuario = ". $idUsuario ."
        ";

        if (mysqli_query($conex, $sql))   
            return convertJson($dados);
        else
            return false;
    } else {
        return false;
    }
    

    
}

function deleteUsuario($id) {
    require_once('conexaoMysql.php');

    if(!$conex = conexaoMysql())
    {
        echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
        //die; //Finaliza a interpretação da página
    }


    if ($id!=null || $id!=0) {

        $sql = "delete from tblUsuarios 
            where idUsuario = " . $id;
        

        if (mysqli_query($conex, $sql))   
            return true;
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