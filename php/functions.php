<?php
function full_url()
{
    $s  = ( empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on"? "s" : ""));
    $sp = strtolower($_SERVER["SERVER_PROTOCOL"]);
    $protocol = substr($sp, 0, strpos($sp, "/")) . $s;
    $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
    return $protocol . "://" . $_SERVER['SERVER_NAME'] . $port . $_SERVER['REQUEST_URI'];
}

function PageCanomical() {
	$parsed_url = parse_url( full_url() );
	$base_url   = $parsed_url['scheme'] . '://' . $parsed_url['host'] . $parsed_url['path'];
	return $base_url;
}

function validElement($element) {
    return strlen($element) > 0;
}

function removeBlankElement($array) {
	return array_values(array_filter($array, "validElement"));
}

function countFolder($url) {
    $url = preg_replace('(^https?://)', '', $url);
    $url = preg_replace('(^[a-zA-Z0-9\-\.]+)', '', $url);
    $url = rtrim($url, '/');
    $partes = explode('/', $url);
    $partes = array_filter($partes);

    return count($partes);
}

function returnFriendyURL() {
	$modrewrite = explode("/", str_replace(strrchr($_SERVER["REQUEST_URI"], "?"), "", $_SERVER["REQUEST_URI"]));
	$modrewrite = removeBlankElement($modrewrite);

	if(LOCALHOST){
		$count = countFolder(HTTP);
	}else{
		$count = SHIFT_NUM;
	}

	for ($i = 0; $i < $count; $i++) {
		array_shift($modrewrite);
	}

	return $modrewrite;
}

function limpaString($string) {
	$valid_chars_regex = 'a-zA-Z0-9';
	return preg_replace('/[^'.$valid_chars_regex.']|\.+$/i', " ", $string);
}

function CurrentPageURL() {
	$pageURL = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	return $pageURL;
}

function script_name() {
	$script_name = explode('/',$_SERVER['REQUEST_URI']);
	if(count($script_name)>0) return end($script_name);
	else return $script_name;
}

function javascript_enqueue($location='home',$return='echo') {
	global $javascript;
	
	foreach($javascript as $js)
	{
		if( LOCALHOST ){
			$_html[] = '<script src="'.($location=='home'?ASSETS:ASSETS_GESTOR).'js/'.$js.'?v='.rand(0,9999).'"></script>';
		}else{
			$_html[] = '<script src="'.($location=='home'?ASSETS:ASSETS_GESTOR).'js/'.$js.'"></script>';
		}
	}
	
	if($return=='return') return implode("\n",$_html);
	else echo "\n".implode("\n",$_html);
}

function add_javascript($array) {
	global $javascript;
	foreach($array as $file) if(!in_array($file,$javascript)) array_push($javascript, $file);
}

function style_enqueue($location='home',$return='echo') {
	global $style;

	foreach($style as $css)
	{
		if( LOCALHOST ){
			$_html[] = '<link rel="stylesheet" href="'.($location=='home'?ASSETS:ASSETS_GESTOR).$css.'?v='.rand(0,9999).'" type="text/css" />';
		}else{
			$_html[] = '<link rel="stylesheet" href="'.($location=='home'?ASSETS:ASSETS_GESTOR).$css.'" type="text/css" />';
		}
	} 

	if($return=='return') return implode("\n",$_html);
	else echo implode("\n",$_html);
}

function add_style($array) {
	global $style;
	foreach($array as $file) if(!in_array($file,$style)) array_push($style, $file);
}

// function clean_string($str, $replace=array(), $delimiter='-') {
// 	if(!empty($replace)) $str = str_replace((array)$replace, ' ', $str);
// 	$clean = preg_replace("/[^a-zA-Z0-9\ \-\.]/", '', $str);
// 	$clean = strtolower(trim($clean, '-'));
// 	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
// 	return $clean;
// }

function clean_string($str, $replace=array(), $delimiter='-') {
	if(!empty($replace)) $str = str_replace((array)$replace, ' ', $str);
	$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
	$clean = preg_replace("/[^a-zA-Z0-9\ \-\.]/", '', $clean);
	$clean = strtolower(trim($clean, '-'));
	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
	return $clean;
}



function get_templates($select=NULL) {
	$array_ignore_file = array();
	foreach(glob(TEMPLATE.'*.php') as $file) {
		$info = pathinfo($file);
		if(!in_array($info['filename'],$array_ignore_file)) $option_list[] = '<option value="'.$info['basename'].'" '.($info['basename']==$select?'selected':false).'>'.$info['filename']."</option>";
	}
	echo implode("\n",$option_list);
}

function get_pages($select=array()) {
	global $db,$tables;
	$query = $db->get_results("SELECT * FROM ".$tables['PAGINAS']);
	foreach($query as $page) $option_list[] = '<option value="'.$page->id.'" '.(in_array($page->id,$select)?'selected':false).'>'.$page->titulo."</option>";
	echo implode("\n",$option_list);
}

function printr($string) {
	echo '<pre>';
	print_r($string);
	echo '</pre>';
}

function get_size_in_byte($size) {
	$unit = strtoupper(substr($size, -2));
	$multiplier = ($unit == 'MB' ? 1048576 : ($unit == 'KB' ? 1024 : ($unit == 'GB' ? 1073741824 : 1)));
	$only_size = str_replace($unit, '', strtoupper($size));
	return $only_size*$multiplier;
}

function upload($upload_name,$save_path,$max_file_size,$whitelist=[],$blacklist=[],$overwrite=false,$rename='md5') {
	// Check post_max_size (http://us3.php.net/manual/en/features.file-upload.php#73762)
	$POST_MAX_SIZE = ini_get('post_max_size');
	$unit = strtoupper(substr($POST_MAX_SIZE, -1));
	$multiplier = ($unit == 'M' ? 1048576 : ($unit == 'K' ? 1024 : ($unit == 'G' ? 1073741824 : 1)));
	if ((int)$_SERVER['CONTENT_LENGTH'] > $multiplier*(int)$POST_MAX_SIZE && $POST_MAX_SIZE) return array('false','POST exceeded maximum allowed size.');
	$max_file_size_in_bytes = get_size_in_byte($max_file_size);

	// Other variables
	$MAX_FILENAME_LENGTH = 260;
	$uploadErrors = array(
        0=>'There is no error, the file uploaded with success',
        1=>'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        2=>'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        3=>'The uploaded file was only partially uploaded',
        4=>'Upload não efetuado',
        6=>'Pasta temporaria não encontrada'
	);

	// Validate the upload
	if (!isset($_FILES[$upload_name]))
		return array('false','No upload found in \$_FILES for ' . $upload_name);
	else if (isset($_FILES[$upload_name]['error']) && $_FILES[$upload_name]['error'] != 0)
		return array('false',$uploadErrors[$_FILES[$upload_name]['error']]);
	else if (!isset($_FILES[$upload_name]['tmp_name']) || !@is_uploaded_file($_FILES[$upload_name]['tmp_name']))
		return array('false','Upload inválido');
	else if (!isset($_FILES[$upload_name]['name']))
		return array('false','Arquivo inválido (noname).');

	// Validate the file size (Warning: the largest files supported by this code is 2GB)
	$file_size = @filesize($_FILES[$upload_name]['tmp_name']);
	if (!$file_size || $file_size > $max_file_size_in_bytes) return array('false','Tamanho ultrapassado ('.strtoupper($max_file_size).')');
	if ($file_size <= 0) return array('false','Arquivo inválido (0 byte)');

	// Validate file name (for our purposes we'll just remove invalid characters)
	$file_name = strtolower(basename($_FILES[$upload_name]['name']));

	// Rename the file to be save
	if($rename) {
		switch($rename) {
			case 'md5':
				$info =  pathinfo($file_name);
				$file_name = strtolower(md5($file_name. time()).'.'.$info['extension']);
			break;
			default:
			$info =  pathinfo($file_name);
			$file_name = strtolower($rename.'.'.$info['extension']);
		}
	}

	// Validate file name (for our purposes we'll just remove invalid characters)
	if (strlen($file_name) == 0 || strlen($file_name) > $MAX_FILENAME_LENGTH) return array('false','Nome inválido');

	// Validate that we won't over-write an existing file
	if(!$overwrite) if(file_exists($save_path . $file_name)) return array('false','Este nome já esta sendo usado');

	// Validate file extension
	if($whitelist) if(!in_array(end(explode('.', $file_name)), $whitelist)) return array('false','Extensão inválida');
	if($blacklist) if(in_array(end(explode('.', $file_name)), $blacklist)) return array('false','Extensão inválida');

	// Verify! Upload the file
	if(!move_uploaded_file($_FILES[$upload_name]['tmp_name'], $save_path.$file_name)) return array('false','Não foi possível fazer o upload.');
	else return array((boolean)true,$file_name,$file_size);
	exit(0);
}

function br2nl($string,$ql='\n'){
	return preg_replace('/\<br(\s*)?\/?\>/i', $ql, $string);
}

function get_youtube_code($urlx) {
	$url = $urlx.'&';
	$pattern = '/v=(.+?)&+/';
	preg_match($pattern, $url, $matches);
	if($matches[1]) return ($matches[1]);
	else return $urlx;
}

function get_info_vimeo($url_video) {
	preg_match('/vimeo.com\/(\d+)$/', $url_video, $matches);
	if (count($matches) != 0) {
		$vimeo_id = $matches[1];
		$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$vimeo_id.php"));
		return array('id_video'=>$vimeo_id, 'thumb'=>$hash[0]['thumbnail_medium']);
	} else return false;
}

function video_image($url){
	$image_url = parse_url($url);
	if($image_url['host'] == 'www.youtube.com' || $image_url['host'] == 'youtube.com'){
		$array = explode("&", $image_url['query']);
		return array('servidor'=>'youtube','codigo'=>substr($array[0], 2), 'imagem'=>"https://img.youtube.com/vi/".substr($array[0], 2)."/0.jpg");
	} else if($image_url['host'] == 'www.vimeo.com' || $image_url['host'] == 'vimeo.com'){
		$hash = unserialize(file_get_contents("https://vimeo.com/api/v2/video/".substr($image_url['path'], 1).".php"));
		return array('servidor'=>'vimeo','codigo'=>substr($image_url['path'], 1),'imagem'=>$hash[0]["thumbnail_large"]);
	}
}

function array_keys_exists($array,$keys) {
    foreach($keys as $k) {
        if(!isset($array[$k])) {
        return false;
        }
    }
    return true;
}



function valid_url($url) {
	if (preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url)) return $url;
	else return 'http://'.$url;
}


