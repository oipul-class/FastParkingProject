<?php


function ListarSaida($id , $placa) {
    require_once('conexaoMysql.php');

    if(!$conex = conexaoMysql())
    {
        echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
        //die; //Finaliza a interpretação da página
    }


    if ($id==null && $id==0 && $placa==null && $placa=="") {

        $sql = "select * from tblSaida";
        $select = mysqli_query($conex, $sql);

        while($rsSaida = mysqli_fetch_assoc($select)) {
            //varios itens para o json
            $dados[] = array (
                //          => - o que alimenta o dado de um array
                'idSaida'         => $rsSaida['idSaida'],
                'dataDeSaida'     => $rsSaida['dataDeSaida'],
                'horaDeSaida'     => $rsSaida['horaDeSaida']
            );            
        } 

        $headerDados = array (
            'status' => 'success',
            'Saidas' => $dados
        );
        if (isset($dados))
            $listSaidasJson = convertJson($headerDados);
        else 
            false;
        //verificar se foi gerado um arquivo json
        if (isset($listSaidasJson)) 
            return $listSaidasJson;
        else
            return false;
    }
    if($id!=null && $id!=0 && $placa==null && $placa=="") {
        
        $sql = "select * from tblSaida where idSaida = " . $id;
        $select = mysqli_query($conex, $sql);

        while($rsSaida = mysqli_fetch_assoc($select)) {
            //varios itens para o json
            $dados[] = array (
                //          => - o que alimenta o dado de um array
                'idSaida'         => $rsSaida['idSaida'],
                'dataDeSaida'     => $rsSaida['dataDeSaida'],
                'horaDeSaida'     => $rsSaida['horaDeSaida']
            );            
        } 

        $headerDados = array (
            'status' => 'success',
            'Encontrado' => $dados
        );
        if (isset($dados))
            $listSaidasJson = convertJson($headerDados);
        else 
            false;
        //verificar se foi gerado um arquivo json
        if (isset($listSaidasJson)) 
            return $listSaidasJson;
        else
            return false;
    }
    if($id==null && $id==0 && $placa!=null && $placa!="") {
        
        $sql = "select tblSaida.idSaida, tblSaida.dataDeSaida, tblSaida.horaDeSaida from tblSaida, tblEstadia, tblVeiculo where tblVeiculo.placa = '". $placa ."' and tblVeiculo.idVeiculo = tblEstadia.idVeiculo and tblSaida.idSaida = tblEstadia.idSaida";
        $select = mysqli_query($conex, $sql);

        while($rsSaida = mysqli_fetch_assoc($select)) {
            //varios itens para o json
            $dados[] = array (
                //          => - o que alimenta o dado de um array
                'idSaida'         => $rsSaida['idSaida'],
                'dataDeSaida'     => $rsSaida['dataDeSaida'],
                'horaDeSaida'     => $rsSaida['horaDeSaida']
            );            
        } 

        $headerDados = array (
            'status' => 'success',
            'Encontrado' => $dados
        );
        if (isset($dados))
            $listSaidasJson = convertJson($headerDados);
        else 
            false;
        //verificar se foi gerado um arquivo json
        if (isset($listSaidasJson)) 
            return $listSaidasJson;
        else
            return false;
    }

}

function convertJson($data) {
    header("Content-Type:applicantion/json"); // forçando o cabeçalho do arquivo a ser aplicação do tipo json
    $listJson = json_encode($data); // codificando em json   
    return $listJson;
}