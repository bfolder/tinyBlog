<?php
/*
 * File: controller/frontend/CategoryController.php
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
 * Controller zur Anzeige einer einzelnen Kategory
 * 
 * @author Heiko Dreyer
 *
 */
class CategoryController extends AbstractController
{	
	/** 
	 * Speichern/Holen von Daten
	 */
	protected function processActions()
	{		
		switch($this->action) 
		{
			// Default action
			default:
				// Blog aus dem connector laden
				$this->data = $this->connector->getBlogByCategoryId($this->id);
				
				// Titel der Kategorie festlegen
				foreach($this->data->categories as $category)
				{
					if($category->id == $this->id)
					{		
						$this->data->pageTitle = 'Kategorie: '.$category->name;
						return;
					}
				}
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
 * File: controller/frontend/CategoryController.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *
 */
?>