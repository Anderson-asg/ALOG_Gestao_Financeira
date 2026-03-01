<!--CONEXÃO BANCO DE DADOS + BLOQUEIO ACESSO =================-->
<?php

session_start();
include_once("../BACK-END/PHP/BD/conexao.php");

//CONTADOR DE LOGIN
$contador_login = $_SESSION['contador_login'];

//USUARIO NOME
$us_nome = $_SESSION['us_nome'];

//VALIDA SE LOGIN FOI EFETUADO
if($contador_login == 1){ } else { header("Location: ../LOGIN/login.php"); }

?>
<!--==========================================================-->



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" http-equiv="refresh" content="10">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ALOG | DASHBOARD</title>

	<!--SCRIPT-->

	<!--BLOQUEIA CLIQUE ESQUERDO-->
	<script type="text/javascript">document.addEventListener('contextmenu', event => event.preventDefault());</script>
</head>
<body style="background-color: #1A1E23;font-family: calibri;text-transform: uppercase;">



	<!--DASHBOARD | I.R.D.-->
	<table cellspacing="20px" style="height: 200px;width: 100%;">
		<tr>

			<!--PAINEL-->
			<td style="background-color: #252B30;border-radius: 10px;box-shadow: 1.5px 1.5px 1.5px black;width: 25%;">



				<!--ATRIBUTOS PAINEL-->
				<table align="center" cellspacing="5px" style="width: 90%;">



					<!--TITULO-->
					<tr>

						<!--TITULO PAINEL-->
						<td style="color: gray;font-size: 15px;font-weight: bold;height: 20px;width: 65%;">Painel</td>
					</tr>



					<!--USUÁRIO-->
					<tr>

						<!--NOME USUÁRIO-->
						<td style="color: white;font-size: 20px;font-weight: bold;height: 30px;width: 65%;"><?php echo $us_nome; ?></td>
					</tr>



					<!--MENU-->
					<tr>

						<!--PAINEL-->
						<td style="font-size: 20px;height: 20px;width: 65%;">

							<!--LOGOUT-->
							<a href="../BACK-END/PHP/LOGOUT/logout.php" style="color: white;text-decoration: none;">❌ Sair</a>
						</td>
					</tr>
				</table>
			</td>
			<!--FIM PAINEL-->



			<!--[ I ] INVESTIMENTO-->
			<td style="background-color: #252B30;border-radius: 10px;box-shadow: 1.5px 1.5px 1.5px black;width: 25%;">



				<!--PHP BUSCA INFORMAÇÕES EM INVESTIMENTO-->
				<?php

				//VARIAVEIS BACK-END
				$investido = 0;//valor investido por ativo
				$investimento = "0.00";//total investimento



				//BUSCA NO BANCO DE DADOS INVESTIMENTOS APORTADOS
				$valida = "SELECT * FROM investimento WHERE status = 'ap'";
				$valida_investimento = mysqli_query($conn, $valida);
				while ($linha = mysqli_fetch_assoc($valida_investimento)){



					//SELECIONA COLUNAS DO BD PARA LOGICA
					$cotacao = number_format($linha ['cotacao'], 2, '.', '');
					$cotas = number_format($linha ['cotas'], 2, '.', '');



					//ENCONTRA VALOR TOTAL DE APORTES
					$investido = $cotacao * $cotas;
					$investimento = $investimento + $investido;
					$investimento = number_format($investimento, 2, '.', '');



				//FIM WHILE
				}



				?>
				<!--FIM PHP-->



				<!--ATRIBUTOS INVESTIMENTO-->
				<table align="center" cellspacing="5px" style="width: 90%;">



					<!--TITULO-->
					<tr>

						<!--ICONE-->
						<td rowspan="3" style="background-color: #160059;border-radius: 10px;width: 40%;"><img src="../BACK-END/IMG/Investimento.png" style="height: 35px;width: 100%;"></td>

						<!--TITULO INVESTIMENTO-->
						<td style="color: gray;font-size: 15px;font-weight: bold;height: 20px;width: 50%;">Investimento</td>
					</tr>



					<!--VALOR-->
					<tr>

						<!--VALOR TOTAL INVESTIMENTO-->
						<td style="color: white;font-size: 25px;font-weight: bold;height: 30px;width: 50%;"><?php echo "R$ ".$investimento; ?></td>
					</tr>



					<!--MENU-->
					<tr>

						<!--CONFIGURAÇÃO-->
						<td style="font-size: 20px;height: 20px;width: 50%;">

							<!--CADASTRAR-->
							<a href="../INVESTIMENTO/CAD/cadastrar.php" style="text-decoration: none;">💾</a>

							<!--AJUSTAR-->
							<a href="../INVESTIMENTO/AJU/buscar.php" style="text-decoration: none;">⚙️</a>

							<!--REMOVER-->
							<a href="../INVESTIMENTO/REM/remover.php" style="text-decoration: none;">⛔</a>
						</td>
					</tr>
				</table>
			</td>
			<!--FIM INVESTIMENTO-->



			<!--[ R ] RESERVA-->
			<td style="background-color: #252B30;border-radius: 10px;box-shadow: 1.5px 1.5px 1.5px black;width: 25%;">



				<!--PHP BUSCA INFORMAÇÕES EM RESERVA-->
				<?php

				//VARIAVEL BACK-END
				$aporte = "0.00";



				//BUSCA NO BANCO DE DADOS
				$valida = "SELECT * FROM reserva WHERE status = 'ap'";
				$valida_reserva = mysqli_query($conn, $valida);
				while ($linha = mysqli_fetch_assoc($valida_reserva)){



					//SELECIONA COLUNAS DO BD PARA LOGICA
					$aporte = number_format($linha ['aporte'], 2, '.', '');



				//FIM WHILE
				}



				?>
				<!--FIM PHP-->



				<!--ATRIBUTOS RESERVA-->
				<table align="center" cellspacing="5px" style="width: 90%;">



					<!--TITULO-->
					<tr>

						<!--ICONE-->
						<td rowspan="3" style="background-color: #003E6B;border-radius: 10px;width: 40%;"><img src="../BACK-END/IMG/Reserva.png" style="height: 35px;width: 100%;"></td>

						<!--TITULO RESERVA-->
						<td style="color: gray;font-size: 15px;font-weight: bold;height: 20px;width: 50%;">Reserva</td>
					</tr>



					<!--VALOR-->
					<tr>

						<!--VALOR TOTAL RESERVA-->
						<td style="color: white;font-size: 25px;font-weight: bold;height: 30px;width: 50%;"><?php echo "R$ ".$aporte; ?></td>
					</tr>



					<!--MENU-->
					<tr>

						<!--CONFIGURAÇÃO-->
						<td style="font-size: 20px;height: 20px;width: 50%;">

							<!--CADASTRAR-->
							<a href="../RESERVA/CAD/cadastrar.php" style="text-decoration: none;">💾</a>

							<!--AJUSTAR-->
							<a href="../RESERVA/AJU/buscar.php" style="text-decoration: none;">⚙️</a>

							<!--REMOVER-->
							<a href="../RESERVA/REM/remover.php" style="text-decoration: none;">⛔</a>
						</td>
					</tr>
				</table>
			</td>
			<!--FIM RESERVA-->



			<!--[ D ] DESPESA-->
			<td style="background-color: #252B30;border-radius: 10px;box-shadow: 1.5px 1.5px 1.5px black;width: 25%;">



				<!--PHP BUSCA INFORMAÇÕES EM RESERVA-->
				<?php

				//VARIAVEL BACK-END
				$despesa = "0.00";
				$soma_despesa = 0;



				//BUSCA NO BANCO DE DADOS
				$valida = "SELECT * FROM despesa";
				$valida_despesa = mysqli_query($conn, $valida);
				while ($linha = mysqli_fetch_assoc($valida_despesa)){



					//SELECIONA COLUNAS DO BD PARA LOGICA
					$orcamento = number_format($linha ['orcamento'], 2, '.', '');
					$parcelas_tt = number_format($linha ['parcela_at'], 2, '.', '');



					//CORRIGE ERRO DE DIVISÃO POR '0' NA DIVISÃO DE PARCELAS
					if($parcelas_tt > 0){

						//SOMA ORCAMENTOS EFETIVOS E PARCELADOS
						$orcamento_atual = $orcamento / $parcelas_tt;
						$soma_despesa = $soma_despesa + $orcamento_atual;
						$despesa = number_format($soma_despesa, 2, '.', '');

					} else {

						//SOMA ORCAMENTOS EFETIVOS E PARCELADOS
						$orcamento_atual = $orcamento;
						$soma_despesa = $soma_despesa + $orcamento_atual;
						$despesa = number_format($soma_despesa, 2, '.', '');

					}



				//FIM WHILE
				}



				?>
				<!--FIM PHP-->


				<!--ATRIBUTOS DESPESA-->
				<table align="center" cellspacing="5px" style="width: 90%;">



					<!--TITULO-->
					<tr>

						<!--ICONE-->
						<td rowspan="3" style="background-color: gray;border-radius: 10px;width: 40%;"><img src="../BACK-END/IMG/Despesa.png" style="height: 35px;width: 100%;"></td>

						<!--TITULO DESPESA-->
						<td style="color: gray;font-size: 15px;font-weight: bold;height: 20px;width: 50%;">Despesa</td>
					</tr>



					<!--VALOR-->
					<tr>

						<!--VALOR TOTAL DESPESA-->
						<td style="color: white;font-size: 25px;font-weight: bold;height: 30px;width: 50%;"><?php echo "R$ ".$despesa; ?></td>
					</tr>



					<!--MENU-->
					<tr>

						<!--CONFIGURAÇÃO-->
						<td style="font-size: 20px;height: 20px;width: 50%;">

							<!--CADASTRAR-->
							<a href="../DESPESA/CAD/cadastrar.php" style="text-decoration: none;">💾</a>

							<!--AJUSTAR-->
							<a href="../DESPESA/AJU/buscar.php" style="text-decoration: none;">⚙️</a>
							
							<!--REMOVER-->
							<a href="../DESPESA/REM/remover.php" style="text-decoration: none;">⛔</a>
						</td>
					</tr>
				</table>
			</td>
			<!--FIM DESPESA-->
		</tr>
	</table>
	<!--FIM DASHBOARD | I.R.D.-->



	<!--DASHBOARD | RELATÓRIO I.D.-->
	<table cellspacing="20px" style="height: 500px;width: 100%;">
		<tr>

			<!--RELATÓRIO [ I ] INVESTIMENTO-->
			<td colspan="3" style="background-color: #252B30;border-radius: 10px;box-shadow: 1.5px 1.5px 1.5px black;width: 55%;"><br>



				<!--PHP BUSCA INFORMAÇÕES EM INVESTIMENTO-->
				<?php

				//VARIAVEIS INICIA EM '0'
				//calcula valores totais aportado por classe de ativos
				$tt_acao = 0;
				$tt_etf = 0;
				$tt_fii = 0;
				$tt_rfx = 0;



				//calcula porcentagem aportada por classe de ativos
				$pc_acao = 0;
				$pc_etf = 0;
				$pc_fii = 0;
				$pc_rfx = 0;



				//BUSCA INFORMAÇÕES PARA CALCULAR PORCENTAGEM DAS CLASSES
				$relatorio_inv = "SELECT * FROM investimento WHERE status = 'ap'";
				$valida_relatorio = mysqli_query($conn, $relatorio_inv);
				while ($linha = mysqli_fetch_assoc($valida_relatorio)){



					//SELECIONA COLUNAS DO BD PARA LOGICA
					$classe = $linha['classe'];
					$cotacao = number_format($linha['cotacao'], 2, '.', '');
					$cotas = number_format($linha['cotas'], 2, '.', '');



					//VALIDA PORCENTAGEM PARA CADA CLASSE DE ATIVO
					if($classe == "acao"){

						//VALOR TOTAL APORTADO EM AÇÕES
						//'mt_acao' multiplica ativo para encontrar valor aplicado
						//'tt_acao' = acumula valores aportados nos ativos da mesma classe
						$mt_acao = $cotacao * $cotas;
						$tt_acao = $tt_acao + $mt_acao;

						//PORCENTAGEM DA CLASSE INVESTIDA
						//'investimento' trás o valor total investido
						//'pc_acao' calcula porcentagem na carteira dessa classse de ativo
						$pc_acao = ($tt_acao * 100) / $investimento;

						//VALIDA CASA DECIMAL E ADICIONA CARACTER ESPECIAL
						$pc_acao = number_format($pc_acao, 0, '.', '');
						$pc_acao = "🟩 ".$pc_acao."%";

					} else if($classe == "etf"){

						//VALOR TOTAL APORTADO EM ETFS
						//'mt_etf' multiplica ativo para encontrar valor aplicado
						//'tt_etf' = acumula valores aportados nos ativos da mesma classe
						$mt_etf = $cotacao * $cotas;
						$tt_etf = $tt_etf + $mt_etf;

						//PORCENTAGEM DA CLASSE INVESTIDA
						//'investimento' trás o valor total investido
						//'pc_etf' calcula porcentagem na carteira dessa classse de ativo
						$pc_etf = ($tt_etf * 100) / $investimento;

						//VALIDA CASA DECIMAL E ADICIONA CARACTER ESPECIAL
						$pc_etf = number_format($pc_etf, 0, '.', '');
						$pc_etf = "🟪 ".$pc_etf."%";

					} else if($classe == "fii"){

						//VALOR TOTAL APORTADO EM FIIS
						//'mt_fii' multiplica ativo para encontrar valor aplicado
						//'tt_fii' = acumula valores aportados nos ativos da mesma classe
						$mt_fii = $cotacao * $cotas;
						$tt_fii = $tt_fii + $mt_fii;

						//PORCENTAGEM DA CLASSE INVESTIDA
						//'investimento' trás o valor total investido
						//'pc_fii' calcula porcentagem na carteira dessa classse de ativo
						$pc_fii = ($tt_fii * 100) / $investimento;

						//VALIDA CASA DECIMAL E ADICIONA CARACTER ESPECIAL
						$pc_fii = number_format($pc_fii, 0, '.', '');
						$pc_fii = "🟨 ".$pc_fii."%";

					} else if($classe == "rfx"){

						//VALOR TOTAL APORTADO EM RFX
						//'mt_rfx' multiplica ativo para encontrar valor aplicado
						//'tt_rfx' = acumula valores aportados nos ativos da mesma classe
						$mt_rfx = $cotacao * $cotas;
						$tt_rfx = $tt_rfx + $mt_rfx;

						//PORCENTAGEM DA CLASSE INVESTIDA
						//'investimento' trás o valor total investido
						//'pc_rfx' calcula porcentagem na carteira dessa classse de ativo
						$pc_rfx = ($tt_rfx * 100) / $investimento;

						//VALIDA CASA DECIMAL E ADICIONA CARACTER ESPECIAL
						$pc_rfx = number_format($pc_rfx, 0, '.', '');
						$pc_rfx = "🟦 ".$pc_rfx."%";

					}



				//FIM WHILE
				}



				//VALIDA VALOR DAS VARIAVEIS DE CLASSES
				//caso sejam valor '0' então não serão executadas
				
				//AÇÃO
				if($pc_acao == 0){ $pc_acao = " "; }

				//ETF
				if($pc_etf == 0){ $pc_etf = " "; }

				//FII
				if($pc_fii == 0){ $pc_fii = " "; }

				//RFX
				if($pc_rfx == 0){ $pc_rfx = " "; }



				//EXECUTA RELATÓRIO DE INVESTIMENTOS
				echo "
					<table align=center style=background-color:#2D3D4E;border-radius:5px;color:white;width:600px;>



						<!--EXECUTA ATRIBUTOS DOS INVESTIMENTOS-->
						<tr>

							<!--ATIVOS-->
							<td align=center colspan=3 style=font-size:30px;height:85px;>📊 Ativos</td>

							<!--PORCENTAGEM LEGENDA AÇÃO | ETF-->
							<td colspan=2 style=font-size:25px;height:70px;>".$pc_acao."<br>".$pc_etf."</td>

							<!--PORCENTAGEM LEGENDA FII | RFX-->
							<td colspan=2 style=font-size:25px;height:70px;>".$pc_fii."<br>".$pc_rfx."</td>
						</tr>



						<!--EXECUTA ATRIBUTOS DOS INVESTIMENTOS-->
						<tr>

							<!--CLASSE-->
							<td align=center style=font-size:15px;height:50px;width:50px;>Classe</td>

							<!--TICKER-->
							<td align=center style=font-size:15px;height:50px;width:100px;>Ticker</td>

							<!--SEGMENTO-->
							<td align=center style=font-size:15px;height:50px;width:110px;>Segmento</td>

							<!--COTAÇÃO-->
							<td align=center style=font-size:15px;height:50px;width:100px;>Cotação</td>

							<!--COTAS-->
							<td align=center style=font-size:15px;height:50px;width:70px;>Cotas</td>

							<!--PORCENTAGEM RENTABILIDADE-->
							<td align=center style=font-size:15px;height:50px;width:70px;>%</td>

							<!--PROVENTOS-->
							<td align=center style=font-size:15px;height:50px;width:100px;>Prov.</td>
						</tr>
					</table>
				";



				//CONTADOR
				$c = 0;



				//INICIO - DIV SCROLL INVESTIMENTO
				echo "<div style=height:250px;overflow-y:auto;scrollbar-width:none;>";



				//BUSCA NO BANCO DE DADOS INVESTIMENTOS APORTADOS
				$valida = "SELECT * FROM investimento WHERE status = 'ap'";
				$valida_investimento = mysqli_query($conn, $valida);
				while ($linha = mysqli_fetch_assoc($valida_investimento)){



					//CONTADOR INCREMENTA
					$c = $c + 1;



					//SELECIONA COLUNAS DO BD PARA LOGICA
					$id = $linha['id'];
					$classe = $linha['classe'];
					$ticker = $linha['ticker'];
					$segmento = $linha['segmento'];
					$cotacao = number_format($linha['cotacao'], 2, '.', '');
					$cotas = number_format($linha['cotas'], 0, '.', '');
					$proventos = number_format($linha['proventos'], 2, '.', '');



					//ENCONTRA O PERCENTUAL DA RENTABILIDADE
					$tt_proventos = $proventos * $cotas;
					$tt_aporte = $cotacao * $cotas;
					$rentabilidade = ($tt_proventos / $tt_aporte) * 100;

					//VALIDA VALORES COM CARACTERES ESPECIAIS '%' E 'R$'
					$rentabilidade = number_format($rentabilidade, 2, '.', '')." %";
					$tt_proventos = "R$ ".number_format($tt_proventos, 2, '.', '');



					//VALIDA VARIAVEIS PARA TICKER DE RFX
					if($classe == "acao"){

						$rentabilidade = "🚫";
						$tt_proventos = "🚫";
					
					} else if($classe == "etf"){

						$rentabilidade = "🚫";
						$tt_proventos = "🚫";
					
					} else if($classe == "rfx"){

						$rentabilidade = "🚫";
						$tt_proventos = "🚫";
					
					}



					//VALIDA CLASSE POR LEGENDA DE CORES
					if ($classe == "acao"){

						//LEGENDA AÇÃO - VERDE
						$legenda = "#27AE60";

					} else if ($classe == "etf"){

						//LEGENDA ETF - PINK
						$legenda = "#9E26C9";

					} else if ($classe == "fii"){

						//LEGENDA FII - LARANJA
						$legenda = "#EA8B39";

					} else if ($classe == "rfx"){

						//LEGENDA RENDA FIXA - AZUL
						$legenda = "#1B51D0";

					}



					//EXECUTA RELATÓRIO COM INFORMAÇÕES DO BD
					echo "

						<table align=center style=background-color:#2D3D4E;border-radius:5px;color:white;height:50px;margin-top:5px;width:600px;>
							<tr>

								<!--CLASSE-->
								<td align=center style=background-color:".$legenda.";border-radius:5px;width:50px;>".$classe."</td>

								<!--TICKER-->
								<td align=center style=width:100px;>".$ticker."</td>

								<!--SEGMENTO-->
								<td align=center style=width:110px;>".$segmento."</td>

								<!--COTAÇÃO-->
								<td align=center style=background-color:#A52A2A;border-radius:10px;width:100px;>R$ ".$cotacao."</td>

								<!--COTAS-->
								<td align=center style=width:70px;>".$cotas."</td>

								<!--RENTABILIDADE-->
								<td align=center style=background-color:#008B8B;border-radius:10px;width:70px;>".$rentabilidade."</td>

								<!--TOTAL PROVENTOS-->
								<td align=center style=background-color:#2E8B57;border-radius:10px;width:100px;>".$tt_proventos."</td>
							</tr>
						</table>

					";
				//FIM WHILE
				}



				//CONDIÇÃO RETORNA A AUSÊNCIA DE ATIVOS NA BASE DE DADOS
				if($c == 0){

					echo "
						<table align=center style=background-color:#1C1C1C;border-radius:5px;color:white;height:50px;margin-top:10px;width:600px;>
							<tr>
								<td align=center>Sem ativos</td>
							</tr>
						</table>
					";
				}



				//FIM - DIV SCROLL INVESTIMENTO
				echo "</div>";



				?>
				<!--FIM PHP-->
				<br>
			</td>
			<!--FIM RELATÓRIO INVESTIMENTO-->



			<!--RELATÓRIO [ D ] DESPESA-->
			<td style="background-color: #252B30;border-radius: 10px;box-shadow: 1.5px 1.5px 1.5px black;width: 45%;">



				<!--PHP BUSCA INFORMAÇÕES EM DESPESA-->
				<?php

				//RECEBE MÊS ATUAL PARA EXECUTAR APENAS DESPESAS DO PERÍODO
				$mes_vigente = date('m');



				//VALIDA MÊS ATUAL ESCRITO POR EXTENSO EM PORTUGUÊS
				setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
				$mes = strftime("%B");



				//VALIDA SE SESSION ESTÁ VAZIA PARA EXECUTAR SOMA
				if(empty($_SESSION['soma_despesa_mes'])){

					//VARIAVEL RECEBE SOMA '0'
					//essa validação permite variavel não ficar indefinida
					$soma = 0;
					$soma = number_format($soma, 2, '.', '');
					$soma = "R$ ".$soma;
				
				} else {

					//TRÁS SESSION CRIADA ABAIXO, ADICIONA DECIMAL E CARACTER ESPECIAL
					$soma = $_SESSION['soma_despesa_mes'];
					$soma = number_format($soma, 2, '.', '');
					$soma = "R$ ".$soma;

				}



				//VALIDA SE SESSION ESTÁ VAZIA PARA EXECUTAR MSG
				if(empty($_SESSION['msg'])){

					//VARIAVEL RECEBE MSG OPERANDO...
					$msg = "🟠 Operando...";
				
				} else {

					//VARIAVEL RECEBE MSG DA BACK-END E EXECUTA
					$msg = $_SESSION['msg'];

				}



				//EXECUTA CALENDÁRIO RELATÓRIO
				echo "
					<table align=center style=background-color:#2D3D4E;border-radius:5px;color:white;width:480px;>



						<!--EXECUTA MÊS E LANÇAMENTOS DOS VALORES DESPESA NO PERÍODO-->
						<tr>

							<!--MÊS-->
							<td align=center colspan=3 style=font-size:30px;height:70px;>📅 ".$mes."</td>

							<!--LANÇAMENTO VALOR-->
							<td align=center colspan=2 style=font-size:25px;height:50px;><div style=font-size:15px;>Lançamentos</div>".$soma."</td>
						</tr>



						<!--EXECUTA MSG DA OPERAÇÃO-->
						<tr>

							<!--MSG-->
							<td align=center colspan=5 style=background-color:#222D3A;border-radius:5px;color:orange;font-size:15px;height:30px;vertical-align: top;>".$msg."</td>
						</tr>



						<!--EXECUTA ATRIBUTOS DAS DESPESAS-->
						<tr>

							<!--FORNECEDOR-->
							<td align=center style=font-size:15px;height:30px;width:100px;>Fornecedor</td>

							<!--SERVIÇO-->
							<td align=center style=font-size:15px;height:30px;width:100px;>Serviço</td>

							<!--ORÇAMENTO-->
							<td align=center style=font-size:15px;height:30px;width:100px;>Orçamento</td>

							<!--PARCELAMENTO-->
							<td align=center style=font-size:15px;height:30px;width:80px;>X</td>

							<!--VALIDAÇÃO-->
							<td align=center style=font-size:15px;height:30px;width:100px;>Validar</td>
						</tr>
					</table>
				";



				//DESTROI SESSÕES CRIADA PARA SOMA DESPESA MÊS E MSG
				unset($_SESSION['soma_despesa_mes']);
				unset($_SESSION['msg']);



				//CONTADOR
				$c = 0;



				//VARIAVEL INICIA EM '0' PARA SOMAR DESPESA MÊS
				$soma_dp_mes = 0;



				//SESSION INICIA EM '0' PARA CARREGAR SOMA DESPESA MÊS
				//variavel informa '0' ao ter todas despesas pagas no período
				$_SESSION['soma_despesa_mes'] = 0;



				//VARIAVEL INICIA EM '0'
				//variavel executa quando todas despesas forem validadas no período
				$td_validados = 0;



				//INICIO - DIV SCROLL DESPESA
				echo "<div style=height:250px;overflow-y:auto;scrollbar-width:none;>";



				//BUSCA NO BANCO DE DADOS DESPESAS
				$valida = "SELECT * FROM despesa";
				$valida_investimento = mysqli_query($conn, $valida);
				while ($linha = mysqli_fetch_assoc($valida_investimento)){



					//CONTADOR INCREMENTA
					$c = $c + 1;



					//SELECIONA COLUNAS DO BD PARA LOGICA
					$id = $linha['id'];
					$operacao = $linha['operacao'];
					$fornecedor = $linha['fornecedor'];
					$servico = $linha['servico'];
					$orcamento = number_format($linha['orcamento'], 2, '.', '');
					$parcelas = number_format($linha['parcelas'], 0, '.', '');
					$parcela_at = number_format($linha['parcela_at'], 0, '.', '');
					$vencimento = $linha['vencimento'];



				//VALIDA EXIBIÇÃO DE DATA DD/MM/AAAA
				$vencimento = strtotime($vencimento);
				$vencimento = date('m', $vencimento);



				//VALIDA MÊS DAS DESPESAS DO BANCO PARA EXECUTAR RELATÓRIO
				if($vencimento == $mes_vigente){



					//VALIDA VALOR DA PARCELA EFETIVA E FATURA
					if($operacao == "ef"){

						$orcamento = $orcamento / 1;
						$orcamento = number_format($orcamento, 2, '.', '');

					} else if ($operacao == "ft"){

						$orcamento = $orcamento / $parcelas;
						$orcamento = number_format($orcamento, 2, '.', '');

					}



					//VALIDA VALORES COM CARACTERES ESPECIAIS '/'
					$parcelamento = "💳<br>".$parcela_at." / ".$parcelas;



					//VALIDA VARIAVEIS PARA DESPESA EFETIVAS
					if($operacao == "ef"){

						$parcelamento = "🚫";

					}



					//VALIDA CORES ZEBRADAS DE DESPESAS USANDO MÓDULO
					//se o valor de id tiver resto na divisão usa cor forte senão cor fraca
					if($id % 2){

						$cor_despesa = "#434b56";

					} else {

						$cor_despesa = "#62666f";

					}



					//VALIDA SOMA E CRIA SESSION EM VALOR DESPESA MÊS
					//session usada para carregar despesa total do mês atual
					//valor será executado no cabeçalho de relatório despesa
					$soma_dp_mes = $soma_dp_mes + $orcamento;
					$_SESSION['soma_despesa_mes'] = $soma_dp_mes;



					//EXECUTA RELATÓRIO COM INFORMAÇÕES DO BD
					echo "
						<table align=center style=background-color:".$cor_despesa.";border-radius:5px;color:white;font-size:15px;height:50px;margin-top:5px;width:480px;>
							<tr>

								<!--FORNECEDOR-->
								<td align=center style=width:100px;>".$fornecedor."</td>

								<!--SERVIÇO-->
								<td align=center style=width:100px;>".$servico."</td>

								<!--ORÇAMENTO-->
								<td align=center style=width:100px;>".$orcamento."</td>

								<!--PARCELAMENTO-->
								<td align=center style=width:80px;>".$parcelamento."</td>

								<!--VALIDA ID DA DESPESA-->
								<td align=center style=border-radius:5px;width:100px;>

									<!--FORMULÁRIO-->
									<form action=../BACK-END/PHP/DASHBOARD/dashboard.php method=post>

										<!--ID-->
										<input type=hidden name=id value=".$id." style=background-color:#1C1C1C;color:gray;height:18px;vertical-align:top;width:15px;>

										<!--BOTÃO-->
										<input type=submit value=OK style=background-color:#2E8B57;border-color:#3CB371;border-radius:5px;color:white;font-size:15px;font-weight:bold;height:25px;>

									<!--FIM FORMULÁRIO-->
									</form>

								<!--FIM VALIDAÇÃO ID-->
								</td>
							</tr>
						</table>
					";



				//SENÃO ENCONTRAR DESPESAS PARA O PERÍODO...
				//a lógica pega como base a soma das despesas do período
				//se a soma das despesa for '0' então informa 'todos lançamentos validados'
				} else if($soma_dp_mes == 0){



					//VARIAVEL RECEBE '1' INDICANDO TODOS LANÇAMENTOS VALIDADOS
					$td_validados = 1;



				//FIM VALIDAÇÃO DE DESPESA RELATÓRIO NO PERÍODO
				}



				//FIM WHILE
				}



				//RETORNA TODOS LANÇAMENTOS VALIDADOS NO PERÍODO
				if($td_validados == 1){

					echo "
						<table align=center style=background-color:#1C1C1C;border-radius:5px;color:white;height:50px;margin-top:10px;width:480px;>
							<tr>
								<td align=center>Todos lançamentos validados</td>
							</tr>
						</table>
					";
				}



				//RETORNA A AUSÊNCIA DE DESPESAS NA BASE DE DADOS
				if($c == 0){

					echo "
						<table align=center style=background-color:#1C1C1C;border-radius:5px;color:white;height:50px;margin-top:10px;width:480px;>
							<tr>
								<td align=center>Sem Lançamentos</td>
							</tr>
						</table>
					";
				}



				//FIM - DIV SCROLL DESPESA
				echo "</div>";



				?>
				<!--FIM PHP-->
			</td>
			<!--FIM RELATÓRIO DESPESA-->
		</tr>
	</table>
	<!--FIM DASHBOARD | RELATÓRIO I.D.-->



</body>
</html>