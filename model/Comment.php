<?php
/*
 * File: model/Comment.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *
 */

/**
 * Comment Value Object
 * 
 * @author Heiko Dreyer
 *
 */
class Comment
{		
	/**
	 * Id
	 * 
	 * @var int
	 */
	public $id;
	
	/**
	 * Datum des Kommentars
	 * 
	 * @var DateTime
	 */
	public $date;
	
	/**
	 * Name des Autors
	 * 
	 * @var string
	 */
	public $authorName;
	
	/**
	 * Email des Autors
	 * 
	 * @var string
	 */
	public $authorEmail;
	
	/**
	 * Inhalt des Kommentars
	 * 
	 * @var string
	 */
	public $content;
}

/*
 * File: model/Comment.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *
 */
?>