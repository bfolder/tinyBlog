<?php
/*
 * File: settings.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *	 Abstract   : Blog Einstellungen
 */

/**
 * Error reporting
 * 
 * Error reporting deaktivieren sobald im produktiven Einsatz
 */
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors','on');

/**
 * Locale auf Deutsch mit korrekter Zeitzone setzen
 */
setlocale(LC_ALL,'de_DE');
date_default_timezone_set('Europe/Berlin');

/**
 * Datenbank
 */
define('DATABASE_SERVER','localhost');
define('DATABASE_USERNAME','root');
define('DATABASE_PASSWORD','');
define('DATABASE_NAME','tinyBlog');
define('DATABASE_CONNECTOR_CLASS', 'MySQLConnector');

/*
 * Backend Logindaten
 */
define('LOGIN_USERNAME', 'admin');
define('LOGIN_PASSWORD', 'password');

/**
 * Blog Title & Settings
 */
define('BLOG_TITLE', 'tinyBlog');
define('LATEST_ENTRIES_COUNT', 10);

/*
 * Controllers
 */
define('DEFAULT_FRONTEND_CONTROLLLER', 'PostsController');
define('DEFAULT_BACKEND_CONTROLLLER', 'PostsBackendController');

/*
 * File: settings.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *	Abstract    : Blog Einstellungen
 */
?>