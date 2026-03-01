<?php
//CONEXÃO BANCO DE DADOS + BLOQUEIO ACESSO==================
session_start();
include_once("../BD/conexao.php");

//CONTADOR DE LOGIN
$contador_login = $_SESSION['contador_login'];

//VALIDA SE LOGIN FOI EFETUADO
if($contador_login == 1){ } else { header("Location: ../../../LOGIN/login.php"); }
//==========================================================



//VARIAVEL FORMULÁRIO
$id = $_POST['id'];



//BUSCA EXISTÊNCIA DE DESPESA NO BANCO DE DADOS
$valida = "SELECT * FROM despesa WHERE id = '$id'";
$valida_despesa = mysqli_query($conn, $valida);
while ($linha = mysqli_fetch_assoc($valida_despesa)){



	//SELECIONA COLUNAS DO BD PARA LOGICA
	$operacao = $linha['operacao'];
	$parcelas = number_format($linha['parcelas'], 0, '.', '');
	$parcela_at = number_format($linha['parcela_at'], 0, '.', '');
	$vencimento = $linha['vencimento'];



//FIM WHILE
}



//VALIDA OPERAÇÃO DA DESPESA
if($operacao == "ef"){



	//PAGAMENTO CONCLUÍDO, ENTÃO MÊS DE PAGAMENTO INCREMENTA
	$vencimento = strtotime($vencimento . ' +1 month');
	$vencimento = date('Y-m-d', $vencimento);



	//ATUALIZA INFORMAÇÕES DE DESPESA EFETIVA
	$atualiza_despesa_ef = "UPDATE despesa SET vencimento = '$vencimento' WHERE id = '$id'";
	$resultado_despesa_ef = mysqli_query($conn, $atualiza_despesa_ef);



	//MSG
	$_SESSION['msg'] = "<div style=color:#3CB371;font-size:15px;>🟢 Despesa paga.</div>";
	header("Location: ../../../DASHBOARD/dashboard.php");



} else if ($operacao == "ft"){



	//VALIDA SE PARCELA ATUAL É MENOR OU IGUAL A PARCELAS TOTAIS
	if($parcela_at < $parcelas){



		//INCREMENTA PARCELA ATUAL
		$parcela_at = $parcela_at + 1;



		//PAGAMENTO CONCLUÍDO, ENTÃO MÊS DE PAGAMENTO INCREMENTA
		$vencimento = strtotime($vencimento . ' +1 month');
		$vencimento = date('Y-m-d', $vencimento);



		//ATUALIZA INFORMAÇÕES
		$atualiza_despesa_ft = "UPDATE despesa SET parcela_at = '$parcela_at', vencimento = '$vencimento' WHERE id = '$id'";
		$resultado_despesa_ft = mysqli_query($conn, $atualiza_despesa_ft);



		//MSG
		$_SESSION['msg'] = "<div style=color:#3CB371;font-size:15px;>🟢 Despesa paga.</div>";
		header("Location: ../../../DASHBOARD/dashboard.php");



	} else if ($parcela_at >= $parcelas){



		//REMOVE DESPESA, POIS DESPESA FOI QUITADA
		$remove = "DELETE FROM despesa WHERE id = '$id'";
		$remove_despesa = mysqli_query($conn, $remove);



		//MSG
		$_SESSION['msg'] = "<div style=color:#3CB371;font-size:15px;>🟢 Despesa liquidada e removida com sucesso.</div>";
		header("Location: ../../../DASHBOARD/dashboard.php");



	//FIM VALIDAÇÃO DE PARCELAS
	}



//FIM VALIDAÇÃO OPERAÇÃO
}



?>