<?php

/*
|--------------------------------------------------------------------------
| Set Tables Database
|--------------------------------------------------------------------------
|
| Here you can set the application tables
|
*/

$tables = [];

$tables['ACESSOS'] 		 	  	= PREFIX.'acessos';
$tables['PAGINAS'] 			  	= PREFIX.'paginas';
$tables['USUARIOS'] 		  	= PREFIX.'usuarios';
$tables['LEADS']				= PREFIX.'leads';
$tables['CONFIG']			  	= PREFIX.'config';




/*
|--------------------------------------------------------------------------
| Database Connection
|--------------------------------------------------------------------------
|
| Here the connection to the database is initialized
|
*/

require PHP."ezsql/ez_sql_core.php";
require PHP."ezsql/ez_sql_mysqli.php";

$db = new ezSQL_mysqli(DB_USER,DB_PASS,DB_NAME,DB_HOST);
$db->query("SET NAMES 'utf8'");
$db->query('SET character_set_connection=utf8');
$db->query('SET character_set_client=utf8');
$db->query('SET character_set_results=utf8');