<?php
/*
 * File: controller/backend/LoginController.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *
 */

require_once './controller/abstract/AbstractController.php';
require_once './model/service/IBlogTransactions.php';

/**
 * Controller für Login Prozess
 * 
 * @author Heiko Dreyer
 *
 */
class LoginController extends AbstractController
{	
	/**
	 * Flag welches angibt ob ein fehlgeschlagener Login betätigt wurde
	 * 
	 * @var Boolean
	 */	
	private $failedLogin = false;
	
	/**
	 * Seitentitel
	 * 
	 * @var String
	 */
	private $pageTitle = 'Login';
	
	
	/** 
	 * Jeweilige Action ausführen
	 */
	protected function processActions()
	{	
		switch ($this->action) 
		{
			// Loginversuch
			case 'login':	
				if(isset($_POST['username']) && isset($_POST['password']))
					SessionManager::login($_POST['username'], $_POST['password']);	
				else
					header('backend.php?show=login&action=login_failed');
			break;
			
			// Login fehlgeschlagen
			case 'login_failed':
				$this->pageTitle = 'Login fehlgeschlagen';
				$this->failedLogin = true;
			break;
			
			// Default Action
			default:			
				// Setzte Page title
				$this->pageTitle = 'Login';
			break;
		}		
	}
	
	/**
	 * Template rendern
	 */
	public function render()
	{	
		require_once $this->templatePath."backend/login.php";
	}
}

/*
 * File: controller/backend/LoginController.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *
 */
?>