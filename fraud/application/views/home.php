<!-- Left side column. contains the logo and sidebar -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>Home</h1>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="row">
            <div class="col-md-6">
             <!-- DONUT CHART -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Case Status</h3>
                   <div class="box-tools pull-right">
                  <a href="javascript:void(0)" onclick="location.href='<?php echo site_url('agelist'); ?>';" type="button" class="btn btn-primary"><span>Details</span></a>
                  </div>
                </div>

                <div class="box-body chart-responsive">
                  <div class="chart" id="sales-chart" style="height: 250px; position: relative;"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              </div>
            
            <div class="col-md-6">
              <!-- Donut chart -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Case Type Percentage</h3>
                </div>
                <div class="box-body">
                  <div id="donut-chart" style="height: 250px;"></div>
                </div><!-- /.box-body-->
              </div><!-- /.box -->
              </div>

              <div class="col-md-12">
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Case Statistic per Year</h3>
                  <div class="box-tools pull-right">
                  <form class="form-horizontal" role="form" action="<?php echo site_url('monthlist'); ?>" method="post">
                     <input class="form-control" type="hidden" name="year" id="idcase" value="<?php echo date("Y"); ?>">
                      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                      <button type="submit" class="btn btn-primary">Details</button>
                    </form>
                  </div>
                </div>
                <div class="box-body chart-responsive">
                  <div class="chart" id="bar-chart" style="height: 300px;"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              </div>
              </div>
          </section><!-- /.content -->
        </div><!-- /.content-wrapper -->

        <!-- <footer class="main-footer">
          <div class="pull-right hidden-xs">
            <b>Version</b> 2.3.0
          </div>
          <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
        </footer> -->