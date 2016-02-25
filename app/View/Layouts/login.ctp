<?php
$cakeDescription = __d('cake_dev', 'PCCF Kendulip');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>

	<?php
		$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
		$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version());
		echo $this->Html->meta('icon');
		echo $this->Html->css(array('reset','style','invalid'));
		echo $this->Html->script(array('jquery-1.3.2.min','simpla.jquery.configuration','facebox','jquery.wysiwyg','md5'));
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');

	?>
	<!-- Reset Stylesheet -->
		<link rel="stylesheet" href="<?php echo $this->webroot; ?>resources/css/reset.css" type="text/css" media="screen" />
	  
		<!-- Main Stylesheet -->
		<link rel="stylesheet" href="<?php echo $this->webroot; ?>resources/css/style.css" type="text/css" media="screen" />
		
		<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
		<link rel="stylesheet" href="<?php echo $this->webroot; ?>resources/css/invalid.css" type="text/css" media="screen" />	
		
		<!-- Colour Schemes
	  
		Default colour scheme is green. Uncomment prefered stylesheet to use it.
		
		<link rel="stylesheet" href="resources/css/blue.css" type="text/css" media="screen" />
		
		<link rel="stylesheet" href="resources/css/red.css" type="text/css" media="screen" />  
	 
		-->
		
		<!-- Internet Explorer Fixes Stylesheet -->
		
		<!--[if lte IE 7]>
			<link rel="stylesheet" href="resources/css/ie.css" type="text/css" media="screen" />
		<![endif]-->
		
		<!--                       Javascripts                       -->
  
		<!-- jQuery -->
		<script type="text/javascript" src="<?php echo $this->webroot; ?>resources/scripts/jquery-1.3.2.min.js"></script>
		
		<!-- jQuery Configuration -->
		<script type="text/javascript" src="<?php echo $this->webroot; ?>resources/scripts/simpla.jquery.configuration.js"></script>
		
		<!-- Facebox jQuery Plugin -->
		<script type="text/javascript" src="<?php echo $this->webroot; ?>resources/scripts/facebox.js"></script>
		
		<!-- jQuery WYSIWYG Plugin -->
		<script type="text/javascript" src="<?php echo $this->webroot; ?>resources/scripts/jquery.wysiwyg.js"></script>
		
		<!-- jQuery Datepicker Plugin -->
		<script type="text/javascript" src="<?php echo $this->webroot; ?>resources/scripts/jquery.datePicker.js"></script>
		<script type="text/javascript" src="<?php echo $this->webroot; ?>resources/scripts/jquery.date.js"></script>
	
</head>
<body>
	
<body>

		
		<div id="main-content"> <!-- Main Content Section with everything -->
	
		<center>
		<?php echo $this->Session->flash(); ?>
	
		
		<?php echo $this->fetch('content'); ?>
			</center>

	</div>
	
</body>
</html>