<?php
require __DIR__ . '/../config.php';

foreach($_POST as $key => $value)
{
	if( !is_array($value) ) $_POST[$key] = antiSQL($value);
}


$msg_ok    = "Mensagem enviada com sucesso!";
$msg_erro  = "Ops! Ocorreu um erro. Por favor tente novamente!";
$msg_todos = "Preencha todos os campos!";


if ( $_POST )
{
	if ( $_POST["nome"] != "" && 
		 $_POST["telefone"] != "" && 
		 $_POST["email"] != "" 
		)
	{



		$array_data = [
			'titulo' 	=> $_POST['nome'],
			'empresa' 	=> $_POST['empresa'],
			'telefone' 	=> $_POST['telefone'],
			'email' 	=> $_POST['email'],
			'mensagem' 	=> $_POST['mensagem'],
		];

		$insert = $db->insert($tables['LEADS'], $array_data);

		



		// E-MAIL PARA O ADMINISTRADOR

		$assunto  = EMPRESA." - LP Construtoras";
		$mensagem = '<h3>'.EMPRESA.' - LP Construtoras</h3>
					<br>
					<strong>Nome</strong>: '.$_POST["nome"].'<br><br>
					<strong>Empresa</strong>: '.$_POST["empresa"].'<br><br>
					<strong>E-mail</strong>: '.$_POST["email"].'<br><br>
					<strong>Telefone</strong>: '.$_POST["telefone"].'<br><br>				
					<strong>Mensagem</strong>: '.$_POST["mensagem"].'<br><br>				
					';

		$enviado = SendMailAdm($assunto, $mensagem, $_POST["email"]);

		/* ==================================================================== */

		if ($enviado) {
			echo json_encode(['status'=>'1', 'message'=>$msg_ok]);
		} else {
			echo json_encode(['status'=>'0', 'message'=>$msg_erro]);
		}
	} else {
		echo json_encode(['status'=>'0', 'message'=>$msg_todos]);
	}
}