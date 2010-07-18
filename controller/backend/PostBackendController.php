<?php
/*
 * File: controller/backend/PostBackendController.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *
 */

require_once './model/service/IBlogTransactions.php';
require_once './model/Post.php';
require_once './controller/abstract/AbstractController.php';

/**
 * Controller zur Ansicht eines einzelnen Blogeintrags
 * 
 * @author Heiko Dreyer
 *
 */
class PostBackendController extends AbstractController
{			
	/** 
	 * Jeweilige Action ausführen
	 */
	protected function processActions()
	{
		switch ($this->action) 
		{
		    case 'save':
		    	// Wenn der titel vorhanden ist, können wir den Post erstellen
		    	if(isset($_POST['title']) && $_POST['title'] != '')
		    	{
		    		// Kategorien laden
		    		$categories = $this->connector->getCategories();
		    		
			    	// Daten aus dem Post holen
			    	$post = new Post();
			    	$post->title = $_POST['title'];
			    	$post->content = $_POST['content'];
			    	
			    	// Kategorien reset
			    	$post->categories = array();
			    	
			    	// Ordne kategorien erneut zu
			    	foreach($categories as $category)
			    	{
			    		if(isset($_POST[$category->id]))
			    			$post->categories[] = $category;
			    	}
		    	
			    	if($this->id == 0)
			    		// Neuer Eintrag wird erstellt
			    		$this->connector->createBlogPost($post);
			    	else
			    	{
			    		// Es wird geupdatet, mit id
			    		$post->id = $this->id;
			    		$this->connector->updateBlogPost($post);
			    	}
			    			    		
					// Redirect
			        header('Location: backend.php');
		    	}
		   	break;
		   	
			// Default Action	
		    default:
		    	$this->data = $this->connector->getBlogByPostId($this->id);
			
				if($this->id == 0)
				{
					$post = new Post();
					$post->id = 0;
					$this->data->posts[] = $post;
					$this->data->pageTitle = 'Neuer Eintrag';
				}	
				else		
					$this->data->pageTitle = $this->data->posts[0]->title.' editieren';
		    break;
		}						
	}
	
	/**
	 * Template rendern
	 */
	public function render()
	{
		require_once $this->templatePath."backend/single.php";
	}
}

/*
 * File: controller/backend/PostBackendController.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *
 */
?>