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
$ticker = $_SESSION['ticker'];



//VARIAVEIS FORMULÁRIO
$cotacao = str_replace(",",".", $_POST['cotacao']);
$cotas = str_replace(",",".", $_POST['cotas']);
$proventos = str_replace(",",".", $_POST['proventos']);
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



	//BUSCA EXISTÊNCIA DE TICKER NO BANCO DE DADOS
	$busca = "SELECT * FROM investimento WHERE ticker = '$ticker'";
	$busca_classe = mysqli_query($conn, $busca);
	while ($linha = mysqli_fetch_assoc($busca_classe)){



		//SELECIONA CLASSE DO BD PARA LOGICA
		$classe = $linha ['classe'];



	//FIM WHILE
	}



	//TRATA PROVENTOS DE INVESTIMENTOS QUE NÃO REMUNERA MENSAL
	if($classe == "acao"){

		//AÇÃO RECEBE PROVENTOS '0'
		$proventos = 0;

	} else if ($classe == "etf"){

		//ETF RECEBE PROVENTOS '0'
		$proventos = 0;

	} else if ($classe == "rfx"){

		//RFX RECEBE PROVENTOS '0'
		$proventos = 0;

	}


	//TRATA TODAS VARIAVEIS
	if($cotacao < 0){

		//MSG
		$_SESSION['msg'] = "<div style=color:#F08080;font-size:15px;>🔴 Cotação não pode ser negativa.</div>";
		header("Location: ../../../../INVESTIMENTO/AJU/buscar.php");

	} else if($cotas < 0){

		//MSG
		$_SESSION['msg'] = "<div style=color:#F08080;font-size:15px;>🔴 Cotas não podem ser negativas.</div>";
		header("Location: ../../../../INVESTIMENTO/AJU/buscar.php");

	} else if ($proventos < 0){

		//MSG
		$_SESSION['msg'] = "<div style=color:#F08080;font-size:15px;>🔴 Proventos não podem ser negativos.</div>";
		header("Location: ../../../../INVESTIMENTO/AJU/buscar.php");

	} else {



		//ATUALIZA INFORMAÇÕES
		$atualiza = "UPDATE investimento SET cotacao = '$cotacao', cotas = '$cotas', proventos = '$proventos' WHERE ticker = '$ticker'";
		$resultado_atualização = mysqli_query($conn, $atualiza);



		//MSG
		$_SESSION['msg'] = "<div style=color:#3CB371;font-size:15px;>🟢 Ticker atualizado com sucesso.</div>";
		header("Location: ../../../../INVESTIMENTO/AJU/buscar.php");
	}



	//DESTROI SESSÃO TICKER
	unset($_SESSION['ticker']);



//FIM VALIDAÇÃO SENHA
} else {

	//MSG
	$_SESSION['msg'] = "<div style=color:#F08080;font-size:15px;>🔴 Senha incorreta. Informe o ativo e tente novamente.</div>";
	header("Location: ../../../../INVESTIMENTO/AJU/buscar.php");

}



?>