
      <!-- Left side column. contains the logo and sidebar -->
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
                  <h3 class="box-title">Case List : <?php echo $nomor; ?></h3>
                  <div class="pull-right">
                 <a href="javascript:void(0)" onclick="location.href='<?php echo site_url("recurrent"); ?>';" type="get" class="btn btn-danger"><span>Back</span></a>
                 </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example11" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Telephone Number</th>
                        <th>Destination Number</th>
                        <th>Destination Country</th>
                        <th>Case Date</th>
                        <th>Finished Date</th>
                        <th>Description</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list as $details): ?>
                      <tr>
                        <td><?php echo $details->TELEPHONE_NUMBER; ?></td>
                        <td><?php echo $details->DESTINATION_NUMBER; ?></td>
                        <td><?php echo $details->DESTINATION; ?></td>
                        <td><?php echo $details->CASE_TIME; ?></td>
                        <td><?php echo $details->FINISH_DATE; ?></td>
                        <td><?php echo $details->DESCRIPTION; ?></td>
                       <?php if($details->STATUS=='0'): ?>
                        <td><font color="red"><b>Open Case</b></font></td>
                        <?php endif; ?>
                        <?php if($details->STATUS=='1'): ?>
                        <td><font color="green"><b>Closed Case</b></font></td>
                        <?php endif; ?>
                      </tr>
                    <?php endforeach; ?>
                      </tbody>
                    </table>
                    </div>
                    </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

   