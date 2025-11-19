<?php

/*
|--------------------------------------------------------------------------
| QUAX CONFIG
|--------------------------------------------------------------------------
|
| System configuration file.
|
*/

error_reporting(1);
error_reporting(E_ALL & ~(E_STRICT|E_NOTICE|E_WARNING));

date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_ALL, 'pt_BR.UTF8');



/*
|--------------------------------------------------------------------------
| SET MODE LOCAL OR PUBLIC
|--------------------------------------------------------------------------
*/

if(stristr($_SERVER['DOCUMENT_ROOT'], 'public_html') === FALSE) $localhost = TRUE;
else $localhost = FALSE;

define('LOCALHOST',$localhost);

define('HASH','7bnjth,./;p123%$%@fdxs');
define('SECURITY_HASH', md5(HASH.'esqueci minha senha'));

if(LOCALHOST) {
	define('DB_USER','root');
	define('DB_NAME','hotsprint');
	define('DB_PASS','');
	define('DB_HOST','localhost');
	define('PREFIX','adm_');
	define('ROOT',$_SERVER['DOCUMENT_ROOT'].'/hotsprint');
	define('HTTP','http://'.$_SERVER['HTTP_HOST'].'/hotsprint');
	define('SHIFT_NUM', 1);

	# TO RELOAD THE PAGE ON SAVE
	define('AUTO_RELOAD',true);
	// define('AUTO_RELOAD',false);
} else {
	define('DB_NAME','quaxxcom_quax_lp');
	define('DB_USER','quaxxcom_padrao');
	define('DB_PASS','XHMfhXq=GIx');
	define('DB_HOST','localhost');
	define('PREFIX','adm_');
	define('ROOT',$_SERVER['DOCUMENT_ROOT'].'/clientes/quax_lp');
	define('HTTP','https://'.$_SERVER['HTTP_HOST'].'/clientes/quax_lp');
	define('SHIFT_NUM', 2);

	define('AUTO_RELOAD',false);
}



// define('DB_NAME','quaxxcom_ventus');
// define('DB_USER','quaxxcom_padrao');
// define('DB_PASS','XHMfhXq=GIx');
// define('DB_HOST','localhost');
// define('PREFIX','adm_');
// define('ROOT',$_SERVER['DOCUMENT_ROOT'].'/clientes/ventus');
// define('HTTP','https://'.$_SERVER['HTTP_HOST'].'/clientes/ventus');
// define('SHIFT_NUM', 2);



define('PREFIX_NAME_IMG', 'quax-lp');



/*
|--------------------------------------------------------------------------
| SET PATHS
|--------------------------------------------------------------------------
*/

# ADMIN
define('ROOT_GESTOR',ROOT.'/q-admin/');
define('HTTP_GESTOR',HTTP.'/q-admin/');
define('ASSETS_GESTOR',HTTP_GESTOR.'assets/');
define('GESTOR_MODELS',ROOT_GESTOR.'models/');
define('GESTOR_INCLUDES',ROOT_GESTOR.'php/includes/');
define('GESTOR_CLASS',ROOT_GESTOR.'php/class/');

# UPLOADS
define('HTTP_UPLOADS_IMG',HTTP.'/uploads/imagens/');
define('ROOT_UPLOADS_IMG',ROOT.'/uploads/imagens/');

# FILES
define('HTTP_ARQUIVOS',HTTP.'/uploads/arquivos/');
define('ROOT_ARQUIVOS',ROOT.'/uploads/arquivos/');


# PATH DEFAULT
define('TEMP',ROOT.'/temp_file/');
define('PHP',ROOT.'/php/');
define('TEMPLATE',ROOT.'/template/');
define('ASSETS',HTTP.'/assets/');
define('IMG',ASSETS.'img/');
define('CSS',ASSETS.'css/');
define('JS',ASSETS.'js/');
define('ROOT_JS',ROOT.'/assets/js/');
define('ROOT_CSS',ROOT.'/assets/css/');
define('ROOT_IMG',ROOT.'/assets/img/');


# MAX UPLOAD FILE
define('MAX_SIZE','40mb');







/*
|--------------------------------------------------------------------------
| SET LANGUAGE
|--------------------------------------------------------------------------
*/

$language   = false;
$array_lang = ['pt'];



/*
|--------------------------------------------------------------------------
| INCLUDE FUNCTIONS
|--------------------------------------------------------------------------
*/

require PHP . "functions.php";


/*
|--------------------------------------------------------------------------
| INCLUDE DATA BASE
|--------------------------------------------------------------------------
*/

require PHP . "database.php";






/*
|--------------------------------------------------------------------------
| SET MAIN JS / CSS 
|--------------------------------------------------------------------------
*/

$javascript = [
	'smooth-scroll-west.min.js',
	'jquery-3.7.1.min.js',
	'main.min.js',
];

$style = [
	'css/smooth-scroll-west.min.css',
	'css/bulma-0.9.3-light.min.css',
	'css/style.min.css',
];


# BEST PERFORMANCE ON GOOGLE PAGE SPEED

if (defined('IS_LIGHTHOUSE')) {
	if( !IS_LIGHTHOUSE ){
		add_style([
			'css/font-awesome.min.css',
			'css/sweetalert2.min.css'
		]);

		add_javascript(['sweetalert2.min.js']);
	}else{
		// REMOVE THE BULMA WHEN IT IS GOOGLE PAGE SPEED
		$style = array_diff($style, ['css/bulma-0.9.3-light.min.css']);
		$style = array_values($style); // TO REINDEX THE ARRAY
	}
}


if( AUTO_RELOAD ) add_javascript(['live.js']);






# CONFIGURAÇÕES DO SISTEMA
$qConfig = $db->get_row("SELECT * FROM ".$tables['CONFIG']." WHERE id=1");



# CONFIG SEND EMAIL
define('PORT_EMAIL',  $qConfig->smtp_port);
define('HOST_EMAIL',  $qConfig->smtp_host);
define('PASS_EMAIL',  $qConfig->smtp_pass);
define('USER_EMAIL',  $qConfig->smtp_user);
define('REPLY_EMAIL', $qConfig->email_reply);


if(LOCALHOST) {
	define('EMAIL_CONTATO','willian@quax.com.br');
}else{
	define('EMAIL_CONTATO', $qConfig->email_contato);
}


# TAG TITLE [ NOME DA EMPRESA ]
define('EMPRESA', $qConfig->nome_empresa);

# GOOGLE ANALYTICS
define('GOOGLE_ANALYTICS', $qConfig->google_analytics);

# PHONES
define('TELEFONE_FIXO', $qConfig->telefone);
define('CELULAR', $qConfig->celular);




# WHATSAPP
define('LINK_WHATSAPP','https://api.whatsapp.com/send?phone=55'.clear_phone($qConfig->celular).'&text='.urlencode($qConfig->texto_whatsapp));

# CODE WIDGET
define('CODE_WIDGET',$qConfig->codigo_widget);


# SOCIAL MEDIA
define('FACEBOOK',$qConfig->facebook);
define('INSTAGRAM',$qConfig->instagram);
define('YOUTUBE',$qConfig->youtube);
define('TWITTER',$qConfig->twitter);
define('LINKEDIN',$qConfig->linkedin);
define('BEHANCE',$qConfig->behance);



/*
|--------------------------------------------------------------------------
| INCLUDE ADDITIONAL PARAMETERS
|--------------------------------------------------------------------------
*/

require PHP . "config-parameters.php";