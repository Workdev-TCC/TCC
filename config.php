<?php 
    // BANCO DE DADOS
    define("DB_NAME","zupinturas");
    define("DB_HOST","localhost");
    define("DB_USER","root");
    define("DB_PASS","");


    //CONSTANTES DO PROJETO E CAMINHOS IMPORTANTES
    if(!defined('ABSOLUTE_PATH')){
        define("ABSOLUTE_PATH",dirname(__FILE__).'/');
    }
   
    if(!defined('RAIZ_PROJETO')){
        define("RAIZ_PROJETO",'/tcc/');
    }
   
	if ( !defined('DBAPI') )
		define('DBAPI', ABSOLUTE_PATH . 'config/database.php');

   
	define('HEADER_TEMPLATE', ABSOLUTE_PATH . 'inc/header.php');
	define('FOOTER_TEMPLATE', ABSOLUTE_PATH . 'inc/footer.php');
	define('UTEIS', ABSOLUTE_PATH . 'inc/uteis.php');
	define('IMGUSERS', ABSOLUTE_PATH . 'usuarios/img');
   

?>