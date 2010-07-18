<?php
/*
 * File: model/service/MySQLConnector.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *
 */

require_once './model/service/DatabaseConnector.php';
require_once './model/service/IBlogTransactions.php';
require_once './model/Blog.php';
require_once './model/Post.php';
require_once './model/Comment.php';
require_once './model/Category.php';

/**
 * Konkrete MySQL Verbindungsklasse
 * 
 * @author heikodreyer
 *
 */
class MySQLConnector extends DatabaseConnector implements IBlogTransactions
{	
	/**
	 * Mit der Datenbank verbinden
	 * und Verbindungs-ID zurückgeben.
	 *
	 * @return int
	 */
	protected function connect()
	{
		$linkId = mysql_pconnect(DATABASE_SERVER, DATABASE_USERNAME, DATABASE_PASSWORD);
		
		if(!$linkId || !mysql_select_db(DATABASE_NAME, $linkId))
			throw new Exception('Keine Verbindung zur Datenbank.');

		return $linkId;
	}
	
	/**
	 * Erstellt einen Blog aus einer Query. Gibt diesen anschließend zurück
	 * 
	 * @param $query
	 * @return Blog
	 */
	private function createBlogFromQuery($query)
	{	
		$blog = new Blog();
		$blog->posts = array();	
		$blog->categories = $this->getCategories();
	
		$result = mysql_query($query, $this->linkId);

		while($data = mysql_fetch_object($result))
		{
			$post = new Post();
			$post->content = $data->content;
			$post->date = new DateTime($data->date);;
			$post->id = $data->id;
			$post->title = $data->title;
				
			// Kommentare für einen Post holen
			$this->assignCommentsToPost($post);
				
			// Kategorien zuordnen
			$this->assignCategories($blog, $post);	
				
			$blog->posts[] = $post;
		}
		
		return $blog;
	}
	
	/**
	 * Ordnet Kategorien zu einem Post und einem Blog
	 *
	 * @param Post $post
	 * @param Blog $blog
	 */
	private function assignCategories(Blog $blog, Post $post)
	{
		$post->categories = array();
		
		// Kategorien zum post holen
		$categoryQuery = 'SELECT Categories.id';
		$categoryQuery .= ' FROM Categories, Category_relationships, Posts';
		$categoryQuery .= ' WHERE Categories.id = Category_relationships.category_id';
		$categoryQuery .= ' AND Category_relationships.post_id ='.mysql_real_escape_string($post->id);
		$categoryQuery .= ' AND Posts.id ='.mysql_real_escape_string($post->id);
			
		$categoryResult = mysql_query($categoryQuery, $this->linkId);
			
		while($categoryData = mysql_fetch_object($categoryResult))
		{
			// Alle vorhandenen Kategorien Durchgehen und dem Post zuordnen
			foreach($blog->categories as $category)
			{
				if($category->id == $categoryData->id)
				
				// Lokal im Post Speichern
				$post->categories[] = $category;
			}
		}
	}
	
	/**
	 * Holt Kommentare zu einem Post aus der DB und ordnet sie zu
	 * 
	 * @param Post $post
	 */
	private function assignCommentsToPost(Post $post)
	{
		$post->comments = array();

		// Kommentare zum post holen
		$commentQuery = 'SELECT id, authorName, authorEmail, date, content';
		$commentQuery .= ' FROM Comments';
		$commentQuery .= ' WHERE post_id ='.mysql_real_escape_string($post->id);
		$commentQuery .= ' ORDER BY date DESC';

		$commentResult = mysql_query($commentQuery, $this->linkId);

		while($commentData = mysql_fetch_object($commentResult))
		{
			$comment = new Comment();
			$comment->id = $commentData->id;
			$comment->authorName = $commentData->authorName;
			$comment->authorEmail = $commentData->authorEmail;
			$comment->content = $commentData->content;
			$comment->date = new DateTime($commentData->date);

			$post->comments[] = $comment;
		}
	}
	
