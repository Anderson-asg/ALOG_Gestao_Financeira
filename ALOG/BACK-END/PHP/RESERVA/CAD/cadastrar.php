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
$classe = str_replace(",",".", $_POST['classe']);
$status = str_replace(",",".", $_POST['status']);
$ticker = str_replace(",",".", $_POST['ticker']);
$segmento = str_replace(",",".", $_POST['segmento']);
$senha = str_replace(",",".", $_POST['senha']);



//VARIAVEL BACK-END
$aporte = 0;



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



	//CONTADOR
	$c = 0;



	//BUSCA EXISTÊNCIA DE TICKER NO BANCO DE DADOS
	$valida = "SELECT * FROM reserva WHERE ticker = '$ticker'";
	$valida_ticker = mysqli_query($conn, $valida);
	while ($linha = mysqli_fetch_assoc($valida_ticker)){



		//CONTADOR INCREMENTA
		$c = $c + 1;



	//FIM WHILE
	}



	//CONDIÇÕES
	if($c == 1){
		
		//MSG
		$_SESSION['msg'] = "<div style=color:#F08080;font-size:15px;>🔴 Ticker já cadastrado.</div>";
		header("Location: ../../../../RESERVA/CAD/cadastrar.php");

	} else {



		//CADASTRA TICKER
		$valida_reserva = "INSERT INTO reserva (classe, status, ticker, segmento, aporte) VALUES ('$classe', '$status', '$ticker', '$segmento', '$aporte')";

		$resultado_reserva = mysqli_query($conn, $valida_reserva);



		//MSG
		$_SESSION['msg'] = "<div style=color:#3CB371;font-size:15px;>🟢 Ticker cadastrado com sucesso.</div>";
		header("Location: ../../../../RESERVA/CAD/cadastrar.php");
	}



//FIM VALIDAÇÃO SENHA
} else {

	//MSG
	$_SESSION['msg'] = "<div style=color:#F08080;font-size:15px;>🔴 Senha incorreta.</div>";
	header("Location: ../../../../RESERVA/CAD/cadastrar.php");

}



?>