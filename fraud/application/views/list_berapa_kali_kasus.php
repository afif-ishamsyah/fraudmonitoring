
      <aside class="main-sidebar">
      <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li><a href="<?php echo site_url("home"); ?>"><i class="fa fa-home"></i><span>Home</span></a></li>
            <li><a href="<?php echo site_url("caseform"); ?>"><i class="fa fa-edit"></i><span>Input Case</span></a></li>
            <li class="active"><a href="<?php echo site_url("search"); ?>"><i class="fa fa-search"></i> <span>Search Case</span></a></li>
            <li><a href="<?php echo site_url("listprofile"); ?>"><i class="fa fa-list"></i> <span>List Profile</span></a></li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>Case Counter</h1>
        </section>

        <!-- Main content -->
        <section class="content">
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Case List (>1 Only)</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example10" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Telephone Number</th>
                        <th>Case Count (times)</th>
                        <th>Details</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php foreach($list as $details): ?>
                      <tr>
                        <td><?php echo $details->TELEPHONE_NUMBER; ?></td>
                        <td><?php echo $details->TOTAL; ?></td>
                        <td> <a href="javascript:void(0)" onclick="location.href='<?php echo site_url("recurrentdetail/$details->TELEPHONE_NUMBER"); ?>';"  type="get" class="btn btn-primary"><span>> Details</span></a></td>
                      </tr>
                       <?php endforeach; ?>
                      </tbody>
                    </table>
                    </div>
                    </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
