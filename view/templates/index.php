<?php 
/*
 * File: view/templates/index.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *  Abstract    : Blogübersicht - Template
 *
 */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo BLOG_TITLE; ?> | <?php echo $this->data->pageTitle; ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo $this->templatePath ?>/style/style.css" media="screen" />
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
						foreach($this->data->posts as $post)
						{
							
							print '<div class="post">';
							print '<h2 class="title"><a href="index.php?show=post&amp;id='.$post->id.'" title="Mehr lesen">'.$post->title.'</a></h2>';
							
							print '<p class="timeline"><small>Geschrieben am '.$post->date->format('d.m.Y').' um '.$post->date->format('H:i').' Uhr';
							
							// Trenner anzeigen
							if(count($post->categories) > 0)
								print ' | ';
							
							// Kategorien anzeigen
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
							
							print '<div class="meta">';
							print '<p class="links"><a href="index.php?show=post&amp;id='.$post->id.'#comments" class="comments">Kommentare ('.count($post->comments).')</a></p>';
							print '</div>';
							
							print '</div>';
						}
					}
					else	
					{
						print '<div class="post">';
						print '<div class="entry">';
						print 'Keine Einträge vorhanden';
						print '</div>';
						print '</div>';
					}
				?>		
		<!-- Endposts -->
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
							// Verfügbare Kategorien anzeigen, falls vorhanden
							if(count($this->data->categories) > 0)
							{
								
								print '<ul>';
								
								foreach($this->data->categories as $category)
								{									
									print '<li><a href="index.php?show=category&amp;id='.$category->id.'">'.$category->name.' ('.$category->numPosts.')</a></li>';
								}
								
								print '</ul>';
							}
							else	
								print '<div>Keine Kategorien vorhanden</div>';
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
 * File: view/templates/index.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *  Abstract    : Blogübersicht - Template
 *
 */
?>