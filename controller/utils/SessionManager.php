<?php
/*
 * File: controller/utils/SessionManager.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *
 */

include_once './settings.php';

/**
 * Organisiert Sessions - Login/Logout Prozess
 * 
 * @author Heiko Dreyer
 *
 */
class SessionManager
{
	/**
	 * Privater Constructor - Nur statische Methoden
	 * 
	 * <p>
	 * Könnte auch als Singleton implementiert werden. 
	 * Für Datenbank Verbindungen sollte dann ein DatabaseConnector mit injected werden.
	 * </p>
	 */
	private function __construct()
	{
	}
	
	/**
	 * Login wird überprüft und ggf. in einer Session gespeichert
	 * 
	 * @param $username
	 * @param $password
	 */
	public static function login($username, $password)
	{
		if(session_id() == '')
			session_start();
		
		if($username == LOGIN_USERNAME && $password == LOGIN_PASSWORD)
		{
			$_SESSION['loggedIn'] = true;
			$actions = '';						
		}	
		else
			$actions = '?action=login_failed';
		
		header('Location: backend.php'.$actions);
	}
	
	/**
	 * Logout aus dem backend - Session zerstören
	 */
	public static function logout()
	{
		if(session_id() == '')
			session_start();
			
     	session_destroy();
     		
		header('Location: backend.php');
	}
	
	/**
	 * Überprüft ob der User angemeldet ist
	 * 
	 * @return Boolean
	 */
	public static function checkAuth()
	{
		if(session_id() == '')
			session_start();
		
		if(!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn'])
			return false;
		
		return true;
	}
}

/*
 * File: controller/utils/SessionManager.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *
 */
?>