function SendMailAdm($assunto, $mensagem, $reply=NULL, $debug=false, $emailAlternativo=NULL, $arquivo_anexo=NULL, $emailAdicional=NULL) {

	require_once PHP."phpmailer/class.phpmailer.php";
	require_once PHP."phpmailer/class.smtp.php";

	$mail = new PHPMailer();

	$mail->IsSMTP();
	$mail->SMTPAuth 	= true;

	if( $debug ) $mail->SMTPDebug = 2;
	
	$mail->Port 		= PORT_EMAIL;
	$mail->Host 		= HOST_EMAIL;
	$mail->Username 	= USER_EMAIL;
	$mail->Password 	= PASS_EMAIL;
	$mail->SetFrom(USER_EMAIL,EMPRESA);
	

	if( !is_null($reply) ){
		$mail->addReplyTo($reply);
	}

	if( is_null($emailAlternativo) )
	{
		$emails = explode(',', EMAIL_CONTATO);

		foreach ($emails as $key => $email)
		{
			$mail->AddAddress($email);
		}
	}else{
		$mail->AddAddress($emailAlternativo);
	}

	// EMAIL ADICIONAL
	if( !is_null($emailAdicional) ){
		$mail->AddAddress($emailAdicional);
	}

	// COPIA TEMP
	//$mail->AddBCC("quax@quax.com.br");

	$mail->IsHTML(true);
	$mail->CharSet = 'utf-8';

	$mail->Subject = $assunto;

	$body = '<div style="width: 100%; background: #eeeeee; padding: 40px 0; text-align:center;">
				<br><br>
				<img src="'.IMG.'logo.png"><br><br>
				<div style="color:#333; width:650px; text-align:left; background:#FFF; padding:30px; margin: 0 auto; font-size:14px; font-family:\'arial\'; border-top:4px solid #C9BCA2;">
					'.$mensagem.'
					<br>
					<hr>
					<br>
					<strong>Equipe - Administrativa</strong>
				</div>
			</div>';

	$mail->Body = $body;


	// Anexo
	if( $arquivo_anexo ) $mail->AddAttachment($arquivo_anexo);


	$enviado = $mail->Send();

	$mail->ClearAllRecipients();
	$mail->ClearAttachments();

	return $enviado;
}

