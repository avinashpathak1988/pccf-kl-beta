<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PCCF KL LOGIN</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
<?php    
    echo $this->fetch('css');
    echo $this->fetch('script');
    echo $this->Html->css(array(
        'jquery-ui','../adminlte/bootstrap/css/bootstrap.min','font-awesome.min','ionicons.min',
        '../adminlte/dist/css/AdminLTE.min','../adminlte/dist/css/skins/_all-skins.min','pccfKL'
    ));
    echo $this->Html->script(array('../adminlte/plugins/jQuery/jQuery-2.1.4.min','jquery-ui.min','md5','../adminlte/bootstrap/js/bootstrap.min'));
?> 
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
<body class="hold-transition login-page">
    <div class="login-logo">
        <?php echo $this->Html->image('logo.jpg',array('alt'=>''))?>
    </div>
    <div class="login-box">
        <a href="#"><span style="color:red"> <?php echo $this->Session->flash(); ?></span></a>
        <?php echo $this->fetch('content'); ?>
    </div>
</body>
</html>
