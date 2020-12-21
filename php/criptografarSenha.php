<?php

function criptografar($senha) {

    if ($senha!=null && $senha!="") {
        $senhaMD5 = md5($senha);

    

        $headerDados = array (
            'status' => 'success',
            'senha' => $senhaMD5
        );

        return convertJson($headerDados);
    } 
    else 
        return false; 

}

function convertJson($data) {
    header("Content-Type:applicantion/json"); // forçando o cabeçalho do arquivo a ser aplicação do tipo json
    $listJson = json_encode($data); // codificando em json   
    return $listJson;
}