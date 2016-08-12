 <aside class="main-sidebar">
      <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li><a href="<?php echo site_url("admin"); ?>"><i class="fa fa-home"></i><span>Home</span></a></li>
            <li><a href="<?php echo site_url("userform"); ?>"><i class="fa fa-edit"></i> <span>Create User</span></a></li>
            <li><a href="<?php echo site_url("listuser"); ?>"><i class="fa fa-search"></i> <span>List User</span></a></li>
            <li class="active"><a href="<?php echo site_url("paramform"); ?>"><i class="fa fa-plus "></i> <span>Input Parameter</span></a></li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>Input Parameter</h1>
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
        
        <div class="col-md-6">
        <div class="box box-danger">
          <div class="box-header">
            <div class="box-title">Create Case Parameter</div>
          </div>
          
          <div class="box-body">
          <form class="form-horizontal" role="form" action="<?php echo site_url("addcaseparam"); ?>" method="post">
            <div class="form-group" style="margin-bottom:113px;">
              <label class="control-label col-sm-2" for="namaparameter">Name:</label>
              <div class="col-sm-9">
                <input class="form-control" name="parameter" pattern=".{1,15}" id="namaparameter" placeholder="Masukkan Nama Parameter" pattern=".{1,30}" required>
              </div>
            </div>

            </div>
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

            <div class="box-footer">
              <div class="form-group">
              <div class=" pull-right">
                <button type="submit" class="btn btn-primary">Create Case Parameter</button>
              </div>
            </div>
            </form>
            </div>

            </div>
          </div>

          <div class="col-md-6">
          <div class="box box-danger">
          
          <div class="box-header">
            <div class="box-title">Create Activity Parameter</div>
          </div>
          
          <div class="box-body">
          <form class="form-horizontal" role="form" action="<?php echo site_url("addactparam"); ?>" method="post">
            <div class="form-group">
              <label class="control-label col-sm-2" for="namaparameter">Name:</label>
              <div class="col-sm-9">
                <input class="form-control" name="parameter" id="namaparameter" pattern=".{1,15}" placeholder="Masukkan Nama Parameter" pattern=".{1,30}" required>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="namaparameter">Code:</label>
              <div class="col-sm-9">
                <input class="form-control" name="akronim" id="namaparameter" placeholder="Masukkan Kode Parameter (3 Karakter Kapital)" pattern=".{3,3}" required>
              </div>
            </div>

              <div class="form-group">
                <label  class="control-label col-sm-2" for="tipe">Type:</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="status" id="tipeparam" required>
                      <option value='0'>Open</option>
                      <option value='1'>Close</option>
                    </select>
                  </div>
              </div>
            </div>
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

            <div class="box-footer">
              <div class="form-group">
              <div class="pull-right">
                <button type="submit" class="btn btn-primary">Create Activity Parameter</button>
              </div>
            </div>
            </form>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="box box-danger">
          <div class="box-header">
            <div class="box-title">List Case Parameter</div>
          </div>

          <div class="box-body">
            <table id="example4" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($caseparam as $casepar): ?>
                      <tr>
                        <td><?php echo $casepar->DESCRIPTION; ?></td>
                        <?php if($casepar->AKTIF=='0'): ?>
                        <td><font color="red"><b>Disabled</b></font></td> 
                        <td><a  type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#<?php echo $casepar->ID_PARAMETER; ?>deaktif"><i class="fa fa-check"></i> <span>Enable</span></a>
                        <?php endif; ?>
                        <?php if($casepar->AKTIF=='1'): ?>
                         <td><font color="green"><b>Enabled</b></font></td> 
                         <td><a  type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#<?php echo $casepar->ID_PARAMETER; ?>aktif"><i class="fa fa-ban"></i> <span>Disable</span></a>
                        <?php endif; ?>
                            <a  type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#<?php echo $casepar->ID_PARAMETER; ?>edit"><i class="fa fa-edit"></i> <span>Edit</span></a>
                        </td>
                      </tr>

                      <div class="modal fade" id="<?php echo $casepar->ID_PARAMETER; ?>aktif" role="dialog">
                        <div class="modal-dialog modal-sm">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">ATTENTION!</h4>
                            </div>
                            <div class="modal-body">
                              <p>Are you sure to <u>Disable</u> activity parameter  <b><?php echo $casepar->DESCRIPTION; ?></b> ?</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                              <a href="javascript:void(0)" onclick="location.href='<?php echo site_url("changecaseparam/$casepar->ID_PARAMETER"); ?>';" type="submit" class="btn btn-success">Yes</a>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="modal fade" id="<?php echo $casepar->ID_PARAMETER; ?>deaktif" role="dialog">
                        <div class="modal-dialog modal-sm">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">ATTENTION!</h4>
                            </div>
                            <div class="modal-body">
                              <p>Are you sure to <u>Enable</u> activity parameter  <b><?php echo $casepar->DESCRIPTION; ?></b> ?</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                              <a href="javascript:void(0)" onclick="location.href='<?php echo site_url("changecaseparam/$casepar->ID_PARAMETER"); ?>';" type="submit" class="btn btn-success">Yes</a>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="modal fade" id="<?php echo $casepar->ID_PARAMETER; ?>edit" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Edit Parameter <b><?php echo $casepar->DESCRIPTION; ?></b></h4>
                              </div>
                              <div class="modal-body">
                               <form class="form-horizontal" role="form" action="<?php echo site_url("editcaseparam"); ?>" method="post" enctype="multipart/form-data"> 
                                  <div class="form-group">
                                      <label class="control-label">Case Name:</label>
                                      <input type="text" name="casename" pattern=".{1,15}" class="form-control" value="<?php echo $casepar->DESCRIPTION;?>" required>
                                      <input class="form-control" type="hidden" name="idcase" id="idcase" value="<?php echo $casepar->ID_PARAMETER; ?>">
                                      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                  </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Edit</button>
                              </div>
                            </div>
                            </form>
                          </div>
                        </div>

                        <?php endforeach; ?>
                      </tbody>
                  </table>
                  </div>
            </div>
          </div>

        <div class="col-md-6">
          <div class="box box-danger">
          <div class="box-header">
            <div class="box-title">List Activity Parameter</div>
          </div>
          <div class="box-body">
            <table id="example5" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($actparam as $actpar): ?>                     
                      <tr>
                        <td><?php echo $actpar->DESCRIPTION; ?></td>
                        <td><?php echo $actpar->AKRONIM; ?></td>
                        <?php if($actpar->STATUS=='0'): ?>
                        <td>Open</td>
                        <?php endif; ?>
                        <?php if($actpar->STATUS=='1'): ?>
                        <td><b>Close</b></td>
                        <?php endif; ?>
                        <?php if($actpar->AKTIF=='0'): ?>
                        <td><font color="red"><b>Disabled</b></font></td> 
                        <td>
                                <a  type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#act<?php echo $actpar->ID_PARAMETER; ?>aktif"><i class="fa fa-check"></i> <span>Enable</span></a>
                        <?php endif; ?>
                        <?php if($actpar->AKTIF=='1'): ?>
                        <td><font color="green"><b>Enabled</b></font></td> 
                        <td>      
                                <a  type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#act<?php echo $actpar->ID_PARAMETER; ?>deaktif"><i class="fa fa-ban"></i> <span>Disable</span></a>
                        <?php endif; ?> 
                                <a  type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#act<?php echo $actpar->ID_PARAMETER; ?>edit"><i class="fa fa-edit"></i> <span>Edit</span></a>
                        </td>
                      </tr>
                      <div class="modal fade" id="act<?php echo $actpar->ID_PARAMETER; ?>aktif" role="dialog">
                        <div class="modal-dialog modal-sm">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">ATTENTION!</h4>
                            </div>
                            <div class="modal-body">
                              <p>Are you sure to <u>Enable</u> activity parameter  <b><?php echo $actpar->DESCRIPTION; ?></b> ?</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                              <a href="javascript:void(0)" onclick="location.href='<?php echo site_url("changeactparam/$actpar->ID_PARAMETER"); ?>';" type="submit" class="btn btn-success">Yes</a>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="modal fade" id="act<?php echo $actpar->ID_PARAMETER; ?>deaktif" role="dialog">
                        <div class="modal-dialog modal-sm">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">ATTENTION!</h4>
                            </div>
                            <div class="modal-body">
                              <p>Are you sure to <u>Disable</u> activity parameter  <b><?php echo $actpar->DESCRIPTION; ?></b> ?</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                              <a href="javascript:void(0)" onclick="location.href='<?php echo site_url("changeactparam/$actpar->ID_PARAMETER"); ?>';" type="submit" class="btn btn-success">Yes</a>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="modal fade" id="act<?php echo $actpar->ID_PARAMETER; ?>edit" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Edit Parameter <b><?php echo $actpar->DESCRIPTION; ?></b></h4>
                            </div>
                            <div class="modal-body">
                              <form class="form-horizontal" role="form" action="<?php echo site_url("editactparam"); ?>" method="post" enctype="multipart/form-data">
                              <div class="form-group">
                                <label class="control-label" for="frekueni">Activity Name:</label>
                                  <input type="text" class="form-control" name="actname" pattern=".{1,15}" id="actname" value="<?php echo $actpar->DESCRIPTION; ?>" required>
                                  <input class="form-control" type="hidden" name="idcase" id="idcase" value="<?php echo $actpar->ID_PARAMETER; ?>">
                                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                              </div>
                              <div class="form-group">
                                <label class="control-label" for="frekueni">Activity Code:</label>
                                  <input type="text" class="form-control" name="actcode" id="actcode" pattern=".{3,3}" value="<?php echo $actpar->AKRONIM; ?>" required>                              
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                              <button href="" type="submit" class="btn btn-primary">Edit</button>
                            </div>
                          </div>
                        </form>
                        </div>
                      </div>

                      <?php endforeach; ?>
                      </tbody>
                  </table>
          </div>
          </div>
        </div>  

       <!--  <div class="modal fade" id="myModal2" role="dialog">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">ATTENTION!</h4>
                  </div>
                  <div class="modal-body">
                    <p>Are you sure to change this parameter?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <a type="submit" class="btn btn-success">Yes</a>
                  </div>
                </div>
              </div>
            </div> -->

        </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();   
      });
     </script>