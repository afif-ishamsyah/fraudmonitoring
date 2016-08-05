
    <aside class="main-sidebar">
      <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li><a href="<?php echo site_url("user"); ?>"><i class="fa fa-home"></i><span>Home</span></a></li>
            <li><a href="<?php echo site_url("caseform"); ?>"><i class="fa fa-edit"></i><span>Input Case</span></a></li>
            <li><a href="<?php echo site_url("search"); ?>"><i class="fa fa-search"></i> <span>Search Case</span></a></li>
            <li><a href="<?php echo site_url("listprofile"); ?>"><i class="fa fa-list"></i> <span>List Profile</span></a></li>  
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>Edit Profile</h1>
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
        <div class="box-header with-border">
              <h3 class="box-title">Check Number</h3>
        </div>
        <div class="box-body">
        <form class="form-horizontal" role="form" action="<?php echo site_url("checkprofile"); ?>" method="post"> 
            <div class="form-group">
              <label class="control-label col-sm-2" for="notelepon">Telephone Number:</label>
              <div class="col-sm-10">
                <input class="form-control" name="telnumber" id="telnumber" value="<?php echo $nomor->TELEPHONE_NUMBER;?>" disabled>
                <input class="form-control" type="hidden" name="idcase" id="idcase" value="<?php echo $nomor->ID_CASE;?>">
              </div>
            </div>

             <div class="form-group">
              <label class="control-label col-sm-2" for="destnumber">Main Number:</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" name="mainnumber" id="destnumber" value="<?php echo $nomor->MAIN_NUMBER;?>" required>
              </div>
            </div>
            
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

          </div>

            <div class="box-footer">
              <div class="form-group">
                <div class="pull-right">
                  <a href="<?php echo site_url("cases/$nomor->ID_CASE"); ?>" type="button" class="btn btn-danger" >Cancel</a>
                  <button type="submit" class="btn btn-primary">Check</button>
                </div>
              </div>
              </form>
            </div>


            </div>
            </div>

        <?php if($this->session->flashdata('fail') || $this->session->flashdata('success')): ?>

          <div class="col-md-12">
            <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Profile</h3>
            </div>
            <div class="box-body">
            <form class="form-horizontal" role="form" action="<?php echo site_url("editingprofileprocess"); ?>" method="post"> 
                
                <div class="form-group">
                  <label class="control-label col-sm-2" for="notelepon">Telephone Number:</label>
                  <div class="col-sm-10">
                    <input class="form-control" name="telnumber" id="telnumber" value="<?php echo $nomor->TELEPHONE_NUMBER;?>" disabled>
                    <input class="form-control" type="hidden" name="idcase" id="idcase" value="<?php echo $nomor->ID_CASE;?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-2" for="notelepon">Main Number:</label>
                  <div class="col-sm-10">
                    <input class="form-control" name="mainnumber" id="telnumber" value="<?php echo $nomor->MAIN_NUMBER;?>" disabled>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-2" for="destnumber">NIK AM:</label>
                  <div class="col-sm-10">
                    <input class="form-control" name="nikam" id="destnumber" value="<?php echo $nomor->NIKAM;?>" type="number" required>
                  </div>
                </div>

                 <div class="form-group">
                  <label class="control-label col-sm-2" for="destnumber">Account Manager:</label>
                  <div class="col-sm-10">
                    <input class="form-control" name="am" id="destnumber" value="<?php echo $nomor->AM;?>" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-2" for="destnumber">NIP NAS:</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" name="nipnas" id="destnumber" value="<?php echo $nomor->NIPNAS;?>" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-2" for="destnumber">Corporate Customer:</label>
                  <div class="col-sm-10">
                    <input class="form-control" name="customer" id="destnumber" value="<?php echo $nomor->CUSTOMER;?>" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-2" for="destnumber">Installation Address:</label>
                  <div class="col-sm-10">
                    <input class="form-control" name="alamat" id="destnumber" value="<?php echo $nomor->INSTALLATION;?>" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-2" for="destnumber">Segment:</label>
                  <div class="col-sm-10">
                    <input pattern=".{3,3}" class="form-control" name="segmen" id="destnumber" value="<?php echo $nomor->SEGMEN;?>" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-2" for="destnumber">Average Revenue:</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" name="revenue" id="destnumber" value="<?php echo $nomor->REVENUE;?>" required>
                  </div>
                </div>

                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              </div>

                <div class="box-footer">
                  <div class="form-group">
                    <div class="pull-right">
                      <a href="<?php echo site_url("cases/$nomor->ID_CASE"); ?>" type="button" class="btn btn-danger" >Back</a>
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Update</button>
                    </div>
                  </div>
                </div>
                </div>
                </div>

        <?php endif; ?>

          <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">ATTENTION!</h4>
                  </div>
                  <div class="modal-body">
                    <p>Are you sure to edit this profile?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>

          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

    