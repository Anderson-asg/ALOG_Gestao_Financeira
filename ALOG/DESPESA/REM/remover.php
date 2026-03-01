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

	<!--SCRIPT-->

	<!--BLOQUEIA CLIQUE ESQUERDO-->
	<script type="text/javascript">document.addEventListener('contextmenu', event => event.preventDefault());</script>
</head>
<body style="background-color: #1A1E23;font-family: calibri;text-transform: uppercase;">



<!--FORMULÁRIO-->
<form method="post" action="../../BACK-END/PHP/DESPESA/REM/remover.php">



	<!--REMOVER FORNECEDOR-->
	<table cellspacing="20px" style="height: 380px;width: 35%;">
		<tr>



			<!--DESPESA-->
			<td style="background-color: #252B30;border-radius: 10px;box-shadow: 1.5px 1.5px 1.5px black;">



				<!--TITULO REMOVER FORNECEDOR-->
				<table align="center" cellspacing="5px" style="height: 120px;width: 90%;">

					<!--REMOVER-->
					<tr>

						<!--ICONE-->
						<td rowspan="2" style="border-radius: 10px;font-size: 50px;width: 10%;">⛔</td>

						<!--TITULO-->
						<td style="color: gray;font-size: 20px;font-weight: bold;vertical-align: bottom;width: 80%;">Remover Fornecedor</td>
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
				<!--FIM TITULO REMOVER FORNECEDOR-->



				<!--FORMULARIO REMOVER FORNECEDOR-->
				<table align="center" cellspacing="5px" style="height: 50px;width: 90%;">

					<!--FORNECEDOR-->
					<tr>

						<!--TITULO | FORNECEDOR-->
						<td align="center" style="background-color: gray;border-radius: 5px;color: #1A1E23;font-size: 15px;font-weight: bold;width: 30%;">Fornecedor</td>

						<!--FIELD | FORNECEDOR-->
						<td style="width: 70%;">
							<select name="fornecedor" autofocus="true" style="background-color: #1A1E23;border-radius: 5px;color: gray;font-size: 15px;font-weight: bold;height: 38px;text-transform: uppercase;width: 99.4%;" required>
								<option value="" selected>Selecione</option>



		                        <!--PHP BUSCA TODOS FORNECEDORES-->
		                        <?php

		                        //BUSCA NO BD FORNECEDORES CADASTRADOS
		                        $valida = "SELECT * FROM despesa";
		                        $valida_fornecedor = mysqli_query($conn, $valida);
		                        while ($linha = mysqli_fetch_assoc($valida_fornecedor)){


		                        	//SELECIONA COLUNAS DO BD PARA LOGICA
									$fornecedor = $linha ['fornecedor'];
									$servico = $linha ['servico'];



									//INFORMA LISTA DOS FORNECEDORES
									echo "<option value=".$fornecedor.">".$fornecedor." ".$servico."</option>";



								//FIM WHILE
		                        }



		                        ?>
		                        <!--FIM PHP-->
							</select>
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
				<!--FIM FORMULARIO REMOVER FORNECEDOR-->



				<!--BOTÕES-->
				<table align="center" cellspacing="5px" style="height: 50px;margin-top: 10px;width: 90%;">

					<!--REMOVER-->
					<tr>
						<td style="width: 90%;">
							<input type="submit" value="Remover" style="background-color: #228B22;border-color: #006400;border-radius: 5px;color: white;font-family: calibri;font-size: 18px;font-weight: bold;height: 32px;text-transform: uppercase;width: 100%;">
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
			<!--FIM DESPESA-->
		</tr>
	</table>
	<!--FIM REMOVER FORNECEDOR-->



</form>
<!--FIM FORMULÁRIO-->



</body>
</html>