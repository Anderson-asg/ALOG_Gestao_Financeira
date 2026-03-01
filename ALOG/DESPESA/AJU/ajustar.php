<!--CONEXÃO BANCO DE DADOS + BLOQUEIO ACESSO =================-->
<?php

session_start();
include_once("../../BACK-END/PHP/BD/conexao.php");

//CONTADOR DE LOGIN
$contador_login = $_SESSION['contador_login'];

//VALIDA SE LOGIN FOI EFETUADO
if($contador_login == 1){ } else { header("Location: ../../LOGIN/login.php"); }

?>
<!--==========================================================-->



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ALOG | DESPESA</title>

	<!--SCRIPTS-->

	<!--BLOQUEIA CLIQUE ESQUERDO-->
	<script type="text/javascript">document.addEventListener('contextmenu', event => event.preventDefault());</script>

	<!--TRATA VALOR DECIMAL-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>

	<!--ORÇAMENTO-->
	<script type="text/javascript">$(function() { $('#orcamento').maskMoney({ decimal: '.', thousands: '', precision: 2 });})</script>

	<!--PARCELAS-->
	<script type="text/javascript">$(function() { $('#parcelas').maskMoney({ decimal: '.', thousands: '', precision: 2 });})</script>

	<!--PARCELA ATUAL-->
	<script type="text/javascript">$(function() { $('#parcela_at').maskMoney({ decimal: '.', thousands: '', precision: 2 });})</script>
</head>
<body style="background-color: #1A1E23;font-family: calibri;text-transform: uppercase;">



<!--PHP BUSCA DESPESA-->
<?php

//VARIAVEIS FORMULÁRIO
$fornecedor = $_POST['fornecedor'];
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



	//BUSCA DADOS DO FORNECEDOR NO BANCO DE DADOS
	$valida = "SELECT * FROM despesa WHERE fornecedor = '$fornecedor'";
	$valida_fornecedor = mysqli_query($conn, $valida);
	while ($linha = mysqli_fetch_assoc($valida_fornecedor)){



		//SELECIONA COLUNAS DO BD PARA LOGICA
		$operacao = $linha ['operacao'];
		$fornecedor = $linha ['fornecedor'];
		$servico = $linha ['servico'];
		$orcamento = number_format($linha ['orcamento'], 2, '.', '');
		$parcelas = number_format($linha ['parcelas'], 2, '.', '');
		$parcela_at = number_format($linha ['parcela_at'], 2, '.', '');
		$vencimento = $linha ['vencimento'];



	//FIM WHILE
	}



	//VALIDA OPERAÇÃO
	if($operacao == "ef"){

		$operacao = "Efetiva";
	
	} else if($operacao == "ft"){

		$operacao = "Fatura";

	}



	//BLOQUEIA DATAS ANTERIORES A HOJE
	$data = date('Y-m-d');


	//CRIA SESSÃO FORNECEDOR
	//sessão atuará no update do ajustar (back-end)
	$_SESSION['fornecedor'] = $fornecedor;



?>
<!--FIM PHP-->



