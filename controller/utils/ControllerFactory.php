<?php
/*
 * File: controller/utils/ControllerFactory.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *
 */

require_once './model/service/IBlogTransactions.php';

require_once './controller/utils/SessionManager.php';
require_once './controller/backend/LoginController.php';
require_once './controller/abstract/AbstractController.php';

/**
 * Factory Klasse mit statischen Factory Methoden zur Erstellung
 * erforderlicher Controller Klassen.
 * 
 * @author Heiko Dreyer
 *
 */
class ControllerFactory
{		
	/**
	 * Privater Constructor - Nur statische Factory Methoden
	 */
	private function __constructor()
	{		
	}
	
	/**
	 * Prüft ob ein Objekt eine Subklasse von <i>AbstractController</i> ist.
	 * 
	 * @param $controller
	 * @return Object
	 */
	private static function checkIfSubclassFromAbstractController($controller)
	{
		// Prüfen ob es sich um eine Subklasse von AbstractController handelt
		if(!is_subclass_of($controller, 'AbstractController'))
			throw new Exception('Controller Klasse <i>'.get_class($controller).'</i> muss eine Subklasse von <i>AbstractController</i> sein');
		
		return $controller;
	}
	
	/**
	 * Gibt den Default Frontend Controller zurück
	 * 
	 * @var IBlogTransactions $connector
	 * @return AbstractBlogController 
	 */
	private static function getDefaultFrontendController($connector)
	{
		$class = DEFAULT_FRONTEND_CONTROLLLER;		
		$path = './controller/frontend/'.$class.'.php';
		
		// Pfad und Klasse auf "vorhandensein" überprüfen
		if(file_exists($path))
			require_once $path;
		
		if(!file_exists($path) || !class_exists($class))
			throw new Exception('Default-Controller Klasse <i>'.$class.'</i> existiert nicht im Pfad '.$path);
			
		// Controller instanziieren
		$controller = new $class($connector);

		return $controller;
	}
	
	/**
	 * Gibt den Default Backend Controller zurück
	 * 
	 * @var IBlogTransactions $connector
	 * @return AbstractBlogController 
	 */
	private static function getDefaultBackendController($connector)
	{
		$class = DEFAULT_BACKEND_CONTROLLLER;		
		$path = './controller/backend/'.$class.'.php';
		
		// Pfad und Klasse auf "vorhandensein" überprüfen
		if(file_exists($path))
			require_once $path;
		
		if(!file_exists($path) || !class_exists($class))
			throw new Exception('Default-Controller Klasse (Backend) <i>'.$class.'</i> existiert nicht im Pfad '.$path);
			
		// Controller instanziieren
		$controller = new $class($connector);
		
		return $controller;
	}
	
	/**
	 * Gibt eine Instanz des Controllers zurück welche den aktuellen View darstellt ist (Frontend)
	 * 
	 * @var IBlogTransactions $connector
	 * @return AbstractController
	 */
	public static function getControllerForRequest(IBlogTransactions $connector)
	{	
		/*
		 *  GET Vars:
		 *  "show" <- Controllername
		 *  "id" <- Single Entry mit Id 
		 *  "action" <- Action
		 */  
		
		if(isset($_GET['show']))
		{
			// Evaluiere Klassenname
			$array = explode('_', $_GET['show']);
			$class = '';
			
			foreach($array as $string)
				$class .= ucwords($string);
			
			$class .= 'Controller';		
			$path = './controller/frontend/'.$class.'.php';
		
			// Pfad und Klasse auf "vorhandensein" überprüfen
			if(file_exists($path))
				require_once $path;
		
			if(!file_exists($path) || !class_exists($class))
				throw new Exception('Controller <i>'.$class.'</i> existiert nicht');
			
			// Controller instanziieren
			$controller = new $class($connector);
		}
		else
			$controller = self::getDefaultFrontendController($connector);
		
		return self::checkIfSubclassFromAbstractController($controller);
	}
	
	/**
	 * Gibt eine Instanz des Controllers zurück welche den aktuellen View darstellt ist (Backend)
	 * 
	 * @var IBlogTransactions $connector
	 * @return AbstractController
	 */
	public static function getBackendControllerForRequest(IBlogTransactions $connector)
	{
		if(!SessionManager::checkAuth())
			return new LoginController($connector);
			
		if(isset($_GET['show']))
		{
			// Sonderfall, logout
			if($_GET['show'] == 'logout')
				SessionManager::logout();
			
			// Evaluiere Klassenname
			$array = explode('_', $_GET['show']);
			$class = '';
			
			foreach($array as $string)
				$class .= ucwords($string);
			
			$class .= 'BackendController';		
			$path = './controller/backend/'.$class.'.php';
		
			// Pfad und Klasse auf "vorhandensein" überprüfen
			if(file_exists($path))
				require_once $path;
		
			if(!file_exists($path) || !class_exists($class))
				throw new Exception('Controller <i>'.$class.'</i> existiert nicht');
			
			// Controller instanziieren
			$controller = new $class($connector);
		}
		else
			$controller = self::getDefaultBackendController($connector);
					
		return self::checkIfSubclassFromAbstractController($controller);
	}
}

/*
 * File: controller/utils/ControllerFactory.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *
 */
?>