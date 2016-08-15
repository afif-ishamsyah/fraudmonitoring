<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Monitoring Fraud</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url("/bootstrap/css/bootstrap.min.css"); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url("/dist/css/AdminLTE.min.css"); ?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url("/dist/css/skins/_all-skins.min.css"); ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url("/plugins/iCheck/flat/red.css"); ?>">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo base_url("/plugins/morris/morris.css"); ?>">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="<?php echo base_url("/plugins/timepicker/bootstrap-timepicker.min.css"); ?>">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url("/plugins/jvectormap/jquery-jvectormap-1.2.2.css"); ?>">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url("/plugins/datepicker/datepicker3.css"); ?>">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url("/plugins/daterangepicker/daterangepicker-bs3.css"); ?>">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url("/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"); ?>">

     <link rel="stylesheet" href="<?php echo base_url("/plugins/datatables/dataTables.bootstrap.css"); ?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="hold-transition skin-red sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>M</b>F</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Monitoring</b>Fraud</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url("/assets/telkom.jpg"); ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $username; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo base_url("/assets/telkom.jpg"); ?>" class="img-circle" alt="User Image">
                    <p style="font-size:24px;">
                      <?php echo $username; ?>
                      <?php if($previledge=='0'): ?>
                      <small>User</small>
                      <?php endif; ?>
                      <?php if($previledge=='1'): ?>
                      <small>Admin</small>
                      <?php endif; ?>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">   
                    <div class="pull-right">
                      <a href="javascript:void(0)" onclick="location.href='<?php echo site_url("logout"); ?>';" class="btn btn-default btn-flat">Sign out</a>
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
      <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <?php if($previledge=='1'): ?>
            <li  class="active"><a href="<?php echo site_url("home"); ?>"><i class="fa fa-home"></i><span>Home</span></a></li>
            <li><a href="<?php echo site_url("userform"); ?>"><i class="fa fa-edit"></i> <span>Create User</span></a></li>
            <li><a href="<?php echo site_url("listuser"); ?>"><i class="fa fa-search"></i> <span>List User</span></a></li>
            <li><a href="<?php echo site_url("paramform"); ?>"><i class="fa fa-plus "></i> <span>Input Parameter</span></a></li>
            <?php endif; ?>
             <?php if($previledge=='0'): ?>
             <li class="active"><a href="<?php echo site_url("home"); ?>"><i class="fa fa-home"></i><span>Home</span></a></li>
            <li><a href="<?php echo site_url("caseform"); ?>"><i class="fa fa-edit"></i><span>Input Case</span></a></li>
            <li><a href="<?php echo site_url("search"); ?>"><i class="fa fa-search"></i> <span>Search Case</span></a></li>
            <li><a href="<?php echo site_url("listprofile"); ?>"><i class="fa fa-list"></i> <span>List Profile</span></a></li>
            <?php endif; ?>
          </ul>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
    
                    
      