function SendMailCliente($email, $assunto, $mensagem, $debug=false, $reply=NULL) {

	require_once PHP."phpmailer/class.phpmailer.php";
	require_once PHP."phpmailer/class.smtp.php";

	$mail = new PHPMailer();
	
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	
	$mail->Port 	= PORT_EMAIL;
	$mail->Host 	= HOST_EMAIL;
	$mail->Username = USER_EMAIL;
	$mail->Password = PASS_EMAIL;
	$mail->SetFrom(USER_EMAIL, EMPRESA);
	$mail->AddReplyTo(REPLY_EMAIL, EMPRESA);

	$mail->AddAddress($email);

	$mail->IsHTML(true);
	$mail->CharSet = 'utf-8';

	$mail->Subject = $assunto;

	$body = '<div style="width: 100%; background: #eeeeee; padding: 40px 0; text-align:center;">
				<div align="center" style="color: #999; font-size: 11px;">Este é um e-mail automático, você não precisa respondê-lo.</div>
				<br><br>
				<img src="'.IMG.'logo.png"><br><br>
				<div style="color:#333; width:650px; text-align:left; background:#FFF; padding:30px; margin: 0 auto; font-size:14px; font-family:\'arial\'; border-top:4px solid #cf9b2d;">
					'.$mensagem.'
					<br><br>
					<hr>
					<br>
					<strong>Equipe - Administrativa</strong>
				</div>
			</div>';

	$mail->Body = $body;

	$enviado = $mail->Send();

	$mail->ClearAllRecipients();
	$mail->ClearAttachments();

	return $enviado;
}


