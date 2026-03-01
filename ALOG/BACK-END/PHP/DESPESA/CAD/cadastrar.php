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
$operacao = str_replace(",",".", $_POST['operacao']);
$fornecedor = str_replace(",",".", $_POST['fornecedor']);
$servico = str_replace(",",".", $_POST['servico']);
$senha = str_replace(",",".", $_POST['senha']);



//VARIAVEIS BACK-END
$orcamento = 0;
$parcelas = 0;
$parcela_at = 0;
$vencimento = 0;



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
	$valida = "SELECT * FROM despesa WHERE fornecedor = '$fornecedor' OR servico = '$servico'";
	$valida_despesa = mysqli_query($conn, $valida);
	while ($linha = mysqli_fetch_assoc($valida_despesa)){



		//CONTADOR INCREMENTA		
		$c = $c + 1;



	//FIM WHILE
	}



	//CONDIÇÕES
	if($c == 1){
		
		//MSG
		$_SESSION['msg'] = "<div style=color:#F08080;font-size:15px;>🔴 Despesa já cadastrada.</div>";
		header("Location: ../../../../DESPESA/CAD/cadastrar.php");

	} else {

		//CADASTRA DESPESA
		$despesa = "INSERT INTO despesa (operacao, fornecedor, servico, orcamento, parcelas, parcela_at, vencimento) VALUES ('$operacao', '$fornecedor', '$servico', '$orcamento', '$parcelas', '$parcela_at', '$vencimento')";

		$resultado_despesa = mysqli_query($conn, $despesa);

		//MSG
		$_SESSION['msg'] = "<div style=color:#3CB371;font-size:15px;>🟢 Despesa cadastrada com sucesso.</div>";
		header("Location: ../../../../DESPESA/CAD/cadastrar.php");

	}



//FIM VALIDAÇÃO SENHA
} else {

	//MSG
	$_SESSION['msg'] = "<div style=color:#F08080;font-size:15px;>🔴 Senha incorreta.</div>";
	header("Location: ../../../../DESPESA/CAD/cadastrar.php");

}



?>