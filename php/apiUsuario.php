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
            'nivelAcesso'               => $rsUsuario['nivelAcesso'],
            'foto'                      => $rsUsuario['foto']
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
            'nivelAcesso'               => $rsUsuario['nivelAcesso'],
            'foto'                      => $rsUsuario['foto']
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
    $foto = "noImage.png";

    $nome = $dados['nome'];
    $senha = $dados['senha'];
    $nivelAcesso = $dados['nivelAcesso'];

    $senhaMd5 = md5($senha);

    $sql = "insert into tblUsuarios ( nome, senha, statusUsuario, nivelAcesso, foto) values('". $nome ."', '". $senhaMd5 ."', 0, ". $nivelAcesso ." , '". $foto ."')";

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

    $senhaMd5 = md5($senha);

    if ($idUsuario!=null || $idUsuario!=0) {

        $sql = "update tblUsuarios set 
        
            nome = '". $nome ."',
            senha = '". $senhaMd5 ."',
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

function ativarDesativarUsuario($id) {
    require_once('conexaoMysql.php');

    if(!$conex = conexaoMysql())
    {
        echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
        //die; //Finaliza a interpretação da página
    }

   

    if ($id!=null || $id!=0) {

        $sql = "select statusUsuario from tblUsuarios where idUsuario = " . $id;

        $select = mysqli_query($conex, $sql);

        if ($rsUsuario = mysqli_fetch_assoc($select)) {
            
            $status = $rsUsuario['statusUsuario'];
            $sql = null;
            
            if ($status==1)
                $sql = "update tblUsuarios set statusUsuario = 0 where idUsuario = " . $id;
            else 
                $sql = "update tblUsuarios set statusUsuario = 1 where idUsuario = " . $id;

            $sql = "update tblUsuarios 
                        set statusUsuario = ". $status==1 ? 1 : 0 . " where idUsuario = " . $id;

            if (mysqli_query($conex, $sql)){
                if ($status==1)
                    return "usuario desativado";
                else
                    return "usuario ativado";
            }else
                return false;
        } else {
            return false;
        }

        
        

        
    } else {
        return false;
    }
    
}

function inserirFoto($foto , $id) {
    require_once('conexaoMysql.php');

    if(!$conex = conexaoMysql())
    {
        echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
        //die; //Finaliza a interpretação da página
    }

    if ($foto!=null && $id!="" && $id!=0 && $id!=null) {

        $sql = "select foto from tblUsuarios where idUsuario = " . $id;

        $select = mysqli_query($conex, $sql);

        if ($rsUsuario = mysqli_fetch_assoc($select)) {
            require_once("uploadDaFoto.php");
            
            $fotoAntiga = $rsUsuario['foto'];

            if ($fotoAntiga!="noImage.png")
                unlink("../userPictures/" . $fotoAntiga);
            
            $fotoNova = uploadFoto($foto); 


            $sql = "update tblUsuarios set 
            
            foto = '". $fotoNova ."' where idUsuario = " .$id;

            if (mysqli_query($conex, $sql))   
                return "Foto inserida";
            else
                return false;
        } else {
            return false;
        }

        
    
    }else {
        return false;
    }
}


function convertJson($data) {
    header("Content-Type:applicantion/json"); // forçando o cabeçalho do arquivo a ser aplicação do tipo json
    $listJson = json_encode($data); // codificando em json   
    return $listJson;
}