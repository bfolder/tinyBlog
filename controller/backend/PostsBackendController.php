<?php
/*
 * File: controller/backend/PostsBackendController.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *
 */

require_once './controller/abstract/AbstractController.php';
require_once './model/service/IBlogTransactions.php';

/**
 * Controller zur Ansicht von mehreren Posts
 * 
 * @author Heiko Dreyer
 *
 */
class PostsBackendController extends AbstractController
{		
	/** 
	 * Jeweilige Action ausführen
	 */
	protected function processActions()
	{			
		switch ($this->action) 
		{
		    case 'add':			
				// Redirect
		        header('Location: backend.php?show=post&id=0');
		    break;
		
			case 'delete':						    
	    		// Post löschen
	    		$this->connector->deleteBlogPost($this->id);
	    			
				// Redirect
	       		header('Location: backend.php');
		    break;
		    
		    case 'delete_comment':		    
	    		// Kommentar löschen
	    		$this->connector->deleteComment($this->id);
	    			
				// Redirect
	       		header('Location: backend.php');	
		    break;
		    
		    // Default action
		    default:  		
				// Hole alle Blogeinträge aus der Datenbank
				$this->data = $this->connector->getBlog(0, -1);
				$this->data->pageTitle = 'Einträge';
		    break;
		}	
	}
	
	/**
	 * Template rendern
	 */
	public function render()
	{	
		require_once $this->templatePath."backend/index.php";
	}
}

/*
 * File: controller/backend/PostsBackendController.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *
 */
?>