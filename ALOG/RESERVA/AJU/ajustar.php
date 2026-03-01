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
	<title>ALOG | RESERVA</title>

	<!--SCRIPT-->

	<!--BLOQUEIA CLIQUE ESQUERDO-->
	<script type="text/javascript">document.addEventListener('contextmenu', event => event.preventDefault());</script>

	<!--TRATA VALOR DECIMAL-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
	
	<!--SALDO-->
	<script type="text/javascript">$(function() { $('#saldo').maskMoney({ decimal: '.', thousands: '', precision: 2 });})</script>
</head>
<body style="background-color: #1A1E23;font-family: calibri;text-transform: uppercase;">



<!--PHP BUSCA INFORMAÇÕES DE RESERVA-->
<?php

//VARIAVEIS FORMULÁRIO
$ticker = $_POST['ticker'];
$senha = str_replace(",",".", $_POST['senha']);



//VARIÁVEIS RECEBE '0'
$segmento = 0;
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



	//BUSCA NO BANCO DE DADOS
	$valida = "SELECT * FROM reserva WHERE status = 'ap'";
	$valida_reserva = mysqli_query($conn, $valida);
	while ($linha = mysqli_fetch_assoc($valida_reserva)){



		//SELECIONA COLUNAS DO BD PARA LOGICA
		$classe = $linha ['classe'];
		$status = $linha ['status'];
		$ticker = $linha ['ticker'];
		$segmento = $linha ['segmento'];
		$aporte = number_format($linha ['aporte'], 2, '.', '');



	//FIM WHILE
	}



	//VALIDA CLASSE
	if($classe == "rfx"){

		$classe = "Renda Fixa";

	}



	//VALIDA APORTE
	if($status == "ap"){

		$status = "Aportado";

	} else if ($status == "nap"){

		$status = "Não Aportado";

	}


	//CRIA SESSÃO TICKER
	//sessão atuará no update do ajustar (back-end)
	$_SESSION['ticker'] = $ticker;



?>
<!--FIM PHP-->



<!--FORMULÁRIO-->
<form method="post" action="../../BACK-END/PHP/RESERVA/AJU/ajustar.php">



	<!--RESERVA DE PATRIMONIO-->
	<table cellspacing="20px" style="height: 605px;width: 35%;">
		<tr>



			<!--RESERVA-->
			<td style="background-color: #252B30;border-radius: 10px;box-shadow: 1.5px 1.5px 1.5px black;">			



				<!--TITULO AJUSTAR RESERVA-->
				<table align="center" cellspacing="5px" style="height: 120px;width: 90%;">

					<!--CADASTRAR-->
					<tr>

						<!--ICONE-->
						<td rowspan="2" style="border-radius: 10px;font-size: 50px;width: 10%;">⚙️</td>

						<!--TITULO-->
						<td style="color: gray;font-size: 20px;font-weight: bold;vertical-align: bottom;width: 80%;"><?php echo $ticker; ?></td>
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
				<!--FIM TITULO AJUSTAR RESERVA-->



				<!--FORMULARIO RESERVA DE PATRIMÔNIO-->
				<table align="center" cellspacing="5px" style="height: 50px;width: 90%;">

					<!--CLASSE-->
					<tr>

						<!--TITULO | CLASSE-->
						<td align="center" style="background-color: #1A1E23;border-radius: 5px;color: gray;font-size: 15px;font-weight: bold;width: 30%;">Classe</td>

						<!--FIELD | CLASSE-->
						<td style="width: 70%;">
							<input type="text" name="classe" value="<?php echo $classe;?>" style="background-color: #1A1E23;border-radius: 5px;color: gray;font-size: 15px;font-weight: bold;height: 32px;text-transform: uppercase;width: 96%;" disabled>
						</td>
					</tr>

					<!--STATUS-->
					<tr>

						<!--TITULO | STATUS-->
						<td align="center" style="background-color: #1A1E23;border-radius: 5px;color: gray;font-size: 15px;font-weight: bold;width: 30%;">Status</td>

						<!--FIELD | STATUS-->
						<td style="width: 70%;">
							<input type="text" name="status" value="<?php echo $status;?>" style="background-color: #1A1E23;border-radius: 5px;color: gray;font-size: 15px;font-weight: bold;height: 32px;text-transform: uppercase;width: 96%;" disabled>
						</td>
					</tr>

					<!--SEGMENTO-->
					<tr>

						<!--TITULO | SEGMENTO-->
						<td align="center" style="background-color: #1A1E23;border-radius: 5px;color: gray;font-size: 15px;font-weight: bold;width: 30%;">Segmento</td>

						<!--FIELD | SEGMENTO-->
						<td style="width: 70%;">
							<input type="text" name="segmento" value="<?php echo $segmento;?>" style="background-color: #1A1E23;border-radius: 5px;color: gray;font-size: 15px;font-weight: bold;height: 32px;text-transform: uppercase;width: 96%;" disabled>
						</td>
					</tr>

					<!--APORTE-->
					<tr>

						<!--TITULO | APORTE-->
						<td align="center" style="background-color: #1A1E23;border-radius: 5px;color: gray;font-size: 15px;font-weight: bold;width: 30%;">Aporte</td>

						<!--FIELD | APORTE-->
						<td style="width: 70%;">
							<input type="text" name="aporte" value="<?php echo $aporte;?>" style="background-color: #1A1E23;border-radius: 5px;color: gray;font-size: 15px;font-weight: bold;height: 32px;text-transform: uppercase;width: 96%;" disabled>
						</td>
					</tr>

					<!--OPERAÇÃO-->
					<tr>

						<!--TITULO | OPERAÇÃO-->
						<td align="center" style="background-color: gray;border-radius: 5px;color: #1A1E23;font-size: 15px;font-weight: bold;width: 30%;">Operação</td>

						<!--FIELD | OPERAÇÃO-->
						<td style="width: 70%;">
							<select name="operacao" autofocus="true" style="background-color: #1A1E23;border-radius: 5px;color: gray;font-size: 15px;font-weight: bold;height: 38px;text-transform: uppercase;width: 99.4%;" required>
								<option value="" selected>Selecione</option>
								<option value="cd">Creditar</option>
								<option value="db">Debitar</option>
							</select>
						</td>
					</tr>

					<!--SALDO-->
					<tr>

						<!--TITULO | SALDO-->
						<td align="center" style="background-color: gray;border-radius: 5px;color: #1A1E23;font-size: 15px;font-weight: bold;width: 30%;">Saldo</td>

						<!--FIELD | SALDO-->
						<td style="width: 70%;">
							<input type="text" name="saldo" placeholder="Movimentação" id="saldo" maxlength="9" onKeypress="if (event.keyCode == 32) event.returnValue = false;" style="background-color: #1A1E23;border-radius: 5px;color: gray;font-size: 15px;font-weight: bold;height: 32px;text-transform: uppercase;width: 96%;" required>
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
				<!--FIM FORMULARIO RESERVA DE PATRIMÔNIO-->



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
							<a href="../../DASHBOARD/dashboard.php"><input type="button" value="Voltar" style="background-color: gray;border-radius: 5px;color: #1A1E23;font-family: calibri;font-size: 18px;font-weight: bold;height: 32px;text-transform: uppercase;width: 100%;"></a>
						</td>
					</tr>
				</table>
				<!--FIM BOTÕES-->
			</td>
			<!--FIM RESERVA-->
		</tr>
	</table>
	<!--FIM RESERVA DE PATRIMONIO-->



</form>
<!--FIM FORMULÁRIO-->



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