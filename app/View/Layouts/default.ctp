<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>PCCFKL Accounting</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<?php
    echo $this->fetch('css');
    echo $this->fetch('script');
    echo $this->Html->css(array(
        'jquery-ui','../adminlte/bootstrap/css/bootstrap.min','font-awesome.min','ionicons.min',
        '../adminlte/dist/css/AdminLTE.min','../adminlte/dist/css/skins/_all-skins.min',
        //'../adminlte/plugins/datepicker/datepicker3','../adminlte/plugins/daterangepicker/daterangepicker-bs3',
        //'../adminlte/plugins/iCheck/flat/blue','../adminlte/plugins/morris/morris','../adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2',
        //'../adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min',
        '../js/colorbox/colorbox','pccfKL','jquery-impromptu'
    ));
    echo $this->Html->script(array('../adminlte/plugins/jQuery/jQuery-2.1.4.min','jquery-ui.min','jquery-impromptu'));
?>
        <script type="text/javascript">
            $(document).ready(function(){
                $(".my_date").datepicker({
                    defaultDate: new Date(),
                    dateFormat: 'dd-mm-yy',
                    changeMonth: true,
                    changeYear: true,
                });
                $("#start_date").datepicker({
                    defaultDate: new Date(),
                    changeMonth: true,
                    numberOfMonths: 1,
                    maxDate:'0',
                    onSelect: function( selectedDate ) {
                        $( "#end_date" ).datepicker( "option", "minDate", selectedDate );
                    },
                    dateFormat: 'dd-mm-yy',
                    changeMonth: true,
                    changeYear: true
                });
                $("#end_date").datepicker({
                    defaultDate: new Date(),
                    changeMonth: true,
                    numberOfMonths: 1,
                    onSelect: function( selectedDate ) {
                        $( "#start_date" ).datepicker( "option", "maxDate", selectedDate );
                    },
                    dateFormat: 'dd-mm-yy',
                    changeMonth: true,
                    changeYear: true
                });                
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
                $(".iframe").colorbox({ iframe:true,fixed:true, width:"900px", height:"600px" });
                $(".iframeD").colorbox({ iframe:true,fixed:true, width:"700px", height:"500px" });
                $(".iframeLarge").colorbox({ iframe:true,fixed:true, width:"90%", height:"90%" });                
            });
            $.widget.bridge('uibutton', $.ui.button);
        </script> 
        <style type="text/css" media="screen">
            .error {
                color: red;
            }
            .success {
                color: green;
            }
        </style>             
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
<?php echo $this->Element('header'); ?>
<?php echo $this->Element('sidebar'); ?>
            <div class="content-wrapper">
<?php echo $this->Element('content_header'); ?>
                <section class="content">
<?php echo $this->Element('header_info'); ?>
                    <div class="row">
                        <section>
<?php echo $this->Session->flash();?>
                            <section class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box box-primary">
                                            <div id="lodding_image" style="margin:auto;position:fixed;width:100%;top:50%;z-index:200;left:50%;display: none;">
                                                <?php echo $this->Html->image('loading.gif') ?>
                                            </div> 
                                            <div class="box-header with-border">
                                                <h3 class="box-title"><?php echo $title; ?></h3>
                                            </div>                                                                                       
<?php echo $this->fetch('content'); ?>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </section>
                    </div>
                </section>
            </div>
        </div>
<?php
    echo $this->Html->script(array(
        '../adminlte/bootstrap/js/bootstrap.min',
        'raphael-min','../adminlte/plugins/morris/morris.min',
        '../adminlte/plugins/sparkline/jquery.sparkline.min',
        '../adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min',
        '../adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en',
        '../adminlte/plugins/knob/jquery.knob',
        'moment.min',
        //'../adminlte/plugins/daterangepicker/daterangepicker','../adminlte/plugins/datepicker/bootstrap-datepicker',
        //'../adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min',
        '../adminlte/plugins/slimScroll/jquery.slimscroll.min',
        '../adminlte/plugins/fastclick/fastclick.min',
        '../adminlte/dist/js/app.min',
        '../adminlte/dist/js/pages/dashboard','../adminlte/dist/js/demo',
        'colorbox/jquery.colorbox'
    )); 
?>        
    </body>
</html>