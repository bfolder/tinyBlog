<?php
/*
 * File: model/service/IBlogTransactions.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *
 */

include_once './model/Category.php';
include_once './model/Post.php';
include_once './model/Comment.php';

/**
 * Interface zur implementierung von Service-Methoden für die Domäne "Blog"
 * 
 * @author Heiko Dreyer
 *
 */
interface IBlogTransactions
{
	// Daten fetchen
		
	/**
	 * Lädt Posts mit angegebenen params
	 * 
	 * @param int
	 * @param int
	 * @return array
	 */
	public function getBlog($start, $amount);
	
	/**
	 * Lädt Posts zu einer bestimmten Category
	 * 
	 * @param Category $category
	 * @return array
	 */
	public function getBlogByCategoryId($categoryId);

	/**
	 * Lädt einen Blog mit einem einzigen Eintrag
	 * 
	 * @return array
	 */
	public function getBlogByPostId($postId);
	
	/**
	 * Lädt alle Categories
	 * 
	 * @return array
	 */
	public function getCategories();
	
	// Daten speichern
	
	/**
	 * Erstellt einen Kommentar
	 * 
	 * @param int $postId
	 * @param Comment $comment
	 */
	public function createComment($postId, Comment $comment);
	
	/**
	 * Erstellt einen Post
	 * 
	 * @param Post $post
	 */
	public function createBlogPost(Post $post);
	
	/**
	 * Erstellt eine Category
	 * 
	 * @param Category $category
	 */
	public function createCategory(Category $category);
	
	/**
	 * Updatet einen Post
	 * 
	 * @param Post $post
	 */
	public function updateBlogPost(Post $post);
	
	/**
	 * Updatet eine Category
	 * 
	 * @param Category $category
	 */
	public function updateCategory(Category $category);
	
	// Daten löschen
	
	/**
	 * Löscht einen Kommentar
	 * 
	 * @param int $commentId
	 */
	public function deleteComment($commentId);
	
	/**
	 * Löscht einen Post
	 * 
	 * @param int $postId
	 */
	public function deleteBlogPost($postId);
	
	/**
	 * Löscht eine Category
	 * 
	 * @param int $categoryId
	 */
	public function deleteCategory($categoryId);
}

/*
 * File: model/service/IBlogTransactions.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *
 */
?>