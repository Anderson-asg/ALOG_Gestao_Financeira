<!--CONEXÃO BANCO DE DADOS + BLOQUEIO ACESSO =================-->
<?php

session_start();
include_once("../BACK-END/PHP/BD/conexao.php");

?>
<!--==========================================================-->



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" http-equiv="refresh" content="50">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ALOG | LOGIN</title>

	<!--SCRIPT-->

	<!--BLOQUEIA CLIQUE ESQUERDO-->
	<script type="text/javascript">document.addEventListener('contextmenu', event => event.preventDefault());</script>
</head>
<body style="background-color: #1A1E23;font-family: calibri;text-transform: uppercase;">



<!--FORMULÁRIO-->
<form method="post" action="../BACK-END/PHP/LOGIN/login.php">



	<!--ALOG | LOGIN-->
	<table cellspacing="20px" style="height: 345px;width: 35%;">
		<tr>



			<!--LOGIN-->
			<td style="background-color: #252B30;border-radius: 10px;box-shadow: 1.5px 1.5px 1.5px black;">



				<!--TITULO LOGIN-->
				<table align="center" cellspacing="5px" style="height: 120px;width: 90%;">

					<!--LOGIN-->
					<tr>

						<!--ICONE-->
						<td rowspan="2" style="border-radius: 10px;font-size: 50px;width: 10%;">🔒</td>

						<!--TITULO-->
						<td style="color: gray;font-size: 20px;font-weight: bold;vertical-align: bottom;width: 80%;">Login</td>
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
				<!--FIM TITULO LOGIN-->



				<!--FORMULARIO LOGIN-->
				<table align="center" cellspacing="5px" style="height: 50px;width: 90%;">

					<!--USUARIO-->
					<tr>

						<!--TITULO | USUARIO-->
						<td align="center" style="background-color: gray;border-radius: 5px;color: #1A1E23;font-size: 15px;font-weight: bold;width: 30%;">Usuario</td>

						<!--FIELD | USUARIO-->
						<td style="width: 70%;">
							<input type="email" name="email" autofocus="true" maxlength="24" onKeypress="if (event.keyCode == 32) event.returnValue = false;" style="background-color: #1A1E23;border-radius: 5px;color: gray;font-size: 15px;font-weight: bold;height: 32px;text-transform: uppercase;width: 96%;" required>
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
				<!--FIM FORMULARIO LOGIN-->



				<!--BOTÃO-->
				<table align="center" cellspacing="5px" style="height: 50px;margin-top: 10px;width: 90%;">

					<!--LOGAR-->
					<tr>
						<td style="width: 90%;">
							<input type="submit" value="LOG IN" style="background-color: #228B22;border-color: #006400;border-radius: 5px;color: white;font-family: calibri;font-size: 18px;font-weight: bold;height: 32px;text-transform: uppercase;width: 100%;">
						</td>
					</tr>
				</table>
				<!--FIM BOTÕES-->
			</td>
			<!--FIM LOGIN-->
		</tr>
	</table>
	<!--FIM ALOG | LOGIN-->



</form>
<!--FIM FORMULÁRIO-->



</body>
</html>