<?php 
/*
 * File: view/templates/single.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *  Abstract    : Einzelner Blogeintrag - Template
 *
 */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo BLOG_TITLE; ?> | <?php echo $this->data->pageTitle; ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo $this->templatePath ?>/style/style.css" media="screen" />
<script type="text/javascript" src="<?php echo $this->templatePath ?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $this->templatePath ?>js/jquery.validate.pack.js"></script>
<script type="text/javascript" src="<?php echo $this->templatePath ?>js/custom.js"></script>
</head>
<body>
<div id="header">
	<a href="index.php" title="Home"><img id="logo" src="<?php echo $this->templatePath ?>/images/logo.png" alt="Logo" /></a>
</div>
<div id="page">
	<h1 id="toptitle">
	<?php echo $this->data->pageTitle; ?>
	</h1>
	<div id="content">
		<!-- Posts -->		
			<?php
					if(count($this->data->posts) > 0)
					{
						$post = $this->data->posts[0];
						
						print '<div class="post">';
						print '<h2 class="title">'.$post->title.'</h2>';
						
						print '<p class="timeline"><small>Geschrieben am '.$post->date->format('d.m.Y').' um '.$post->date->format('H:i').' Uhr';
						
						// Trenner anzeigen
						if(count($post->categories) > 0)
							print ' | ';
						
						for($i = 0; $i < count($post->categories); $i++)
						{
							print '<a href="index.php?show=category&amp;id='.$post->categories[$i]->id.'" title="'.$post->categories[$i]->name.'">'.$post->categories[$i]->name.'</a>';
							
							if($i != count($post->categories) - 1)
								print ', ';						
						}
						
						print '</small></p>';
						
						print '<div class="entry">';
						print $post->content;
						print '</div>';
						
						print '</div>';
					}
					else	
					{
						print '<div class="post">';
						print '<div class="entry">';
						print 'Keinem Eintrag mit zugehöriger Id vorhanden.';
						print '</div>';
						print '</div>';
					}
				?>		
		<!-- Endposts -->
		<?php if(count($this->data->posts) > 0): ?>
		
		<div id="commentField">
			<?php
				if(count($post->comments) > 0)
					print '<h3 id="comments">Kommentare:</h3>';
			
				foreach($post->comments as $comment)
				{
					print '<div class="comment">';
					
					if(isset($comment->authorEmail) && $comment->authorEmail != '')					
						print '<h4>Geschrieben von <a href="mailto:'.$comment->authorEmail.'" title="Email an Autor"><i>'.$comment->authorName.'</i></a> am '.$comment->date->format('d.m.Y').' um '.$comment->date->format('H:i').' Uhr</h4>';
					else
						print '<h4>Geschrieben von <i>'.$comment->authorName.'</i> am '.$comment->date->format('d.m.Y').' um '.$comment->date->format('H:i').' Uhr</h4>';
						
					print '<p>'.$comment->content.'</p>';
					print '</div>';
				}
			?>
		</div>
		
		<div id="postField">
			<h3>Kommentar schreiben:</h3>
			<form action="index.php?show=post&amp;id=<?php echo $post->id; ?>&amp;action=add_comment" method="post" id="commentform">
				<fieldset>
					 <label for="name" class="label"><small>Name*:</small></label>
					 <input class='input' type='text' name='name' id='na' value=""/>
					 <label for="email" class="label"><small>Email:</small></label>
					 <input class='input' type='text' name='email' id='em' value=""/>
					 <label for="message" class="label"><small>Kommentar*:</small></label>
			 		 <textarea class='input' name='message' id='msg' rows='4' cols='30'></textarea>
		
   					 <p><input name="submit" type="submit" class="submit" tabindex="5" value="Abschicken" /></p>
				</fieldset>
			</form>
		</div>
	<?php endif; ?>
	</div>
	
	
	<div id="sidebar">
		<div id="sidebar-content">
			<ul>
				<li>
					<h2>Übersicht</h2>
					<ul>
						<li><a href="index.php">Aktuelles</a></li>
						<li><a href="index.php?id=10">Archiv</a></li>
					</ul>
				</li>
				<li>
					<h2>Kategorien</h2>
						<?php 
							if(count($this->data->categories) > 0)
							{
								
								print '<ul>';
								
								foreach($this->data->categories as $category)
								{									
									print '<li><a href="index.php?show=category&id='.$category->id.'">'.$category->name.' ('.$category->numPosts.')</a></li>';
								}
								
								print '</ul>';
							}
							else	
							{
								print '<div>Keine Kategorien vorhanden</div>';
							}
						?>
				</li>
			</ul>
		</div>
	</div>
</div>
<div id="footer">
	<p>tinyBlog - 2010 Heiko Dreyer | <a href="backend.php" title="Backend">Backend</a></p>
</div>
</body>
</html>

<?php 
/*
 * File: view/templates/single.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *  Abstract    : Einzelner Blogeintrag - Template
 *
 */
?>