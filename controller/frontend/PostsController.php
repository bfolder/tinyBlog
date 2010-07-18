<?php
/*
 * File: controller/frontend/PostsController.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *
 */

require_once './controller/abstract/AbstractController.php';
require_once './model/service/IBlogTransactions.php';
require_once './model/Blog.php';
require_once './model/Post.php';

/**
 * Controller zur Ansicht von mehreren Posts
 * 
 * @author Heiko Dreyer
 *
 */
class PostsController extends AbstractController
{		
	/**
	 * Anzahl der zu ladenden Posts
	 * 
	 * @var int
	 */
	private $numPosts = -1;
	
	/**
	 * Constructor
	 * 
	 * @param $connector 
	 */
	public function __construct(IBlogTransactions $connector)
	{	
		// Wenn id auf dem Wert null bleibt, befinden wir uns in der "Latest" Ansicht
		if($this->id == 0)
			$this->numPosts = LATEST_ENTRIES_COUNT;
			
		parent::__construct($connector);
	}
	
	/** 
	 * Speichern/Holen von Daten
	 */
	protected function processActions()
	{	
		switch($this->action) 
		{
			// Default Action -> Blog anzeigen - NUR default Action für diesen Controller
			default:
				// Blog aus dem connector laden
				$this->data = $this->connector->getBlog($this->id, $this->numPosts);
		
				// Den Seitentitel festlegen
				if($this->id > 0)
					$this->data->pageTitle = 'Archiv';
				else
					$this->data->pageTitle = 'Aktuelles';		
			break;
		}
	}
	
	/**
	 * Template rendern
	 */
	public function render()
	{
		require_once $this->templatePath."index.php";
	}
}

/*
 * File: controller/frontend/PostsController.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *
 */
?>