<?php

    //CONEXÃO PADRÃO XAMPP
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $dbname = "alog";


    //FUNÇÃO CRIA A CONEXÃO
    $conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
    

    //CONDIÇÃO PARA CONEXÃO CRIADA
    if(!$conn){

        die("Falha na conexao: " . mysqli_connect_error());

    } else {

        //CONEXÃO REALIZADA COM SUCESSO
    }

?> 