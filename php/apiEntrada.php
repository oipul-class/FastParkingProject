<?php 


function listarEntradas($id , $placa) {
    require_once('conexaoMysql.php');

    if(!$conex = conexaoMysql())
    {
        echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
        //die; //Finaliza a interpretação da página
    }

    if ($id==null && $id==0 && $placa==null && $placa=="") {

        $sql = "select * from tblEntrada";
        $select = mysqli_query($conex, $sql);

        while($rsEntradas = mysqli_fetch_assoc($select)) {
            //varios itens para o json
            $dados[] = array (
                //          => - o que alimenta o dado de um array
                'idEntrada'         => $rsEntradas['idEntrada'],
                'dataDeEntrada'     => $rsEntradas['dataDeEntrada'],
                'horaDeEntrada'     => $rsEntradas['horaDeEntrada']
            );            
        } 

        $headerDados = array (
            'status' => 'success',
            'Entradas' => $dados
        );
        if (isset($dados))
            $listEntradasJson = convertJson($headerDados);
        else 
            false;
        //verificar se foi gerado um arquivo json
        if (isset($listEntradasJson)) 
            return $listEntradasJson;
        else
            return false;
    }
    if($id!=null && $id!=0 && $placa==null && $placa=="") {
        
        $sql = "select * from tblEntrada where idEntrada = " . $id;
        $select = mysqli_query($conex, $sql);

        while($rsEntradas = mysqli_fetch_assoc($select)) {
            //varios itens para o json
            $dados[] = array (
                //          => - o que alimenta o dado de um array
                'idEntrada'         => $rsEntradas['idEntrada'],
                'dataDeEntrada'     => $rsEntradas['dataDeEntrada'],
                'horaDeEntrada'     => $rsEntradas['horaDeEntrada']
            );            
        } 

        $headerDados = array (
            'status' => 'success',
            'Encontrado' => $dados
        );
        if (isset($dados))
            $listEntradasJson = convertJson($headerDados);
        else 
            false;
        //verificar se foi gerado um arquivo json
        if (isset($listEntradasJson)) 
            return $listEntradasJson;
        else
            return false;
    }
    if($id==null && $id==0 && $placa!=null && $placa!="") {
        
        $sql = "select tblEntrada.idEntrada, tblEntrada.dataDeEntrada, tblEntrada.horaDeEntrada from tblEntrada, tblEstadia, tblVeiculo where tblVeiculo.placa = '". $placa ."' and tblVeiculo.idVeiculo = tblEstadia.idVeiculo and tblEntrada.idEntrada = tblEstadia.idEntrada";
        $select = mysqli_query($conex, $sql);

        while($rsEntradas = mysqli_fetch_assoc($select)) {
            //varios itens para o json
            $dados[] = array (
                //          => - o que alimenta o dado de um array
                'idEntrada'         => $rsEntradas['idEntrada'],
                'dataDeEntrada'     => $rsEntradas['dataDeEntrada'],
                'horaDeEntrada'     => $rsEntradas['horaDeEntrada']
            );            
        } 

        $headerDados = array (
            'status' => 'success',
            'Encontrado' => $dados
        );
        if (isset($dados))
            $listEntradasJson = convertJson($headerDados);
        else 
            false;
        //verificar se foi gerado um arquivo json
        if (isset($listEntradasJson)) 
            return $listEntradasJson;
        else
            return false;
    }
}

function convertJson($data) {
    header("Content-Type:applicantion/json"); // forçando o cabeçalho do arquivo a ser aplicação do tipo json
    $listJson = json_encode($data); // codificando em json   
    return $listJson;
}