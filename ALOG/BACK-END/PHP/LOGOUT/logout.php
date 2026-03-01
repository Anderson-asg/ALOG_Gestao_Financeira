<?php
//CONEXÃO BANCO DE DADOS + BLOQUEIO ACESSO==================
session_start();
//include_once("../BD/conexao.php");

//CONTADOR DE LOGIN
$contador_login = $_SESSION['contador_login'];

//VALIDA SE LOGIN FOI EFETUADO
if($contador_login == 1){ } else { header("Location: ../../../LOGIN/login.php"); }
//==========================================================



//DESTROI SESSIONS (VARIAVEIS GLOBAIS)
unset($_SESSION['us_nome']);
unset($_SESSION['contador_login']);



//REDIRECIONA PARA DASHBOARD
header("Location: ../../../LOGIN/login.php");



?>