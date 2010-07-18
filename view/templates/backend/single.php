<?php 
/*
 * File: view/templates/backend/single.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *  Abstract    : Einzelner Blogeintrag - Backend Template
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
<script type="text/javascript" src="<?php echo $this->templatePath ?>js/jquery.rte.js"></script>
<script type="text/javascript" src="<?php echo $this->templatePath ?>js/custom_be.js"></script>
</head>
<body>
<div id="header">
	<a href="backend.php" title="Home"><img id="logo" src="<?php echo $this->templatePath ?>/images/logo_be.png" alt="Logo" /></a>
</div>
<?php $post = $this->data->posts[0];?>
<form action="backend.php?show=post&amp;id=<?php echo $post->id; ?>&amp;action=save" method="post" id="postform">
<div id="page">
	<h1 id="toptitle">
		<?php echo $this->data->pageTitle; ?>
	</h1>
	<div id="content">
		<!-- Post -->							
			<?php 
				if($post->date)
					print '<h5 class="smalldate">Erstellt am '.$post->date->format('d.m.Y').' um '.$post->date->format('H:i').' Uhr</h5>';
			?>		
					
			<div id="editPostField">
				<fieldset>
				 	<label for="title" class="label"><small>Title*:</small></label>
					<input class='input' type='text' name='title' id='na' value="<?php echo $post->title ?>"/>
				 	<label for="content" class="label"><small>Eintrag:</small></label>
			 		<textarea rows="11" cols="11" class='input rte-zone' name='content' id='msg'><?php echo $post->content ?></textarea>	
   					<p><input name="submit" type="submit" class="submit" tabindex="5" value="Speichern" /></p>
				</fieldset>
			</div>
		<!-- Endpost -->
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
				
				<li>
					<h2>Kategorien</h2>
					<ul>
						<?php 
							// Zeige alle Kategorien
							foreach($this->data->categories as $category)
							{							
								$checked = '';
								
								// Prüfe ob sich aktueller Post in der Kategorie befindet
								if(isset($post->categories))
									foreach($post->categories as $aCategory)
										if($aCategory->id == $category->id)
											$checked = 'checked="checked"';
								
								print '<li><input class="checkbox" type="checkbox" name="'.$category->id.'" id="category-'.$category->id.'" '.$checked.' /><label for="'.$category->name.'" class="checkbox">'.$category->name.'</label></li>';
							}	
						?>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>
</form>
<div id="footer">
	<p>tinyBlog - 2010 Heiko Dreyer | <a href="index.php" title="Frontend">Frontend</a></p>
</div>
</body>
</html>

<?php 
/*
 * File: view/templates/backend/single.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *  Abstract    : Einzelner Blogeintrag - Backend Template
 *
 */
?>