function countdown($pstr_day) {
	return round((strtotime( $pstr_day )-strtotime(date( "Y-m-d" )))/86400);
}

function abrevia($texto, $tam){
	if( strlen($texto) > $tam)
	{
		$texto = substr($texto, 0, $tam) . "...";
	}
	return $texto;
}

function dia_da_semana($data){

	$dd = date("w", strtotime($data) );

	switch($dd) {
		case"0": $dia_semana = "Domingo"; break;
		case"1": $dia_semana = "Segunda"; break;
		case"2": $dia_semana = "Terça"; break;
		case"3": $dia_semana = "Quarta"; break;
		case"4": $dia_semana = "Quinta"; break;
		case"5": $dia_semana = "Sexta"; break;
		case"6": $dia_semana = "Sábado"; break;
	}

	return $dia_semana;
}

// FORMATA NUM
function only_number($string) { return preg_replace("/[^0-9]/","", $string); }

function floatBrToMysql($valor) { return str_replace(",",".", str_replace(".","",$valor) ); }

// FOMATA DATA
function formatDate($date,$format='reverse',$extra=false) {
	if($date != '0000-00-00') return ($format=='reverse'?implode('-',array_reverse(explode('/',$date))):implode('/',array_reverse(explode('-',$date))));
	elseif($extra) return $extra;
}

function data($date, $format='d/m/Y'){
	return date($format, strtotime($date));
}

// FORMATA CPF/CNPJ
function formata_cpf_cnpj($campo, $formatado = true){
	$codigoLimpo = preg_replace("[' '-./ t]",'',$campo);
	$tamanho = (strlen($codigoLimpo) -2);
	if ($tamanho != 9 && $tamanho != 12){
		return false;
	}

	if ($formatado){
		$mascara = ($tamanho == 9) ? '###.###.###-##' : '##.###.###/####-##';

		$indice = -1;
		for ($i=0; $i < strlen($mascara); $i++) {
			if ($mascara[$i]=='#') $mascara[$i] = $codigoLimpo[++$indice];
		}
		$retorno = $mascara;

	} else {
		$retorno = $codigoLimpo;
	}
	return $retorno;
}

// TODOS MESES
function get_mes($selected=NULL, $retorno='value') {
	$array = array(
		'01' => 'Janeiro',
		'02' => 'Fevereiro',
		'03' => 'Março',
		'04' => 'Abril',
		'05' => 'Maio',
		'06' => 'Junho',
		'07' => 'Julho',
		'08' => 'Agosto',
		'09' => 'Setembro',
		'10' => 'Outubro',
		'11' => 'Novembro',
		'12' => 'Dezembro'
	);

	if ($retorno == 'value') {
		foreach($array as $vlr_mes => $nome_mes) $_html[] = ($vlr_mes==$selected?$nome_mes:false);
	} else {
		foreach($array as $vlr_mes => $nome_mes) $_html[] = '<option value="'.$vlr_mes.'" '.($vlr_mes==$selected&&$selected!=NULL?'selected="selected"':false).'>'.$nome_mes.'</option>';
	}
	return implode("\n",$_html);
}

