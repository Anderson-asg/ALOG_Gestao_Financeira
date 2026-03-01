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
	<title>ALOG | INVESTIMENTO</title>

	<!--SCRIPTS-->

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



<!--PHP BUSCA INVESTIMENTOS-->
<?php

//VARIAVEIS FORMULÁRIO
$ticker = $_POST['ticker'];
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



	//BUSCA DADOS DO TICKER NO BANCO DE DADOS
	$valida = "SELECT * FROM investimento WHERE ticker = '$ticker'";
	$valida_ticker = mysqli_query($conn, $valida);
	while ($linha = mysqli_fetch_assoc($valida_ticker)){



		//SELECIONA COLUNAS DO BD PARA LOGICA
		$ticker = $linha ['ticker'];
		$cotacao = number_format($linha ['cotacao'], 2, '.', '');
		$cotas = number_format($linha ['cotas'], 2, '.', '');
		$proventos = number_format($linha ['proventos'], 2, '.', '');



	//FIM WHILE
	}



	//CRIA SESSÃO TICKER
	//sessão atuará no update do ajustar (back-end)
	$_SESSION['ticker'] = $ticker;



?>
<!--FIM PHP-->



<!--FORMULÁRIO-->
<form method="post" action="../../BACK-END/PHP/INVESTIMENTO/AJU/ajustar.php">



	<!--AJUSTAR ATIVO-->
	<table cellspacing="20px" style="height: 470px;width: 35%;">
		<tr>



			<!--INVESTIMENTO-->
			<td style="background-color: #252B30;border-radius: 10px;box-shadow: 1.5px 1.5px 1.5px black;">



				<!--TITULO AJUSTAR-->
				<table align="center" cellspacing="5px" style="height: 120px;width: 90%;">

					<!--AJUSTAR-->
					<tr>

						<!--ICONE-->
						<td rowspan="2" style="border-radius: 10px;font-size: 50px;width: 10%;">⚙️</td>

						<!--TITULO-->
						<td style="color: gray;font-size: 20px;font-weight: bold;vertical-align: bottom;width: 80%;"><?php echo $ticker;?></td>
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
				<!--FIM TITULO AJUSTAR-->



				<!--FORMULARIO AJUSTAR-->
				<table align="center" cellspacing="5px" style="height: 50px;width: 90%;">

					<!--COTAÇÃO-->
					<tr>

						<!--TITULO | COTAÇÃO-->
						<td align="center" style="background-color: gray;border-radius: 5px;color: #1A1E23;font-size: 15px;font-weight: bold;width: 30%;">Cotação</td>

						<!--FIELD | COTAÇÃO-->
						<td style="width: 70%;">
							<input type="text" name="cotacao" value="<?php echo $cotacao;?>" placeholder="Hoje" id="cotacao" autofocus="true" maxlength="10" onKeypress="if (event.keyCode == 32) event.returnValue = false;" style="background-color: #1A1E23;border-radius: 5px;color: gray;font-size: 15px;font-weight: bold;height: 32px;text-transform: uppercase;width: 96%;" required>
						</td>
					</tr>

					<!--QUANTIDADE COTAS-->
					<tr>

						<!--TITULO | QUANTIDADE COTAS-->
						<td align="center" style="background-color: gray;border-radius: 5px;color: #1A1E23;font-size: 15px;font-weight: bold;width: 30%;">Cotas</td>

						<!--FIELD | QUANTIDADE COTAS-->
						<td style="width: 70%;">
							<input type="text" name="cotas" value="<?php echo $cotas;?>" placeholder="Quantidade" id="cotas" maxlength="10" onKeypress="if (event.keyCode == 32) event.returnValue = false;" style="background-color: #1A1E23;border-radius: 5px;color: gray;font-size: 15px;font-weight: bold;height: 32px;text-transform: uppercase;width: 96%;" required>
						</td>
					</tr>

					<!--PROVENTOS UNITÁRIO-->
					<tr>

						<!--TITULO | PROVENTO UNITÁRIO-->
						<td align="center" style="background-color: gray;border-radius: 5px;color: #1A1E23;font-size: 15px;font-weight: bold;width: 30%;">Proventos</td>

						<!--FIELD | PROVENTO UNITÁRIO-->
						<td style="width: 70%;">
							<input type="text" name="proventos" value="<?php echo $proventos;?>" placeholder="Pago por cota" id="proventos" maxlength="10" onKeypress="if (event.keyCode == 32) event.returnValue = false;" style="background-color: #1A1E23;border-radius: 5px;color: gray;font-size: 15px;font-weight: bold;height: 32px;text-transform: uppercase;width: 96%;" required>
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
			<!--FIM INVESTIMENTO-->
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