<?php
/*
 * File: model/Post.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *
 */

/**
 * Post Value Object
 * 
 * @author Heiko Dreyer
 *
 */
class Post
{		
	/**
	 * Id
	 * 
	 * @var int
	 */
	public $id;
	
	/**
	 * Datum des Eintrags
	 * 
	 * @var DateTime
	 */
	public $date;
	
	/**
	 * Kategorien die mit dem Eintrag verknüpft sind
	 * 
	 * @var array
	 */
	public $categories;
	
	/**
	 * Kommentare des Beitrags
	 * 
	 * @var array
	 */
	public $comments;
	
	/**
	 * Title des Eintrags
	 * 
	 * @var string
	 */
	public $title;
	
	/**
	 * Inhalt des Eintrags
	 * 
	 * @var string
	 */
	public $content;
}

/*
 * File: model/Post.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *
 */
?>