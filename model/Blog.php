<?php
/*
 * File: model/Blog.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *
 */

/**
 * Blog Value Object
 * 
 * @author Heiko Dreyer
 *
 */
class Blog
{
	/**
	 * Name der Aktuellen Seite des Blogs
	 * 
	 * @var array
	 */
	public $pageTitle;
	
	/**
	 * Array mit Referenzen auf alle Kategorien
	 * 
	 * @var array
	 */
	public $categories;
	
	/**
	 * Array mit Referenzen auf alle Einträge
	 * 
	 * @var array
	 */
	public $posts;
}

/*
 * File: model/Blog.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *
 */
?>