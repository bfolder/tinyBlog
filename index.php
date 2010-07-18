<?php
/*
 * File: index.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *	Abstract    : Blogindex
 */

require_once './settings.php';
require_once './controller/utils/ControllerFactory.php';
require_once './model/service/DatabaseConnector.php';

try 
{
	// Database Connector
	$path = './model/service/'.DATABASE_CONNECTOR_CLASS.'.php';	
	$class = DATABASE_CONNECTOR_CLASS;
	
	if(file_exists($path))
		require_once $path;
	
	if(!file_exists($path) || !class_exists($class))
		throw new Exception('DatabaseConnector-Class <i>'.$class.'</i> existiert nicht im Pfad '.$path);
	
	$connector = new $class();
		
	// Prüfe ob der Connector Subklasse von DatabaseConnector ist
	if(!is_subclass_of($connector, 'DatabaseConnector'))
		throw new Exception('Datenbank Connector Klasse <i>'.get_class($connector).'</i> muss eine Subklasse von <i>DatabaseConnector</i> sein');
		
	// Controller instantiieren und render()-Methode ausführen
	$controller = ControllerFactory::getControllerForRequest($connector);
	$controller->render();		
} 
catch (Exception $e) 
{
	echo '<h2>'.$e->getMessage().'</h2>';
}

/*
 * File: index.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *	Abstract    : Blogindex
 */
?>