// SELECT NOMES ESTADOS
function get_estado($selected=NULL, $echo=true) {
	$array_state = array(
		'ac' => 'Acre',
		'al' => 'Alagoas',
		'am' => 'Amazonas',
		'ap' => 'Amapá',
		'ba' => 'Bahia',
		'ce' => 'Ceará',
		'df' => 'Distrito Federal',
		'es' => 'Espírito Santo',
		'go' => 'Goiás',
		'ma' => 'Maranhão',
		'mt' => 'Mato Grosso',
		'ms' => 'Mato Grosso do Sul',
		'mg' => 'Minas Gerais',
		'pa' => 'Pará',
		'pb' => 'Paraíba',
		'pr' => 'Paraná',
		'pe' => 'Pernambuco',
		'pi' => 'Piauí',
		'rj' => 'Rio de Janeiro',
		'rn' => 'Rio Grande do Norte',
		'rs' => 'Rio Grande do Sul',
		'ro' => 'Rondônia',
		'rr' => 'Roraima',
		'sc' => 'Santa Catarina',
		'se' => 'Sergipe',
		'sp' => 'São Paulo',
		'to' => 'Tocantins'
	);

	foreach($array_state as $sigla => $estado) $_html[] = '<option value="'.$sigla.'" '.($sigla==$selected?'selected':false).'>'.$estado.'</option>';
	if($echo) echo implode("\n",$_html);
	else return implode("\n",$_html);
}

// NOMES ESTADOS
function get_estado_nome($st) {
	$array_state = array(
		'ac' => 'Acre',
		'al' => 'Alagoas',
		'am' => 'Amazonas',
		'ap' => 'Amapá',
		'ba' => 'Bahia',
		'ce' => 'Ceará',
		'df' => 'Distrito Federal',
		'es' => 'Espírito Santo',
		'go' => 'Goiás',
		'ma' => 'Maranhão',
		'mt' => 'Mato Grosso',
		'ms' => 'Mato Grosso do Sul',
		'mg' => 'Minas Gerais',
		'pa' => 'Pará',
		'pb' => 'Paraíba',
		'pr' => 'Paraná',
		'pe' => 'Pernambuco',
		'pi' => 'Piauí',
		'rj' => 'Rio de Janeiro',
		'rn' => 'Rio Grande do Norte',
		'rs' => 'Rio Grande do Sul',
		'ro' => 'Rondônia',
		'rr' => 'Roraima',
		'sc' => 'Santa Catarina',
		'se' => 'Sergipe',
		'sp' => 'São Paulo',
		'to' => 'Tocantins'
	);

	return $array_state[$st];
}



// GET CIDADE
function get_cidades($estado=NULL, $cidade=NULL, $echo = true) {
	global $db,$tables;

	if($estado){
		$estado = strtoupper($estado);
		$query = $db->get_results("SELECT id, nome FROM ".$tables['CIDADES']." WHERE uf='{$estado}'");
		foreach($query as $result) $_html[] = '<option value="'.$result->id.'" '.($result->id==$cidade?'selected="selected"':"").'>'.$result->nome.'</option>';
		if($echo)echo implode("\n",$_html);
		else return implode("\n",$_html);
	}
}

// GET NOME CIDADE
function get_cidade_nome($id) {
	global $db, $tables;
	$query = $db->get_row("SELECT nome FROM ".$tables['CIDADES']." WHERE id='{$id}'");
	if($query) return $query->nome;
}

// GET ID CIDADE
function get_id_cidade($estado=NULL, $cidade=NULL) {
	global $db,$tables;

	if($estado)
	{
		$estado = strtoupper($estado);
		$query = $db->get_row("SELECT id FROM ".$tables['CIDADES']." WHERE uf='{$estado}' AND nome='{$cidade}'");
		return $query->id;
	}
}

// GET PERMALINK CIDADE
function get_permalink_cidade($id) {
	global $db, $tables;
	$query = $db->get_row("SELECT permalink FROM ".$tables['CIDADES']." WHERE id='{$id}'");
	if($query) return $query->permalink;
}

// GET NOME CIDADE BY PERMALINK
function get_nome_cidade_permalink($permalink) {
	global $db, $tables;
	$query = $db->get_row("SELECT nome FROM ".$tables['CIDADES']." WHERE permalink='{$permalink}'");
	if($query) return $query->nome;
}

// GET ID CIDADE BY PERMALINK
function get_id_cidade_permalink($permalink) {
	global $db, $tables;
	$query = $db->get_row("SELECT id FROM ".$tables['CIDADES']." WHERE permalink='{$permalink}'");
	if($query) return $query->id;
}




