<!--CONEXÃO BANCO DE DADOS + BLOQUEIO ACESSO =================-->
<?php

session_start();
//include_once("../BACK-END/PHP/BD/conexao.php");

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
	<title>ALOG | INVESTIMENTO</title>

	<!--SCRIPT-->

	<!--BLOQUEIA CLIQUE ESQUERDO-->
	<script type="text/javascript">document.addEventListener('contextmenu', event => event.preventDefault());</script>

	<!--TRATA VALOR DECIMAL-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
	
	<!--COTACAO-->
	<script type="text/javascript">$(function() { $('#cotacao').maskMoney({ decimal: '.', thousands: '', precision: 2 });})</script>

	<!--QUANTIDADE COTAS-->
	<script type="text/javascript">$(function() { $('#cotas').maskMoney({ decimal: '.', thousands: '', precision: 2 });})</script>

	<!--PROVENTOS UNITÁRIO-->
	<script type="text/javascript">$(function() { $('#proventos').maskMoney({ decimal: '.', thousands: '', precision: 2 });})</script>
</head>
<body style="background-color: #1A1E23;font-family: calibri;text-transform: uppercase;">



<!--FORMULÁRIO-->
<form method="post" action="../../BACK-END/PHP/INVESTIMENTO/CAD/cadastrar.php">



	<!--CADASTRAR ATIVO-->
	<table cellspacing="20px" style="height: 650px;width: 35%;">
		<tr>



			<!--INVESTIMENTO-->
			<td style="background-color: #252B30;border-radius: 10px;box-shadow: 1.5px 1.5px 1.5px black;">



				<!--TITULO CADASTRAR-->
				<table align="center" cellspacing="5px" style="height: 120px;width: 90%;">

					<!--CADASTRAR-->
					<tr>

						<!--ICONE-->
						<td rowspan="2" style="border-radius: 10px;font-size: 50px;width: 10%;">💾</td>

						<!--TITULO-->
						<td style="color: gray;font-size: 20px;font-weight: bold;vertical-align: bottom;width: 80%;">Cadastrar Ativo</td>
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
								
								} else {

									//VARIAVEL RECEBE MSG DA BACK-END E EXECUTA
									$msg = $_SESSION['msg'];
									echo $msg;



									//DESTROI SESSÃO MSG DA BACK-END
									unset($_SESSION['msg']);
								}



							?>
							<!--FIM PHP-->
						</td>
					</tr>
				</table>
				<!--FIM TITULO CADASTRAR-->



				<!--FORMULARIO CADASTRAR-->
				<table align="center" cellspacing="5px" style="height: 50px;width: 90%;">

					<!--CLASSE-->
					<tr>

						<!--TITULO | CLASSE-->
						<td align="center" style="background-color: gray;border-radius: 5px;color: #1A1E23;font-size: 15px;font-weight: bold;width: 30%;">Classe</td>

						<!--FIELD | CLASSE-->
						<td style="width: 70%;">
							<select name="classe" autofocus="true" style="background-color: #1A1E23;border-radius: 5px;color: gray;font-size: 15px;font-weight: bold;height: 38px;text-transform: uppercase;width: 99.4%;" required>
								<option value="" selected>Selecione</option>
								<option value="acao">Ação</option>
								<option value="etf">ETF</option>
								<option value="fii">Fundo Imobiliário</option>
								<option value="rfx">Renda Fixa</option>
							</select>
						</td>
					</tr>

					<!--STATUS-->
					<tr>

						<!--TITULO | STATUS-->
						<td align="center" style="background-color: gray;border-radius: 5px;color: #1A1E23;font-size: 15px;font-weight: bold;width: 30%;">Status</td>

						<!--FIELD | STATUS-->
						<td style="width: 70%;">
							<select name="status" style="background-color: #1A1E23;border-radius: 5px;color: gray;font-size: 15px;font-weight: bold;height: 38px;text-transform: uppercase;width: 99.4%;" required>
								<option value="" selected>Selecione</option>
								<option value="ap">Aportado</option>
								<option value="nap">Não Aportado</option>
							</select>
						</td>
					</tr>

					<!--TICKER-->
					<tr>

						<!--TITULO | TICKER-->
						<td align="center" style="background-color: gray;border-radius: 5px;color: #1A1E23;font-size: 15px;font-weight: bold;width: 30%;">Ticker</td>

						<!--FIELD | TICKER-->
						<td style="width: 70%;">
							<input type="text" name="ticker" maxlength="24" onKeypress="if (event.keyCode == 32) event.returnValue = false;" style="background-color: #1A1E23;border-radius: 5px;color: gray;font-size: 15px;font-weight: bold;height: 32px;text-transform: uppercase;width: 96%;" required>
						</td>
					</tr>

					<!--SEGMENTO-->
					<tr>

						<!--TITULO | SEGMENTO-->
						<td align="center" style="background-color: gray;border-radius: 5px;color: #1A1E23;font-size: 15px;font-weight: bold;width: 30%;">Segmento</td>

						<!--FIELD | SEGMENTO-->
						<td style="width: 70%;">
							<input type="text" name="segmento" maxlength="24" onKeypress="if (event.keyCode == 32) event.returnValue = false;" style="background-color: #1A1E23;border-radius: 5px;color: gray;font-size: 15px;font-weight: bold;height: 32px;text-transform: uppercase;width: 96%;" required>
						</td>
					</tr>

					<!--COTAÇÃO-->
					<tr>

						<!--TITULO | COTAÇÃO-->
						<td align="center" style="background-color: gray;border-radius: 5px;color: #1A1E23;font-size: 15px;font-weight: bold;width: 30%;">Cotação</td>

						<!--FIELD | COTAÇÃO-->
						<td style="width: 70%;">
							<input type="text" name="cotacao" placeholder="Hoje" id="cotacao" maxlength="10" onKeypress="if (event.keyCode == 32) event.returnValue = false;" style="background-color: #1A1E23;border-radius: 5px;color: gray;font-size: 15px;font-weight: bold;height: 32px;text-transform: uppercase;width: 96%;" required>
						</td>
					</tr>

					<!--QUANTIDADE COTAS-->
					<tr>

						<!--TITULO | QUANTIDADE COTAS-->
						<td align="center" style="background-color: gray;border-radius: 5px;color: #1A1E23;font-size: 15px;font-weight: bold;width: 30%;">Cotas</td>

						<!--FIELD | QUANTIDADE COTAS-->
						<td style="width: 70%;">
							<input type="text" name="cotas" placeholder="Quantidade" id="cotas" maxlength="10" onKeypress="if (event.keyCode == 32) event.returnValue = false;" style="background-color: #1A1E23;border-radius: 5px;color: gray;font-size: 15px;font-weight: bold;height: 32px;text-transform: uppercase;width: 96%;" required>
						</td>
					</tr>

					<!--PROVENTOS UNITÁRIO-->
					<tr>

						<!--TITULO | PROVENTO UNITÁRIO-->
						<td align="center" style="background-color: gray;border-radius: 5px;color: #1A1E23;font-size: 15px;font-weight: bold;width: 30%;">Proventos</td>

						<!--FIELD | PROVENTO UNITÁRIO-->
						<td style="width: 70%;">
							<input type="text" name="proventos" placeholder="Pago por cota" id="proventos" maxlength="10" onKeypress="if (event.keyCode == 32) event.returnValue = false;" style="background-color: #1A1E23;border-radius: 5px;color: gray;font-size: 15px;font-weight: bold;height: 32px;text-transform: uppercase;width: 96%;" required>
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
				<!--FIM FORMULARIO CADASTRAR-->



				<!--BOTÕES-->
				<table align="center" cellspacing="5px" style="height: 50px;margin-top: 10px;width: 90%;">

					<!--CADASTRAR-->
					<tr>
						<td style="width: 90%;">
							<input type="submit" value="Cadastrar" style="background-color: #228B22;border-color: #006400;color: white;border-radius: 5px;font-family: calibri;font-size: 18px;font-weight: bold;height: 32px;text-transform: uppercase;width: 100%;">
						</td>
					</tr>

					<!--VOLTAR-->
					<tr>
						<td style="width: 90%;">
							<a href="../../DASHBOARD/dashboard.php"><input type="button" value="Voltar" style="background-color: gray;color: #1A1E23;border-radius: 5px;font-family: calibri;font-size: 18px;font-weight: bold;height: 32px;text-transform: uppercase;width: 100%;"></a>
						</td>
					</tr>
				</table>
				<!--FIM BOTÕES-->
			</td>
			<!--FIM INVESTIMENTO-->
		</tr>
	</table>
	<!--FIM CADASTRAR ATIVO-->



</form>
<!--FIM FORMULARIO-->


</body>
</html>