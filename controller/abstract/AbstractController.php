<?php
/*
 * File: controller/abstract/AbstractController.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *
 */

require_once './model/service/IBlogTransactions.php';

/**
 * Abstract Controller zur Implementierung konkreter ActionController
 * 
 * @author Heiko Dreyer
 *
 */
abstract class AbstractController
{		
	/**
	 * Verbindung zur Datenbank
	 * 
	 * @var IBlogTranscations
	 */
	protected $connector;
	
	/**
	 * Id für Action
	 * 
	 * @var Blog
	 */
	protected $id = 0;
	
	/**
	 * Action
	 * 
	 * @var Blog
	 */
	protected $action = "";
	
	/**
	 * Pfad zum Template Ordner
	 */
	protected $templatePath = "./view/templates/";
	
	/**
	 * Generisches Data Object
	 */
	protected $data;
	
	/**
	 * Constructor
	 * 
	 * @param $connector
	 */
	public function __construct(IBlogTransactions $connector)
	{	
		// Action zuordnen		
		if(isset($_GET['action']))
			$this->action = $_GET['action'];
		
		// Id zuordnen
		if(isset($_GET['id']))
			$this->id = (int) $_GET['id'];
			
		// DB Connector
		$this->connector = $connector;
		
		// Template Methoden
		$this->processActions();
	}
	
	/** 
	 * Jeweilige Action ausführen
	 */
	protected abstract function processActions();
	
	/**
	 * Template rendern
	 */
	public abstract function render();
}

/*
 * File: controller/abstract/AbstractController.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *
 */
?>