// DESTINO LINK
function get_link_destino($valor=NULL, $retorno='value') {
	$array = ['_self' => 'Mesma janela', '_blank' => 'Nova janela'];

	if ($retorno == 'value') {
		foreach($array as $vlr => $nome) $_html[] = ($vlr==$valor?$nome:false);
	} else {
		foreach($array as $vlr => $nome) $_html[] = '<option value="'.$vlr.'" '.($vlr==$valor&&$valor!=NULL?'selected="selected"':"").'>'.$nome.'</option>';
	}
	return implode("\n",$_html);
}


// SIM OU NAO
function get_sn($valor=NULL, $retorno='value') {
	$array = ['0'=>'Não', '1'=>'Sim'];

	if ($retorno == 'value') {
		foreach($array as $vlr => $nome) $_html[] = ($vlr==$valor?$nome:false);
	} else {
		foreach($array as $vlr => $nome) $_html[] = '<option value="'.$vlr.'" '.($vlr==$valor&&$valor!=NULL?'selected="selected"':"").'>'.$nome.'</option>';
	}
	return implode("\n",$_html);
}

// STATUS
function get_status($valor=NULL, $retorno='value') {
	$array = array('1'=>' ', '0'=>' ');

	$class = "";

	if ($retorno == 'value')
	{
		if( $valor == "1" ){
			$class = "is-active green-dot";
		} else {
			$class = "disabled-dot";
		}

		foreach($array as $vlr => $nome) $_html[] = ($vlr==$valor? '<span class="'.$class.'">'.$nome.'</span>':'');
	} else {
		foreach($array as $vlr => $nome) $_html[] = '<option value="'.$vlr.'" '.($vlr==$valor&&$valor!=NULL?'selected="selected"':"").'>'.$nome.'</option>';
	}
	return implode("\n",$_html);
}


function altera_ext_webp($file) {
	if ($file) {
		return str_replace(['jpg', 'png', 'gif'], 'webp', $file);
	}else{
		return "invalid file";
	}
}


function altera_ext_jpg($file) {
	if ($file) {
		return str_replace(['webp', 'png', 'gif'], 'jpg', $file);
	}else{
		return "invalid file";
	}
}



// PAGINAS PERMALINK
function get_paginas_permalink($selected=NULL, $retorno='value') {
	global $db, $tables;
	$array = $db->get_results("SELECT titulo, permalink FROM ".$tables['PAGINAS']." ORDER BY titulo");

	if ($retorno == 'value') {
		foreach($array as $rs) $_html[] = ($selected == $rs->permalink ? $rs->titulo : "");
	} else {
		foreach($array as $rs) $_html[] = '<option value="'.$rs->permalink.'" '.($rs->permalink==$selected&&$selected!=NULL?'selected="selected"':"").'>'.$rs->titulo.'</option>';
	}
	return implode("\n",$_html);
}

// STATUS DAS NOTÍCIAS
function get_not_status($valor=NULL) {
	$array = array('2' => 'Rascunho', '1' => 'Publicado', '0' => 'Desativado');
	foreach($array as $vlr => $nome) $_html[] = '<option value="'.$vlr.'" '.($vlr==$valor&&$valor!=NULL?'selected="selected"':"").'>'.$nome.'</option>';
	return implode("\n",$_html);
}

function get_not_status_value($valor) {
	$array = array('2' => 'Rascunho', '1' => 'Publicado', '0' => 'Desativado');
	foreach($array as $vlr => $nome) $_html[] = ($vlr==$valor?$nome:"");
	return implode("\n",$_html);
}

// GET NOME AUTOR
function get_nome_autor($id=NULL) {
	global $db, $tables;
	$query = $db->get_row("SELECT nome_completo FROM ".$tables['USUARIOS']." WHERE id = '{$id}'");
	return $query->nome_completo;
}

// GET FOTO AUTOR
function get_foto_autor($id=NULL) {
	global $db, $tables;
	$query = $db->get_row("SELECT foto FROM ".$tables['USUARIOS']." WHERE id = '{$id}'");
	return $query->foto;
}

// GET EMAIL AUTOR
function get_email_autor($id=NULL) {
	global $db, $tables;
	$query = $db->get_row("SELECT email FROM ".$tables['USUARIOS']." WHERE id = '{$id}'");
	return $query->email;
}






