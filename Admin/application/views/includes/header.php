<?php error_reporting(0) ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Firearms Network</title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/ms-icon-310x310.png" type="image/x-icon"/>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- DataTable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
    <!-- DataTable -->

    <link href="<?php echo base_url(); ?>assets/css/toastr.css" rel="stylesheet" type="text/css">
    <style>
    	.error{
    		color:red;
    		font-weight: normal;
    	}
    </style>
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>
    <script type="text/javascript">
        var baseURL = "<?php echo base_url(); ?>";
    </script>
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.carousel.min.css">
    <!-- Owl Carousel -->
        
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url(); ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>FN</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Firearms Network</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown tasks-menu">
                <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                  <i class="fa fa-history"></i>
                </a> -->
                <ul class="dropdown-menu">
                  <li class="header"> Last Login : <i class="fa fa-clock-o"></i> <?= empty($last_login) ? "First Time Login" : $last_login; ?></li>
                </ul>
              </li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url(); ?>assets/dist/img/avatar.png" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?php echo $name; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo base_url(); ?>assets/dist/img/avatar.png" class="img-circle" alt="User Image" />
                    <p>
                      <?php echo $name; ?>
                      <small><?php echo $role_text; ?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo base_url(); ?>loadChangePass" class="btn btn-default btn-flat"><i class="fa fa-key"></i> Change Password</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url(); ?>logout" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
              <a href="<?php echo base_url(); ?>dashboard">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url(); ?>list-settings" >
                <i class="fa fa-cogs"></i>
                <span>System Settings</span>
              </a> 
            </li>
            <li class="treeview">
              <a href="<?php echo base_url(); ?>allListings" >
                <i class="fa fa-list"></i>
                <span>List</span>
              </a> 
                 <ul>
                   <li>
                     <a href="<?php echo base_url(); ?>allListings" >
                      <i class="fa fa-list"></i>
                      <span>Auction</span>
                    </a>
                   </li>
                   <li>
                     <a href="<?php echo base_url(); ?>allFixed" >
                      <i class="fa fa-plus-square-o"></i>
                      <span>Fixed</span>
                    </a>
                   </li>
                 </ul>

            </li>
            <li class="treeview">
              <a href="<?php echo base_url(); ?>userListing" >
                <i class="fa fa-users"></i>
                <span>Users</span>
              </a>
            </li>
           
            <li class="treeview">
              <a href="<?php echo base_url(); ?>allBids" >
                <i class="fa fa-hand-o-up"></i>
                <span>Bids</span>
              </a>
            </li>

            <li class="treeview">
               <a href="<?php echo base_url(); ?>allcontacts" >
                <i class="fa fa-phone"></i>
                 <span>Contacts</span>
                 </a>
                 </li>

            <li class="treeview">
              <a href="#" >
                <i class="fa fa-list-ul"></i>
                <span>Categories</span>
                <ul>
                  <li>
                    <a href="<?php echo base_url(); ?>manageCategories" >
                      <i class="fa fa-list-ul"></i>
                      <span>Categories</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?php echo base_url(); ?>Categories" >
                      <i class="fa fa-plus-square-o"></i>
                      <span>Add Category</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?php echo base_url(); ?>allmanufacturers" >
                      <i class="fa fa-list-ul"></i>
                      <span>Manufacturers</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?php echo base_url(); ?>addmanufacturer" >
                      <i class="fa fa-plus-square-o"></i>
                      <span>Add Manufacturer</span>
                    </a>
                  </li>
                </ul>
              </a>
            </li>
           
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
      <input type="hidden" value="<?php echo base_url();?>" id="base_url">