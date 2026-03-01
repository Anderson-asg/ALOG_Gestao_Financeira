<?php
//CONEXÃO BANCO DE DADOS + BLOQUEIO ACESSO==================
session_start();
include_once("../../BD/conexao.php");

//CONTADOR DE LOGIN
$contador_login = $_SESSION['contador_login'];

//VALIDA SE LOGIN FOI EFETUADO
if($contador_login == 1){ } else { header("Location: ../../../../LOGIN/login.php"); }
//==========================================================



//SESSION TRÁS DA FRONT-END VARIAVEL CHAVE PARA LÓGICA
$fornecedor = $_SESSION['fornecedor'];



//VARIAVEIS FORMULÁRIO
$vencimento = str_replace(",",".", $_POST['vencimento']);
$orcamento = str_replace(",",".", $_POST['orcamento']);
$parcelas = str_replace(",",".", $_POST['parcelas']);
$parcela_at = str_replace(",",".", $_POST['parcela_at']);
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



	//BUSCA EXISTÊNCIA DE FORNECEDOR NO BANCO DE DADOS
	$busca = "SELECT * FROM despesa WHERE fornecedor = '$fornecedor'";
	$busca_fornecedor = mysqli_query($conn, $busca);
	while ($linha = mysqli_fetch_assoc($busca_fornecedor)){



		//SELECIONA OPERAÇÃO DO BD PARA LOGICA
		$operacao = $linha ['operacao'];



	//FIM WHILE
	}



	//TRATA OPERAÇÃO DE DESPESA
	if($operacao == "ef"){

		//PARCELAS E PARCELA ATUAL RECEBE '0'
		$parcelas = 0;
		$parcela_at = 0;

	} else if($operacao == "ft"){ }



	//TRATA TODAS VARIAVEIS
	if($orcamento < 0){

		//MSG
		$_SESSION['msg'] = "<div style=color:#F08080;font-size:15px;>🔴 Orçamento não pode ser negativo.</div>";
		header("Location: ../../../../DESPESA/AJU/buscar.php");

	} else if($parcelas < 0){

		//MSG
		$_SESSION['msg'] = "<div style=color:#F08080;font-size:15px;>🔴 Parcelas não podem ser negativas.</div>";
		header("Location: ../../../../DESPESA/AJU/buscar.php");

	} else if($parcela_at < 0){

		//MSG
		$_SESSION['msg'] = "<div style=color:#F08080;font-size:15px;>🔴 Parcela atual não pode ser negativa.</div>";
		header("Location: ../../../../DESPESA/AJU/buscar.php");

	} else if($parcelas < $parcela_at){

		//MSG
		$_SESSION['msg'] = "<div style=color:#F08080;font-size:15px;>🔴 Parcela atual não pode ser maior que o total de parcelas.</div>";
		header("Location: ../../../../DESPESA/AJU/buscar.php");

	} else {



		//ATUALIZA INFORMAÇÕES
		$atualiza = "UPDATE despesa SET vencimento = '$vencimento', orcamento = '$orcamento', parcelas = '$parcelas', parcela_at = '$parcela_at' WHERE fornecedor = '$fornecedor'";
		$resultado_atualização = mysqli_query($conn, $atualiza);



		//MSG
		$_SESSION['msg'] = "<div style=color:#3CB371;font-size:15px;>🟢 Fornecedor atualizado com sucesso.</div>";
		header("Location: ../../../../DESPESA/AJU/buscar.php");
	}



	//DESTROI SESSÃO FORNECEDOR
	unset($_SESSION['fornecedor']);



//FIM VALIDAÇÃO SENHA
} else {

	//MSG
	$_SESSION['msg'] = "<div style=color:#F08080;font-size:15px;>🔴 Senha incorreta. Informe a despesa e tente novamente.</div>";
	header("Location: ../../../../DESPESA/AJU/buscar.php");

}



?>