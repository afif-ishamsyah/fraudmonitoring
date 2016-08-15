
      <aside class="main-sidebar">
      <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li><a href="<?php echo site_url("home"); ?>"><i class="fa fa-home"></i><span>Home</span></a></li>
            <li><a href="<?php echo site_url("caseform"); ?>"><i class="fa fa-edit"></i><span>Input Case</span></a></li>
            <li><a href="<?php echo site_url("search"); ?>"><i class="fa fa-search"></i> <span>Search Case</span></a></li>
            <li class="active"><a href="<?php echo site_url("listprofile"); ?>"><i class="fa fa-list"></i> <span>List Profile</span></a></li>  
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>Profile List</h1>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="row">
          <div class="col-md-12">
              <div class="box box-danger">
                <div class="box-header">
                  <h3 class="box-title">List of Profile Number</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Main Number</th>
                        <th>Corporate Customer</th>
                        <th>Account Manager</th>
                        <th>Installation Adress</th>
                        <th>Segment</th>
                        <th>Average Revenue (Last 3 Month)</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($nomor as $number):?>
                      <tr>
                        <td><?php echo $number->NOTEL;?></td>
                        <td><?php echo $number->NAMACC;?></td>
                        <td><?php echo $number->NAMAAM;?></td>
                        <td><?php echo $number->ALAMAT;?></td>
                        <td><?php echo $number->SEGMEN;?></td>
                        <td><?php echo $number->AVERAGE;?></td>
                      </tr>
                      <?php endforeach; ?>
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>Main Number</th>
                        <th>Corporate Customer</th>
                        <th>Account Manager</th>
                        <th>Installation Adress</th>
                        <th>Segment</th>
                        <th>Average Revenue (Last 3 Month)</th>
                      </tr>
                    </tfoot>
                    </table>
                    <!--  <div class="col-md-12 text-center"><?php //echo $links; ?></div> -->
                    </div>
                    </div>
                  </div>
              </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
