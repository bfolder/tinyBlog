<?php
/*
 * File: controller/backend/CategoriesBackendController.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *
 */

require_once './controller/abstract/AbstractController.php';
require_once './model/service/IBlogTransactions.php';

/**
 * Controller zur Backend Verwaltung von Categories
 * 
 * @author Heiko Dreyer
 *
 */
class CategoriesBackendController extends AbstractController
{		
	/** 
	 * Jeweilige Action ausführen
	 */
	protected function processActions()
	{				    
		switch ($this->action) 
		{
		    case 'add':			
		    	// Wenn Name ausgefüllt, speicher die neue Kategorie
		    	if(isset($_POST['name']))
		    	{		    		
		    		$category = new Category();
		    		$category->name = $_POST['name'];
					$category = $this->connector->createCategory($category);
					
					// Id zurückgeben
					print $category->id;
		    	}
		    	else
		       		header('Location: backend.php?show=categories');
		    break;
		
			case 'delete':	
				$this->connector->deleteCategory($this->id);
		    break;
		    
		    case 'edit':		
	    		if(isset($_POST['name']))
		    	{		  
		    		$category = new Category();  
		    		$category->id = $this->id;		
		    		$category->name = $_POST['name'];
					$category = $this->connector->updateCategory($category);
		    	}
		    	else
		       		header('Location: backend.php?show=categories');
		    break;
		    
		    // Default action
		    default:  		
				// Hole alle Blogeinträge aus der Datenbank
				$this->data = new Blog();
				$this->data->categories = $this->connector->getCategories();
				$this->data->pageTitle = 'Kategorien';
		    break;
		}	
	}
	
	/**
	 * Template rendern
	 */
	public function render()
	{	
		if($this->action != 'add')
			require_once $this->templatePath."backend/categories.php";
	}
}

/*
 * File: controller/backend/CategoriesBackendController.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *
 */
?>