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
$ticker = $_SESSION['ticker'];
$operacao = str_replace(",",".", $_POST['operacao']);
$saldo = str_replace(",",".", $_POST['saldo']);
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



	//BUSCA INFORMAÇÕES EM RESERVA
	$valida = "SELECT * FROM reserva WHERE status = 'ap' AND ticker = '$ticker'";
	$valida_reserva = mysqli_query($conn, $valida);
	while ($linha = mysqli_fetch_assoc($valida_reserva)){



		//SELECIONA COLUNAS DO BD PARA LÓGICAS
		$ticker = $linha ['ticker'];
		$aporte = number_format($linha ['aporte'], 2, '.', '');



	//FIM WHILE
	}



	//TRATA TODAS VARIAVEIS
	if($saldo < 0){

		//MSG
		$_SESSION['msg'] = "<div style=color:#F08080;font-size:15px;>🔴 Saldo movimentado não pode ser negativo.</div>";
		header("Location: ../../../../RESERVA/AJU/buscar.php");

	} else if ($ticker == 0){

		//MSG
		$_SESSION['msg'] = "<div style=color:#F08080;font-size:15px;>🔴 Fundo inexistente para movimentação.</div>";
		header("Location: ../../../../RESERVA/AJU/buscar.php");

	} else {



		//VALIDA OPERAÇÃO DA MOVIMENTAÇÃO
		if($operacao == "cd"){

			//CREDITA SALDO
			$aporte = $aporte + $saldo;

		} else if($operacao == "db"){

			//DEBITA SALDO
			$aporte = $aporte - $saldo;

		}



		//RESERVA NÃO PODE TER REGISTRO DE APORTE NEGATIVO
		if($aporte >= 0){



			//ATUALIZA INFORMAÇÕES
			$atualiza = "UPDATE reserva SET aporte = '$aporte' WHERE ticker = '$ticker'";
			$resultado_atualização = mysqli_query($conn, $atualiza);



			//MSG
			$_SESSION['msg'] = "<div style=color:#3CB371;font-size:15px;>🟢 Operação realizada com sucesso.</div>";
			header("Location: ../../../../RESERVA/AJU/buscar.php");

		} else {

			//MSG
			$_SESSION['msg'] = "<div style=color:#F08080;font-size:15px;>🔴 Débito não efetuado. Saldo não pode ser negativo. Informe produto e tente novamente.</div>";
			header("Location: ../../../../RESERVA/AJU/buscar.php");

		}



	}



	//DESTROI SESSÃO TICKER
	unset($_SESSION['ticker']);



//FIM VALIDAÇÃO SENHA
} else {

	//MSG
	$_SESSION['msg'] = "<div style=color:#F08080;font-size:15px;>🔴 Senha incorreta. Informe a operação e tente novamente.</div>";
	header("Location: ../../../../RESERVA/AJU/buscar.php");

}



?>