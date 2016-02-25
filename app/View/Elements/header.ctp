<header class="main-header">
    <a href="index2.html" class="logo">
        <span class="logo-mini"><b>PCCF</b> KL</span><span class="logo-lg"><b>PCCF</b> KL</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i><span class="label label-success">4</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 4 messages</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
                                    <!-- start message -->
                                    <a href="#">
                                        <h4>Chandaka RO<small><i class="fa fa-clock-o"></i>01/01/2016</small></h4>
                                        <p>New Voucher entered</p>
                                    </a>
                                </li>
                                <!-- end message -->
                                <li>
                                    <a href="#">
                                        <h4>PCCF<small><i class="fa fa-clock-o"></i> 01/01/2016</small></h4>
                                        <p>New User Created</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <h4>Khurda DFO<small><i class="fa fa-clock-o"></i> 02/01/2016</small></h4>
                                        <p>Voucher Verifications completed</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <h4>PCCF<small><i class="fa fa-clock-o"></i> 05/01/2016</small></h4>
                                        <p>New DFO information added</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">See All Messages</a></li>
                    </ul>
                </li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs">Welcome <b><?php echo $this->Session->read('title'); ?></b></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="<?php echo $this->webroot; ?>users/logout" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>