function geraSenha($tamanho=8, $maiusculas=true, $numeros=true, $simbolos=false)
{
	$lmin = 'abcdefghjkmnopqrstuvwxyz';
	$lmai = 'ABCDEFGHJKMNOPQRSTUVWXYZ';
	$num  = '1234567890';
	$simb = '!@#$%*-';
	$retorno = '';
	$caracteres = '';
	$caracteres .= $lmin;
	if ($maiusculas) $caracteres .= $lmai;
	if ($numeros) $caracteres .= $num;
	if ($simbolos) $caracteres .= $simb;
	$len = strlen($caracteres);
	for ($n = 1; $n <= $tamanho; $n++) {
	$rand = mt_rand(1, $len);
	$retorno .= $caracteres[$rand-1];
	}
	return $retorno;
}

function antiSQL($campo) {
	// remove palavras que contenham sintaxe sql
	$campo = preg_replace("/(table_name|alter table|column_name|select|like|database|union|chr\(|exp\(|elt\(|difference|convert|cvar|session_user|concat|benchmark|null|schema|insert|delete|update|where|were|drop table|show tables|utf8|ASCII|xtype|script|document|%|<>|\"|\'|&|\*|--|\\\\)/i","",$campo);

	$campo = trim($campo); //limpa espaços vazio
	$campo = strip_tags($campo); //tira tags html e php
	$campo = addslashes($campo);
	return $campo;
}


function moeda($valor){
	return number_format($valor,2,",",".");
}



// HEADER
function get_header() {
	global $_SEO, $db, $tables, $MOBILE, $TABLET, $lang, $_lang, $qConfig, $ativarTag, $imgDestaque, $title_share, $desc_share, $_param; 
	return include_once ROOT.'/template/includes/header.php';
}

// FOOTER
function get_footer() {
	global $titulo, $permalink, $db, $tables, $_SEO, $returnURL, $_lang, $lang, $MOBILE, $TABLET, $qConfig, $_param;
	return include_once ROOT.'/template/includes/footer.php';
}

function clear_phone($fone){
	$fone = str_replace([' ', '(', ')', '-', '.'], '', $fone);
	return $fone;
}

function processURL($url)
{
	$ch = curl_init();
	curl_setopt_array($ch, array(
	CURLOPT_URL => $url,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_SSL_VERIFYPEER => false,
	CURLOPT_SSL_VERIFYHOST => 2
	));

	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}


function createImageJPG($sTempFileName, $iWidth, $iHeight, $sFileName, $iX, $iY, $iW, $iH, $folder=NULL, $quality=80)
{
	include_once PHP.'classes/Class.imagem.php';

	$sFileNameExt = $sFileName.'.jpg';

	$aSize = getimagesize($sTempFileName);
	if (!$aSize) {
	  @unlink($sTempFileName);
	  return;
	}

	if( $folder==NULL) $folder = ROOT_UPLOADS_IMG;

	switch($aSize['mime']) {
	  case 'image/jpeg': $vImg = @imagecreatefromjpeg($sTempFileName); break;
	  case 'image/png':  $vImg = @imagecreatefrompng($sTempFileName); break;
	  default: @unlink($sTempFileName); return;
	}

	$vDstImg = @imagecreatetruecolor( $iWidth, $iHeight );
	imagecopyresampled($vDstImg, $vImg, 0, 0, (int)$iX, (int)$iY, $iWidth, $iHeight, (int)$iW, (int)$iH);
	imagejpeg($vDstImg, $sTempFileName, $quality);

	$image = new Image(TEMP.$sFileNameExt);
	$image->setPathToTempFiles(TEMP);
	$image->save($folder.$sFileName);

	imagedestroy($vDstImg);
	imagedestroy($vImg);
	@unlink(TEMP.$sFileNameExt);
}


function convertJPGtoPNG($fileWithoutExt)
{
	$image = imagecreatefrompng($fileWithoutExt.'.png');
	imagejpeg($image, $fileWithoutExt.'.jpg', 80);
	// LIBERA A IMAGEM DA MEMÓRIA
	imagedestroy($image);
	// DELETA O ARQUIVO PNG
	@unlink($fileWithoutExt.'.png');
}


function find_char($valor_procurado, $string){
	if( $valor_procurado && $string )
	{
		$string_array = str_split($string); 
		foreach ($string_array as $k => $value) {
			if( $value == $valor_procurado ) return true;
		}
	}
	return false;
}


function find_string($needle, $haystack)
{
    return strpos($haystack, $needle) !== false;
}


function first_name($name){
	if( $name )
	{
		$first = explode(' ', $name); 
		return $first[0];
	}
}