	/**
	 * Stellt die Category-Post relationen in der DB zu einem Post her
	 * 
	 * @param $categories
	 * @param $postid
	 */
	private function assignCategoryRelations(Post $post)
	{	
		// Lösche erst alte Relationen	
		$query = 'DELETE FROM Category_relationships';
		$query .= ' WHERE post_id='.mysql_real_escape_string($post->id);
		
		$result = mysql_query($query, $this->linkId);
		
		// Speichere Relationen erneut
		$query = 'INSERT INTO Category_relationships';
		$query .= ' (category_id, post_id)';
		$query .= ' values ';
		
		for($i = 0; $i < count($post->categories); $i++)
		{
			$category = $post->categories[$i];
			$query .= '("'.$category->id.'", "'.$post->id.'")';
			
			if($i < count($post->categories) - 1)
				$query .= ',';
		}
				  
		$result = mysql_query($query, $this->linkId);
	}
	
	// Daten fetchen

	/**
	 * @see model/service/IBlogTransactions#getBlog($start, $amount)
	 */
	public function getBlog($start, $amount)
	{
		// Alle Posts aus der DB holen
		$query = 'SELECT id, date, title, content';
		$query .= ' FROM Posts';
		$query .= ' ORDER BY date DESC';
		
		if($amount == -1)
		// Laut MYSQL-Referenz soll eine "ziemlich große" Zahl (18446744073709551615) benutzt werden um vom Limit x bis zum ende zu fetchen
			$query .= ' LIMIT '.mysql_real_escape_string($start).', 18446744073709551615';
		else	
			$query .= ' LIMIT '.mysql_real_escape_string($start).', '.mysql_real_escape_string($amount);
			
		return $this->createBlogFromQuery($query);
	}

	/**
	 * @see model/service/IBlogTransactions#getBlogByCategoryId($categoryId)
	 */
	public function getBlogByCategoryId($categoryId)
	{
		// Alle Posts aus einer bestimmten Category aus der DB holen
		$query = 'SELECT Posts.id, Posts.date, Posts.title, Posts.content';
		$query .= ' FROM Posts, Category_relationships, Categories';
		$query .= ' WHERE Posts.id = Category_relationships.post_id';
		$query .= ' AND Category_relationships.category_id ='.mysql_real_escape_string($categoryId);
		$query .= ' AND Categories.id ='.mysql_real_escape_string($categoryId);
		$query .= ' ORDER BY date DESC';

		return $this->createBlogFromQuery($query);
	}
	
	/**
	 * @see model/service/IBlogTransactions#getBlogByPostId($postId)
	 */
	public function getBlogByPostId($postId)
	{
		// Post mit einer bestimmten id holen
		$query = 'SELECT id, date, title, content';
		$query .= ' FROM Posts';
		$query .= ' WHERE Posts.id ='.$postId;
	
		return $this->createBlogFromQuery($query);
	}
	
	/**
	 * @see model/service/IBlogTransactions#getCategories()
	 */
	public function getCategories()
	{
		$categories = array();
		
		// Category holen
		$query = 'SELECT id, name, (SELECT count(*) FROM Category_relationships WHERE category_id = id) as num_posts';
		$query .= ' FROM Categories';
		$query .= ' ORDER BY Categories.id ASC';

		$result = mysql_query($query, $this->linkId);

		while($data = mysql_fetch_object($result))
		{
			$category = new Category();
			$category->id = $data->id;
			$category->name = $data->name;
			$category->numPosts = (int) $data->num_posts;

			$categories[] = $category;
		}
		
		return $categories;
	}

	// Daten Speichern
	
	/**
	 * @see model/service/IBlogTransactions#createComment($postId, $comment)
	 */
	public function createComment($postId, Comment $comment)
	{
		// Speichere Kommentar in DB
		$query = 'INSERT INTO Comments';
		$query .= ' (post_id, date, authorName, authorEmail, content)';
		$query .= ' values ("'.mysql_real_escape_string($postId).'","';
		$query .= $comment->date->format('Y-m-d H:i:s').'","'.mysql_real_escape_string($comment->authorName).'","';
		$query .= mysql_real_escape_string($comment->authorEmail).'","'.mysql_real_escape_string($comment->content).'")';
				  
		$result = mysql_query($query, $this->linkId);
	}

