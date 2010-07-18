<?php 
/*
 * File: view/templates/backend/categories.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *  Abstract    : Kategorieübersicht
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
		<!-- Categories -->		
			<?php
				if(count($this->data->categories) == 0)
					print '<p style="display:none" id="no-entries">Keine Kategorien vorhanden</p>';
				
				foreach($this->data->categories as $category)
				{
					print '<div class="backendPost">';
					print '<img class="be-post-loader" src="'.$this->templatePath.'images/ajax-loader-post.gif" alt="Lade..." />';
					print '<div class="backendPost-content">';
					print '<span class="postbar">';
						
					print '<a id="category-'.$category->id.'" title="Kategorie löschen" class="delete category pointer"><img src="'.$this->templatePath.'images/x_14x14.png" alt="Löschen" /></a>';
					print '<a id="categorysave-'.$category->id.'" title="Kategorie speichern" class="save pointer"><img src="'.$this->templatePath.'images/check_16x13_white.png" alt="Speichern" /></a>';								
					print '</span><form action="" id="form-'.$category->id.'"><input class="input-category name required" type="text" name="name" value="'.$category->name.'" /></form><div class="clear"></div>';
					print '</div>';
					print '</div>';
				}
				
			?>		
		<!-- Categories -->	
		</div>
		<div id="addEntryField">
			<form action="" id="category-create-form">
				<fieldset>
					<label for="name" class="label"><small>Neue Kategorie*:</small></label>
					<a style="margin-right: 10px;" class="pointer" title="Kategory hinzufügen" id="add-category"><img src="<?php echo $this->templatePath ?>images/check_16x13.png" alt="Speichern" /></a>
					<input class="input-category name required" type="text" id="name" name="name" />
				</fieldset>
			</form>
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
 * File: view/templates/backend/categories.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *  Abstract    : Kategorieübersicht
 *
 */
?>