function get_svg_arrow_next() {
	$rtn = '<svg width="50px" height="50px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#9ea1a1" stroke-width="1" stroke-linecap="round" stroke-linejoin="miter">
<g id="SVGRepo_bgCarrier" stroke-width="0"/>
<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
<g id="SVGRepo_iconCarrier">
<circle cx="12" cy="12" r="10"/>
<polyline points="10 16 15 12 10 8"/>
</g>
</svg>';
	echo $rtn;
}

function get_svg_arrow_prev() {
	$rtn = '<svg width="50px" height="50px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#9ea1a1" stroke-width="1" stroke-linecap="round" stroke-linejoin="miter">
<g id="SVGRepo_bgCarrier" stroke-width="0"/>
<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
<g id="SVGRepo_iconCarrier">
<circle cx="12" cy="12" r="10"/>
<polyline points="14 8 9 12 14 16"/>
</g>
</svg>';
	echo $rtn;
}




function htmlLog(){
	$_html = '<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
        body{
            background: #222;
            font-family: "Courier";
            color: #CCC;
            padding: 30px;
            font-size: 18px;
        }
    </style>
</head>
<body>
    '.strtoupper(EMPRESA).' - SISTEMA - LOG<br>
    ---------------------------
    <br><br>';

    echo $_html;
}



function getImg($imageName, $alt='', $class='', $imgPath=null, $imgPathRoot=null, $imageNameMobile=null, $width=null, $height=null, $loading="lazy", $priority="auto") {

    if (empty($imgPath)) $imgPath = IMG;

    $root = ROOT_IMG;

    if (!empty($imgPathRoot)) $root = $imgPathRoot;

    $desktopImage = $imgPath . $imageName;

    if (!file_exists($root . $imageName)) {
        return "<span data-file='{$imageName}'>Image not found</span>";
    }

    if (!empty($imageNameMobile)) {
        if (!file_exists($root . $imageNameMobile)) {
            return "<span data-file='{$imageNameMobile}'>Image mobile not found</span>";
        }

        $mobileImage = $imgPath . $imageNameMobile;
    }

    // Se largura e altura não forem definidos, tenta obter via getimagesize
    if (!$width || !$height) {
        $imageInfo = @getimagesize($desktopImage);
        if ($imageInfo) {
            list($width, $height) = $imageInfo;
        } else {
            $width = $height = null; // Evita erro caso a imagem não seja encontrada
        }
    }

    return "
    <picture>" .
        (!empty($mobileImage) ? "
        <source srcset=\"$mobileImage\" media=\"(max-width: 576px)\">
        <source srcset=\"$desktopImage\" media=\"(min-width: 577px)\">" : "") . "
        <img 
            src=\"$desktopImage\" 
            alt=\"$alt\" 
            class=\"$class\" 
            loading=\"$loading\" 
            fetchpriority=\"$priority\" " .
        ($width && $height ? "width=\"$width\" height=\"$height\"" : "") . ">
    </picture>";
}


function renderBtn($options = []) {
    $href   = isset($options['href']) 	? $options['href'] : '#';
    $text   = isset($options['text']) 	? $options['text'] : 'Clique aqui';
    $class  = isset($options['class']) 	? $options['class'] : '';
    $id     = isset($options['id']) ? ' id="' . htmlspecialchars($options['id']) . '"' : '';
    $target = isset($options['target']) ? ' target="' . htmlspecialchars($options['target']) . '"' : '';
    $elm    = isset($options['elm']) 	? $options['elm'] : 'a';

    // Atributos extras (ex: data-*, aria-*)
    $extraAttributes = '';
    if (isset($options['attrs']) && is_array($options['attrs'])) {
        foreach ($options['attrs'] as $key => $val) {
            $extraAttributes .= ' ' . htmlspecialchars($key) . '="' . htmlspecialchars($val) . '"';
        }
    }

    // data-text com mesmo conteúdo do texto
    $dataText = ' data-text="' . htmlspecialchars($text) . '"';

    echo '<'.$elm.' href="' . htmlspecialchars($href) . '" class="btn waypoint ' . htmlspecialchars($class) . '"' . $id . $target . $dataText . $extraAttributes . '><span>' . htmlspecialchars($text) . '</span></'.$elm.'>';
}


/*
|--------------------------------------------------------------------------
| SPECIFIC FUNCTIONS FOR 'CLIENTE'
|--------------------------------------------------------------------------
|
*/