	/**
	 * @see model/service/IBlogTransactions#createBlogPost($post)
	 */
	public function createBlogPost(Post $post)
	{
		$post->date = new DateTime();
		
		// Speichere Blog Post in DB
		$query = 'INSERT INTO Posts';
		$query .= ' (date, title, content)';
		$query .= ' values ("'.$post->date->format('Y-m-d H:i:s').'", "'.mysql_real_escape_string($post->title).'", "'.mysql_real_escape_string($post->content).'")';	  
		$result = mysql_query($query, $this->linkId);
		
		$post->id = mysql_insert_id($this->linkId);
		
		// Speichere Category relationen
		$this->assignCategoryRelations($post);
	}

	/**
	 * @see model/service/IBlogTransactions#createCategory($category)
	 */
	public function createCategory(Category $category)
	{
		// Speichere Category
		$query = 'INSERT INTO Categories';
		$query .= ' (name)';
		$query .= ' values ("'.mysql_real_escape_string($category->name).'")';	  
		$result = mysql_query($query, $this->linkId);
		
		$category->id = mysql_insert_id($this->linkId);
		
		return $category;
	}

	/**
	 * @see model/service/IBlogTransactions#updateBlogPost($post)
	 */
	public function updateBlogPost(Post $post)
	{
		// Speichere Blog Post in DB
		$query = 'UPDATE Posts';
		$query .= ' SET title="'.mysql_real_escape_string($post->title).'", content="'.mysql_real_escape_string($post->content).'"';
		$query .= ' WHERE id="'.mysql_real_escape_string($post->id).'"';
		$result = mysql_query($query, $this->linkId);
		
		// Speichere Category relationen
		$this->assignCategoryRelations($post);
	}

	/**
	 * @see model/service/IBlogTransactions#updateCategory($category)
	 */
	public function updateCategory(Category $category)
	{
		// Speichere Category in DB
		$query = 'UPDATE Categories';
		$query .= ' SET name="'.mysql_real_escape_string($category->name).'"';
		$query .= ' WHERE id="'.mysql_real_escape_string($category->id).'"';
		$result = mysql_query($query, $this->linkId);
	}
	
	// Daten Löschen
	
	/**
	 * @see model/service/IBlogTransactions#deleteComment($commentId)
	 */
	public function deleteComment($commentId)
	{
		// Comment löschen
		$query = 'DELETE FROM Comments';
		$query .= ' WHERE id='.mysql_real_escape_string($commentId);
		
		$result = mysql_query($query, $this->linkId);
	}
	
	/**
	 * @see model/service/IBlogTransactions#deleteBlogPost($postId)
	 */
	public function deleteBlogPost($postId)
	{
		// Post löschen
		$query = 'DELETE FROM Posts';
		$query .= ' WHERE id='.mysql_real_escape_string($postId);
		
		$result = mysql_query($query, $this->linkId);
		
		// Relationen löschen
		$query = 'DELETE FROM Category_relationships';
		$query .= ' WHERE post_id='.mysql_real_escape_string($postId);
		
		$result = mysql_query($query, $this->linkId);
	}
	
	/**
	 * @see model/service/IBlogTransactions#deleteCategory($categoryId)
	 */
	public function deleteCategory($categoryId)
	{
		// Category löschen
		$query = 'DELETE FROM Categories';
		$query .= ' WHERE id='.mysql_real_escape_string($categoryId);
		
		$result = mysql_query($query, $this->linkId);
		
		// Relationen löschen
		$query = 'DELETE FROM Category_relationships';
		$query .= ' WHERE category_id='.mysql_real_escape_string($categoryId);
		
		$result = mysql_query($query, $this->linkId);
	}
}

/*
 * File: model/service/MySQLConnector.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *
 */
?>