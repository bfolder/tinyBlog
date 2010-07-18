<?php 
/*
 * File: view/templates/backend/login.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *  Abstract    : Login - Backend Template
 *
 */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo BLOG_TITLE; ?> | <?php echo $this->pageTitle; ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo $this->templatePath ?>/style/style.css" media="screen" />
<script type="text/javascript" src="<?php echo $this->templatePath ?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $this->templatePath ?>js/jquery.validate.pack.js"></script>
<script type="text/javascript" src="<?php echo $this->templatePath ?>js/jquery.rte.js"></script>
<script type="text/javascript" src="<?php echo $this->templatePath ?>js/custom_be.js"></script>
</head>
<body>
<div id="headerLogin">
	<a href="index.php" title="Home"><img id="logo" src="<?php echo $this->templatePath ?>/images/logo_be.png" alt="Logo" /></a>
</div>
<div id="pageLogin">
	<div id="content">
		<form action="backend.php?action=login" method="post" id="loginform">	
			<fieldset>
				<label for="username" class="label"><small>Benutzername*:</small></label>
				<input class='input' type='text' name='username' id='un' value=""/>
				<label for="password" class="label"><small>Password*:</small></label>
				<input class='input' type='password' name='password' id='pw' value=""/>
		   		<p><input name="submit" type="submit" class="submit" tabindex="5" value="Anmelden" /></p>
	   		</fieldset>
		</form>
		
		<?php 
		if($this->failedLogin)
			print '<div class="error"><small>Login Fehlgeschlagen! Bitte Überprüfen Sie Ihre Daten.</small></div>';
		?>
	</div>
</div>
</body>
</html>

<?php 
/*
 * File: view/templates/backend/login.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *  Abstract    : Login - Backend Template
 *
 */
?>