<?php

function listPreco() {
    require_once('conexaoMysql.php');

    if(!$conex = conexaoMysql())
    {
        echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
        //die; //Finaliza a interpretação da página
    }

    $sql = "select * from tblPrecos";
    $select = mysqli_query($conex, $sql);

    while($rsPreco = mysqli_fetch_assoc($select)) {
        //varios itens para o json
        
        $dados[] = array (
            //          => - o que alimenta o dado de um array
            'idPreco'                 => $rsPreco['idPreco'],
            'precoEntrada'            => $rsPreco['precoEntrada'],
            'precoAdicional'          => $rsPreco['precoAdicional']

        );  
    } 
    
    $headerDados = array (
        'status' => 'success',
        'Preco' => $dados
    );

    if (isset($dados))
        $rsPreco = convertJson($headerDados);
    else 
        false;
    //verificar se foi gerado um arquivo json
    if (isset($rsPreco)) 
        return $rsPreco;
    else
        return false;

}

function updatePrecos($dados) {
    require_once('conexaoMysql.php');

    if(!$conex = conexaoMysql())
    {
        echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
        //die; //Finaliza a interpretação da página
    }

    $precoEntrada = (double) null;
    $precoAdicional = (double) null;

    $precoEntrada = $dados['precoEntrada'];
    $precoAdicional = $dados['precoAdicional'];

        $sql = "update tblPrecos set 
        
        precoEntrada = ". $precoEntrada .",
        precoAdicional = ". $precoAdicional ."
        where idPreco = 1";

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