<?php
//CONEXÃO BANCO DE DADOS + BLOQUEIO ACESSO==================
session_start();
include_once("../BD/conexao.php");

//CONTADOR DE LOGIN
$contador_login = $_SESSION['contador_login'];

//VALIDA SE LOGIN FOI EFETUADO
if($contador_login == 1){ } else { header("Location: ../../../LOGIN/login.php"); }
//==========================================================



//VARIAVEIS FORMULÁRIO
$email = str_replace(",",".", $_POST['email']);
$senha = str_replace(",",".", $_POST['senha']);



//CONTADOR
$c = 0;



//BUSCA EXISTÊNCIA DE USUARIO NO BANCO DE DADOS
$valida = "SELECT * FROM usuarios";
$valida_usuario = mysqli_query($conn, $valida);
while ($linha = mysqli_fetch_assoc($valida_usuario)){



	//CONTADOR INCREMENTA
	$c = $c + 1;



	//SELECIONA NOME, EMAIL E SENHA
	$us_nome = $linha['nome'];
	$us_email = $linha['email'];
	$us_senha = $linha['senha'];



//FIM WHILE
}



//VALIDA SE EMAIL E SENHA EXISTEM
if(($email == $us_email) AND ($senha == $us_senha)){



	//RECEBE SESSION PARA CONTROLAR ACESSO DOS MODULO ALOG
	//contador deve ser '1' para executar login
	//senão retorna a login novamente
	$_SESSION['contador_login'] = $c;



	//USUÁRIO NOME
	$_SESSION['us_nome'] = $us_nome;



	//REDIRECIONA PARA DASHBOARD
	header("Location: ../../../DASHBOARD/dashboard.php");



} else if($email != $us_email){

	//MSG
	$_SESSION['msg'] = "<div style=color:#F08080;font-size:15px;>🔴 E-mail inserido está incorreto.</div>";
	header("Location: ../../../LOGIN/login.php");

} else if($senha != $us_senha){

	//MSG
	$_SESSION['msg'] = "<div style=color:#F08080;font-size:15px;>🔴 Senha inserida está incorreta.</div>";
	header("Location: ../../../LOGIN/login.php");

}



?>