<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mahavir::Student Management System</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css(array('bootstrap.min','font-awesome.min','animate','style','datepicker'));
		echo $this->Html->script(array('jquery-2.1.1','bootstrap.min','plugins/metisMenu/jquery.metisMenu','plugins/slimscroll/jquery.slimscroll.min','inspinia','plugins/pace/pace.min','md5','datepicker','jquery.print'));
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('keypress','.alpha',function (event){
                var regex = new RegExp("^[a-zA-z ]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if(event.which == 8 || event.keyCode == 9 || event.keyCode == 46 || event.keyCode == 37 || event.keyCode == 38 || event.keyCode == 39 || event.keyCode == 40){
                    return true;
                }
                if (!regex.test(key)) {
                   event.preventDefault();
                   return false;
                }
            });
            $(document).on('keypress','.alphanumeric',function (event){
                var regex = new RegExp("^[a-zA-z0-9 ]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if(event.which == 8 || event.keyCode == 9 || event.keyCode == 46 || event.keyCode == 37 || event.keyCode == 38 || event.keyCode == 39 || event.keyCode == 40){
                    return true;
                }
                if (!regex.test(key)) {
                   event.preventDefault();
                   return false;
                }
            });             
            $(document).on('keypress','.numeric',function (event){
                var regex = new RegExp("^[0-9.]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if(event.which == 8 || event.keyCode == 9 || event.keyCode == 46 || event.keyCode == 37 || event.keyCode == 38 || event.keyCode == 39 || event.keyCode == 40){
                    return true;
                }
                if(event.which == 46 && $(this).val().indexOf('.') != -1) {
                    event.preventDefault();
                    return false;
                }
                if (!regex.test(key)) {
                   event.preventDefault();
                   return false;
                }
            }); 
            $(document).on('keypress','.mobile',function (event){
                var regex = new RegExp("^[0-9]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if(event.which == 8 || event.keyCode == 9 || event.keyCode == 46 || event.keyCode == 37 || event.keyCode == 38 || event.keyCode == 39 || event.keyCode == 40){
                    return true;
                }
                if (!regex.test(key)) {
                   event.preventDefault();
                   return false;
                }
            });
            $(document).on('keypress','.phone',function (event){
                var regex = new RegExp("^[0-9-]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if(event.which == 8 || event.keyCode == 9 || event.keyCode == 46 || event.keyCode == 37 || event.keyCode == 38 || event.keyCode == 39 || event.keyCode == 40){
                    return true;
                }
                if(event.which == 45 && $(this).val().indexOf('-') != -1) {
                    event.preventDefault();
                    return false;
                }
                if (!regex.test(key)) {
                   event.preventDefault();
                   return false;
                }
            });
            
            $('.my_date').datepicker({
                changeMonth: true,
                changeYear: true,                   
                format: "dd-mm-yyyy",
                autoclose:true,

            });
            $('.frm_today_date').datepicker({
                changeMonth: true,
                changeYear: true,                   
                format: "dd-mm-yyyy",
                autoclose:true,
                startDate: new Date(),
                endDate: new Date(),
            });
            $('.cls_frm_date').datepicker({
                changeMonth: true,
                changeYear: true,                   
                format: "dd-mm-yyyy",
                autoclose:true,
                startDate: new Date(),                    
            });            
            $('.cls_till_today_date').datepicker({
                changeMonth: true,
                changeYear: true,                   
                format: "dd-mm-yyyy",
                autoclose:true,
                endDate: new Date(),              
            });
            $('.cls_till_yesterday_date').datepicker({
                changeMonth: true,
                changeYear: true,                   
                format: "dd-mm-yyyy",
                autoclose:true,
                endDate: '-1d'              
            });
            $('.cls_date_of_birth').datepicker({
                changeMonth: true,
                changeYear: true,                   
                format: "dd-mm-yyyy",
                autoclose:true,
                endDate: '-14y'              
            }); 
			 $("#flashMessage").fadeOut(7000);
        });
        function startTime() {
            var today = new Date();
            var day = today.getDate();
            var mon = today.getMonth();
            var year = today.getFullYear();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            var check = '';
            m = checkTime(m);
            s = checkTime(s);
            mon = checkTime(mon);
            if (h > 11) { 
                check = 'PM'; 
            }else{ 
                check = 'AM'; 
            }
            document.getElementById('txt').innerHTML =
            day + "/"+ mon +"/" + year +" " +" " + h + ":" + m + ":" + s + " "+ check;
            var t = setTimeout(startTime, 500);
        }
        function checkTime(i) {
            if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
            return i;
        }
        //function for showing the loading gif
        function loadingPage(load_id){
            $('#'+load_id).html("<div class='ibox-content'><div class='spiner-example'><div class='sk-spinner sk-spinner-wave'><div class='sk-rect1'></div><div class='sk-rect2'></div><div class='sk-rect3'></div><div class='sk-rect4'></div><div class='sk-rect5'></div></div></div></div>");
        }
        //function for showing the loading at botton
        function loadingBotton(load_bot_id){
            $('#'+load_bot_id).html("<div class='sk-spinner sk-spinner-wave'><div class='sk-rect1'></div><div class='sk-rect2'></div><div class='sk-rect3'></div><div class='sk-rect4'></div><div class='sk-rect5'></div></div>");
        }
    </script>    
</head>
<body class="fixed-sidebar"  onload="startTime()">
	<div id="wrapper">
<!-- Menu Start -->
        <?php echo $this->element('admin_menu'); ?>
<!-- Menu End -->
        <div id="page-wrapper" class="gray-bg">
<!-- Header Start -->
        <?php echo $this->element('admin_header'); ?>
<!-- Header End -->
        <!-- Content Start here -->
        <!--
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Welcome to Admin</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="#">Home</a>
                    </li>
                    <li class="active">
                        <strong>Layouts</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">
               
            </div>
        </div>
        -->
        <div class="wrapper wrapper-content animated fadeInRight">
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->fetch('content'); ?>            
        </div>
        <!-- Content End here -->
        <!-- Footer Start -->
        <?php echo $this->element('footer'); ?>
        <!-- Footer End -->
    </div>
</div>
</body>
</html>