<!--FORMULÁRIO-->
<form method="post" action="../../BACK-END/PHP/DESPESA/AJU/ajustar.php">



	<!--AJUSTAR FORNECEDOR-->
	<table cellspacing="20px" style="height: 605px;width: 35%;">
		<tr>



			<!--DESPESA-->
			<td style="background-color: #252B30;border-radius: 10px;box-shadow: 1.5px 1.5px 1.5px black;">				



				<!--TITULO DESPESA-->
				<table align="center" cellspacing="5px" style="height: 120px;width: 90%;">

					<!--AJUSTAR-->
					<tr>

						<!--ICONE-->
						<td rowspan="2" style="border-radius: 10px;font-size: 50px;width: 10%;">⚙️</td>

						<!--TITULO-->
						<td style="color: gray;font-size: 20px;font-weight: bold;vertical-align: bottom;width: 80%;"><?php echo $fornecedor;?></td>
					</tr>

					<!--MSG-->
					<tr>

						<!--MSG-->
						<td style="color: orange;font-size: 15px;vertical-align: top;width: 80%;">

							<?php

								//VALIDA SE SESSION ESTÁ VAZIA
								if(empty($_SESSION['msg'])){

									//VARIAVEL RECEBE MSG OPERANDO...
									$msg = "🟠 Operando...";
									echo $msg;
								
								}



							?>
							<!--FIM PHP-->
						</td>
					</tr>
				</table>
				<!--FIM TITULO DESPESA-->



				<!--FORMULARIO AJUSTAR-->
				<table align="center" cellspacing="5px" style="height: 50px;width: 90%;">

					<!--OPERAÇÃO-->
					<tr>

						<!--TITULO | OPERAÇÃO-->
						<td align="center" style="background-color: #1A1E23;border-radius: 5px;color: gray;font-size: 15px;font-weight: bold;width: 30%;">Operação</td>

						<!--FIELD | OPERAÇÃO-->
						<td style="width: 70%;">
							<input type="text" name="operacao" value="<?php echo $operacao;?>" onKeypress="if (event.keyCode == 32) event.returnValue = false;" style="background-color: #1A1E23;border-radius: 5px;color: gray;font-size: 15px;font-weight: bold;height: 32px;text-transform: uppercase;width: 96%;" disabled>
						</td>
					</tr>

					<!--SERVIÇO-->
					<tr>

						<!--TITULO | SERVIÇO-->
						<td align="center" style="background-color: #1A1E23;border-radius: 5px;color: gray;font-size: 15px;font-weight: bold;width: 30%;">Serviço</td>

						<!--FIELD | SERVIÇO-->
						<td style="width: 70%;">
							<input type="text" name="servico" value="<?php echo $servico;?>" onKeypress="if (event.keyCode == 32) event.returnValue = false;" style="background-color: #1A1E23;border-radius: 5px;color: gray;font-size: 15px;font-weight: bold;height: 32px;text-transform: uppercase;width: 96%;" disabled>
						</td>
					</tr>

					<!--VENCIMENTO-->
					<tr>

						<!--TITULO | VENCIMENTO-->
						<td align="center" style="background-color: gray;border-radius: 5px;color: #1A1E23;font-size: 15px;font-weight: bold;width: 30%;">Vencimento</td>

						<!--FIELD | VENCIMENTO-->
						<td style="width: 70%;">
							<input type="date" min="<?php echo $data; ?>" name="vencimento" value="<?php echo $vencimento;?>" autofocus="true" onKeypress="if (event.keyCode == 32) event.returnValue = false;" style="background-color: #1A1E23;border-radius: 5px;color: gray;font-size: 15px;font-weight: bold;height: 34.5px;text-transform: uppercase;width: 97%;" required>
						</td>
					</tr>

					<!--ORÇAMENTO-->
					<tr>

						<!--TITULO | ORÇAMENTO-->
						<td align="center" style="background-color: gray;border-radius: 5px;color: #1A1E23;font-size: 15px;font-weight: bold;width: 30%;">Orçamento</td>

						<!--FIELD | ORÇAMENTO-->
						<td style="width: 70%;">
							<input type="text" name="orcamento" value="<?php echo $orcamento;?>" id="orcamento" maxlength="8" onKeypress="if (event.keyCode == 32) event.returnValue = false;" style="background-color: #1A1E23;border-radius: 5px;color: gray;font-size: 15px;font-weight: bold;height: 32px;text-transform: uppercase;width: 96%;" required>
						</td>
					</tr>

					<!--PARCELAS TOTAIS-->
					<tr>

						<!--TITULO | PARCELAS-->
						<td align="center" style="background-color: gray;border-radius: 5px;color: #1A1E23;font-size: 15px;font-weight: bold;width: 30%;">Parcelas</td>

						<!--FIELD | PARCELAS-->
						<td style="width: 70%;">
							<input type="text" name="parcelas" value="<?php echo $parcelas;?>" placeholder="Totais" id="parcelas" maxlength="8" onKeypress="if (event.keyCode == 32) event.returnValue = false;" style="background-color: #1A1E23;border-radius: 5px;color: gray;font-size: 15px;font-weight: bold;height: 32px;text-transform: uppercase;width: 96%;" required>
						</td>
					</tr>

					<!--PARCELAS QUITADAS-->
					<tr>

						<!--TITULO | PARCELAS QUITADAS-->
						<td align="center" style="background-color: gray;border-radius: 5px;color: #1A1E23;font-size: 15px;font-weight: bold;width: 30%;">Parcela At.</td>

						<!--FIELD | PARCELAS QUITADAS-->
						<td style="width: 70%;">
							<input type="text" name="parcela_at" value="<?php echo $parcela_at;?>" placeholder="Quitadas" id="parcela_at" maxlength="8" onKeypress="if (event.keyCode == 32) event.returnValue = false;" style="background-color: #1A1E23;border-radius: 5px;color: gray;font-size: 15px;font-weight: bold;height: 32px;text-transform: uppercase;width: 96%;" required>
						</td>
					</tr>

					<!--SENHA-->
					<tr>

						<!--TITULO | SENHA-->
						<td align="center" style="background-color: gray;border-radius: 5px;color: #1A1E23;font-size: 15px;font-weight: bold;width: 30%;">Senha</td>

						<!--FIELD | SENHA-->
						<td style="width: 70%;">
							<input type="password" name="senha" maxlength="24" onKeypress="if (event.keyCode == 32) event.returnValue = false;" style="background-color: #1A1E23;border-radius: 5px;color: gray;font-size: 15px;font-weight: bold;height: 32px;text-transform: uppercase;width: 96%;" required>
						</td>
					</tr>
				</table>
				<!--FIM FORMULARIO AJUSTAR-->



				<!--BOTÕES-->
				<table align="center" cellspacing="5px" style="height: 50px;margin-top: 10px;width: 90%;">

					<!--SALVAR-->
					<tr>
						<td style="width: 90%;">
							<input type="submit" value="Salvar" style="background-color: #228B22;border-color: #006400;border-radius: 5px;color: white;font-family: calibri;font-size: 18px;font-weight: bold;height: 32px;text-transform: uppercase;width: 100%;">
						</td>
					</tr>

					<!--VOLTAR-->
					<tr>
						<td style="width: 90%;">
							<a href="buscar.php"><input type="button" value="Voltar" style="background-color: gray;border-radius: 5px;color: #1A1E23;font-family: calibri;font-size: 18px;font-weight: bold;height: 32px;text-transform: uppercase;width: 100%;"></a>
						</td>
					</tr>
				</table>
				<!--FIM BOTÕES-->
			</td>
			<!--FIM DESPESA-->
		</tr>
	</table>
	<!--FIM AJUSTAR ATIVO-->



</form>
<!--FIM FORMULARIO-->



<!--PHP FINALIZA VALIDAÇÃO DE SENHA-->
<?php 

//FIM VALIDAÇÃO SENHA
} else {

	//MSG
	$_SESSION['msg'] = "<div style=color:#F08080;font-size:15px;>🔴 Senha incorreta.</div>";
	header("Location: buscar.php");

}



?>
<!--FIM PHP-->



</body>
</html>