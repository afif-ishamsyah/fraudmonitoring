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

<body class="hold-transition skin-red sidebar-mini" style="background-image: url('<?php echo base_url("/assets/Background.png"); ?>'); background-size: 100% 100%;"> 
 <img src="<?php echo base_url("/assets/mantab.png"); ?>" style="display: block;
    margin-left: auto;
    margin-right: auto;
    height:30%; width: 30%;">

    <div class="box box-danger" style="width: 34%; margin: 0 auto;">
                <div class="box-header with-border">
                  <h3 class="box-title">LOGIN</h3>
                </div><!-- /.box-header -->
                <form class="form-horizontal" method="POST" action="<?php echo site_url("login"); ?>" enctype="multipart/form-data">
                  <div class="box-body">

                  <?php if($this->session->flashdata('fail')): ?>
                  <div class="col-md-12"><div class="alert alert-danger"><?php echo $this->session->flashdata('fail'); ?></div></div>
                  <?php endif; ?>

                    <div class="form-group">
                      <label for="inputuser" class="col-sm-3 control-label">Username:</label>
                      <div class="col-sm-8">
                        <input type="text" name="username" class="form-control" id="username" placeholder="Username" pattern=".{1,30}" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputpass" class="col-sm-3 control-label">Password:</label>
                      <div class="col-sm-8">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" pattern=".{1,25}" required>
                      </div>
                    </div>
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-danger pull-right">Sign in</button>
                  </div><!-- /.box-footer -->
                </form>
    </div>

      <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url("/plugins/jQuery/jQuery-2.1.4.min.js"); ?>"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url("/bootstrap/js/bootstrap.min.js"); ?>"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url("/plugins/datatables/jquery.dataTables.min.js"); ?>"></script>
    <script src="<?php echo base_url("/plugins/datatables/dataTables.bootstrap.min.js"); ?>"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url("/plugins/select2/select2.full.min.js"); ?>"></script>
    <!-- InputMask -->
    <script src="<?php echo base_url("/plugins/input-mask/jquery.inputmask.js"); ?>"></script>
    <script src="<?php echo base_url("/plugins/input-mask/jquery.inputmask.date.extensions.js"); ?>"></script>
    <script src="<?php echo base_url("/plugins/input-mask/jquery.inputmask.extensions.js"); ?>"></script>
    <!-- date-range-picker -->
    <script src="<?php echo base_url("/https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"); ?>"></script>
    <script src="<?php echo base_url("/plugins/daterangepicker/daterangepicker.js"); ?>"></script>
    <!-- bootstrap color picker -->
    <script src="<?php echo base_url("/plugins/colorpicker/bootstrap-colorpicker.min.js"); ?>"></script>
    <!-- bootstrap time picker -->
    <script src="<?php echo base_url("/plugins/timepicker/bootstrap-timepicker.min.js"); ?>"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?php echo base_url("/plugins/slimScroll/jquery.slimscroll.min.js"); ?>"></script>
    <!-- iCheck 1.0.1 -->
    <script src="<?php echo base_url("/plugins/iCheck/icheck.min.js"); ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url("/plugins/fastclick/fastclick.min.js"); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url("/dist/js/app.min.js"); ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url("/dist/js/demo.js"); ?>"></script>
</body>
</html>