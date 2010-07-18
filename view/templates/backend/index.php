<?php 
/*
 * File: view/templates/backend/index.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *  Abstract    : Blogübersicht - Backend Template
 *
 */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo BLOG_TITLE; ?> | <?php echo $this->data->pageTitle; ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo $this->templatePath ?>style/style.css" media="screen" />
<script type="text/javascript" src="<?php echo $this->templatePath ?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $this->templatePath ?>js/jquery.validate.pack.js"></script>
<script type="text/javascript" src="<?php echo $this->templatePath ?>js/jquery.rte.js"></script>
<script type="text/javascript" src="<?php echo $this->templatePath ?>js/custom_be.js"></script>
</head>
<body>
<div id="header">
	<a href="backend.php" title="Home"><img id="logo" src="<?php echo $this->templatePath ?>/images/logo_be.png" alt="Logo" /></a>
</div>
<div id="page">
	<h1 id="toptitle">
	<?php echo $this->data->pageTitle; ?>
	</h1>
	<div id="content">
		<div id="backendPosts">
		<!-- Posts -->		
			<?php
					if(count($this->data->posts) > 0)
					{
						print '<p style="display:none" id="no-entries">Keine Einträge vorhanden</p>';
						
						foreach($this->data->posts as $post)
						{
							print '<div class="backendPost">';
							print '<img class="be-post-loader" src="'.$this->templatePath.'images/ajax-loader-post.gif" alt="Lade..." />';
							print '<div class="backendPost-content">';
							print '<span class="postbar">';
							
							// Zeige das Icon nur wenn Kommentare vorhanden sind
							if(count($post->comments))					
								print '<a class="plus pointer" title="Kommentare anzeigen"></a>';
								
							print '<a id="post-'.$post->id.'" title="Eintrag löschen" class="delete pointer"><img src="'.$this->templatePath.'/images/x_14x14.png" alt="Löschen" /></a>';							
							print '</span><h4><a href="backend.php?show=post&amp;id='.$post->id.'" title="Eintrag editieren">'.$post->title.'</a></h4><div class="clear"></div>';
							print '<div class="commentdiv">';
							
							foreach($post->comments as $comment)
							{							
								print '<div class="be-comment">';
								print '<img class="be-comment-loader" src="'.$this->templatePath.'images/ajax-loader-comment.gif" alt="Lade..." />';
								print '<h5>Kommentar von: <i>'.$comment->authorName.'</i> | <a style="text-decoration: underline;" class="pointer delete-comment" id="comment-'.$comment->id.'" title="Kommentar löschen">Löschen</a></h5>';
								print '<p>'.$comment->content.'</p>';
								print '</div>';
							}
							print '</div>';
							print '</div>';
							print '</div>';
							
						}
					}
					else	
					{
						print '<p>Keine Einträge vorhanden</p>';
					}
				?>		
		<!-- Endposts -->	
		</div>
		<div id="addEntryField">
			<a href="backend.php?action=add" title="Einen Eintrag hinzufügen">Einen Eintrag hinzufügen</a>
		</div>
	</div>
	
	
	<div id="sidebar">
		<div id="sidebar-content">
			<ul>
				<li>
					<h2>Übersicht</h2>
					<ul>
						<li><a href="backend.php">Einträge</a></li>
						<li><a href="backend.php?show=categories">Kategorien</a></li>
						<li><a href="backend.php?show=logout">Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>
<div id="footer">
	<p>tinyBlog - 2010 Heiko Dreyer | <a href="index.php" title="Frontend">Frontend</a></p>
</div>
</body>
</html>

<?php 
/*
 * File: view/templates/backend/index.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *  Abstract    : Blogübersicht - Backend Template
 *
 */
?>