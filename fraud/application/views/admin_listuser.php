
      <aside class="main-sidebar">
      <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li><a href="<?php echo site_url("admin"); ?>"><i class="fa fa-home"></i><span>Home</span></a></li>
            <li><a href="<?php echo site_url("userform"); ?>"><i class="fa fa-edit"></i> <span>Create User</span></a></li>
            <li class="active"><a href="<?php echo site_url("listuser"); ?>"><i class="fa fa-search"></i> <span>List User</span></a></li>
            <li><a href="<?php echo site_url("paramform"); ?>"><i class="fa fa-plus "></i> <span>Input Parameter</span></a></li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>User List</h1>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="row">

        <?php if($this->session->flashdata('fail')): ?>
        <div class="col-md-12"><div class="alert alert-danger"><?php echo $this->session->flashdata('fail'); ?></div></div>
        <?php endif; ?>

       <?php if($this->session->flashdata('success')): ?>
        <div class="col-md-12"><div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div></div>
        <?php endif; ?>

          <div class="col-md-12">
              <div class="box box-danger">
                <div class="box-header">
                  <h3 class="box-title">List of User</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example6" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Username</th>
                        <th>Previledge</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($user as $users):?>
                      <tr>
                        <td><?php echo $users->USERNAME; ?></td>
                        <?php if( $users->PREVILEDGE=='0'): ?>
                        <td><?php echo 'USER'; ?></td>
                        <?php endif; ?>
                         <?php if( $users->PREVILEDGE=='1'): ?>
                        <td><b><?php echo 'ADMIN'; ?></b></td>
                        <?php endif; ?>
                        <td>
                          <a href="javascript:void(0)" onclick="location.href='<?php echo site_url("edituserform/$users->ID"); ?>';" type="submit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                          <a  type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#<?php echo $users->ID; ?>"><i class="fa fa-ban"></i> <span>Delete</span></a>
                        </td>
                      </tr>

                      <div class="modal fade" id="<?php echo $users->ID; ?>" role="dialog">
                        <div class="modal-dialog modal-sm">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">ATTENTION!</h4>
                            </div>
                            <div class="modal-body">
                              <p>Are you sure to <u>Delete</u> user <b><?php echo $users->USERNAME; ?></b> ?</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                              <a href="javascript:void(0)" onclick="location.href='<?php echo site_url("deleteuser/$users->ID"); ?>';" type="submit" class="btn btn-success">Yes</a>
                            </div>
                          </div>
                        </div>
                      </div>

                      <?php endforeach; ?>
                      </tbody>
                    </table>
                    </div>
                    </div>
                  </div>
              </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
