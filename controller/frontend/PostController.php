<?php
/*
 * File: controller/frontend/PostController.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *
 */

require_once './model/service/IBlogTransactions.php';
require_once './controller/abstract/AbstractController.php';

/**
 * Controller zur Ansicht eines einzelnen Blogeintrags
 * 
 * @author Heiko Dreyer
 *
 */
class PostController extends AbstractController
{		
	/** 
	 * Jeweilige Action ausführen
	 */
	protected function processActions()
	{
		switch($this->action) 
		{
		    case 'add_comment':
		    	$comment = new Comment();
		    	// Speichere Kommentar falls benötigte Felder ausgefüllt sind
				if(isset($_POST['name']) && isset($_POST['message']))
				{
					$comment->authorName = $_POST['name'];
					$comment->authorEmail = $_POST['email'];
					$comment->content = $_POST['message'];
					$comment->date = new DateTime();
					$this->connector->createComment($this->id, $comment);
				}
				
				// Redirect
		        header('Location: index.php?show=post&id='.$this->id);
		    break;
		    
			// Default Action
		    default:	    					
				$this->data = $this->connector->getBlogByPostId($this->id);
				
				if(isset($this->data->posts[0]))
					$this->data->pageTitle = $this->data->posts[0]->title;	
				else
					$this->data->pageTitle = 'Kein Eintrag vorhanden';
		    break;
		}			
	}
	
	/**
	 * Template rendern
	 */
	public function render()
	{
		require_once $this->templatePath."single.php";
	}
}

/*
 * File: controller/frontend/PostController.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *
 */
?>