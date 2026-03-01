<?php
//CONEXÃO BANCO DE DADOS + BLOQUEIO ACESSO==================
session_start();
include_once("../../BD/conexao.php");

//CONTADOR DE LOGIN
$contador_login = $_SESSION['contador_login'];

//VALIDA SE LOGIN FOI EFETUADO
if($contador_login == 1){ } else { header("Location: ../../../../LOGIN/login.php"); }
//==========================================================



//VARIAVEIS FORMULÁRIO
$fornecedor = str_replace(",",".", $_POST['fornecedor']);
$senha = str_replace(",",".", $_POST['senha']);



//BUSCA SENHA DE USUÁRIO ADMINISTRADOR NO BANCO DE DADOS
$sys_us_senha = "SELECT * FROM usuarios";
$valida_senha = mysqli_query($conn, $sys_us_senha);
while ($linha = mysqli_fetch_assoc($valida_senha)){



	//SELECIONA COLUNAS DO BD PARA LOGICA
	//senha do sistema permite fazer validação segura
	$sys_senha = $linha ['senha'];



//FIM WHILE
}



//VALIDA SENHA PARA EXECUTAR OPERAÇÕES LÓGICAS
if($senha == $sys_senha){



	//REMOVE FORNECEDOR DO BANCO DE DADOS
	$remove = "DELETE FROM despesa WHERE fornecedor = '$fornecedor'";
	$remove_fornecedor = mysqli_query($conn, $remove);



	//MSG
	$_SESSION['msg'] = "<div style=color:#3CB371;font-size:15px;>🟢 Fornecedor removido com sucesso.</div>";
	header("Location: ../../../../DESPESA/REM/remover.php");



//FIM VALIDAÇÃO SENHA
} else {

	//MSG
	$_SESSION['msg'] = "<div style=color:#F08080;font-size:15px;>🔴 Senha incorreta.</div>";
	header("Location: ../../../../DESPESA/REM/remover.php");

}



?>