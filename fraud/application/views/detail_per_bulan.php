
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>Case Statistic per Month</h1>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="row">

              <div class="col-md-12">
              <div class="box box-success">
               <form class="form-horizontal" role="form" action="<?php echo site_url('monthlist'); ?>" method="post">
                <div class="box-header with-border">
                  <h1 class="box-title"><b><?php echo $tahun;?></b></h1>
                  <div class="box-tools pull-right">
                    <div class="form-group">
                     <label for="Tahun" class="col-sm-3 control-label">Tahun:</label>
                     <div class="col-sm-5">
                      <select class="form-control input-sm" id="Tahun" name="year">
                        <option value="<?php echo $tahun1 ;?>"><?php echo $tahun1 ;?></option>
                        <option value="<?php echo $tahun2 ;?>"><?php echo $tahun2 ;?></option>
                        <option value="<?php echo $tahun3 ;?>"><?php echo $tahun3 ;?></option>
                        <option value="<?php echo $tahun4 ;?>"><?php echo $tahun4 ;?></option>
                        <option value="<?php echo $tahun5 ;?>"><?php echo $tahun5 ;?></option>
                      </select>
                      </div>
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                      <div class="col-sm-2">
                      <button type="submit" class="btn btn-primary btn-sm">Search</button>
                      </div>
                    </div>
                  </div>
                </div>
                </form>
                <div class="box-body chart-responsive">
                  <div class="chart" id="bar-chart2" style="height: 300px;"></div>
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
        <div class="control-sidebar-bg"></div>
     </div>


    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>

    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url("/bootstrap/js/bootstrap.min.js"); ?>"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url("/plugins/select2/select2.full.min.js"); ?>"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="<?php echo base_url("/plugins/morris/morris.min.js"); ?>"></script>
    <!-- InputMask -->
    <script src="<?php echo base_url("/plugins/input-mask/jquery.inputmask.js"); ?>"></script>
    <script src="<?php echo base_url("/plugins/input-mask/jquery.inputmask.date.extensions.js"); ?>"></script>
    <script src="<?php echo base_url("/plugins/input-mask/jquery.inputmask.extensions.js"); ?>"></script>
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
   
    <!-- SlimScroll 1.3.0 -->
    <script src="<?php echo base_url("/plugins/slimScroll/jquery.slimscroll.min.js"); ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url("/plugins/fastclick/fastclick.min.js"); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url("/dist/js/app.min.js"); ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url("/dist/js/demo.js"); ?>"></script>

    <script>
     $(function () {

        var bar = new Morris.Bar({
          element: 'bar-chart2',
          resize: true,
          data: [
            {y: '<?php echo date('M', mktime(0, 0, 0, $bulan1));?>', a: <?php echo $monthopen1;?>, b: <?php echo $monthclose1;?>},
            {y: '<?php echo date('M', mktime(0, 0, 0, $bulan2));?>', a: <?php echo $monthopen2;?>, b: <?php echo $monthclose2;?>},
            {y: '<?php echo date('M', mktime(0, 0, 0, $bulan3));?>', a: <?php echo $monthopen3;?>, b: <?php echo $monthclose3;?>},
            {y: '<?php echo date('M', mktime(0, 0, 0, $bulan4));?>', a: <?php echo $monthopen4;?>, b: <?php echo $monthclose4;?>},
            {y: '<?php echo date('M', mktime(0, 0, 0, $bulan5));?>', a: <?php echo $monthopen5;?>, b: <?php echo $monthclose5;?>},
            {y: '<?php echo date('M', mktime(0, 0, 0, $bulan6));?>', a: <?php echo $monthopen6;?>, b: <?php echo $monthclose6;?>},
            {y: '<?php echo date('M', mktime(0, 0, 0, $bulan7));?>', a: <?php echo $monthopen7;?>, b: <?php echo $monthclose7;?>},
            {y: '<?php echo date('M', mktime(0, 0, 0, $bulan8));?>', a: <?php echo $monthopen8;?>, b: <?php echo $monthclose8;?>},
            {y: '<?php echo date('M', mktime(0, 0, 0, $bulan9));?>', a: <?php echo $monthopen9;?>, b: <?php echo $monthclose9;?>},
            {y: '<?php echo date('M', mktime(0, 0, 0, $bulan10));?>', a: <?php echo $monthopen10;?>, b: <?php echo $monthclose10;?>},
            {y: '<?php echo date('M', mktime(0, 0, 0, $bulan11));?>', a: <?php echo $monthopen11;?>, b: <?php echo $monthclose11;?>},
            {y: '<?php echo date('M', mktime(0, 0, 0, $bulan12));?>', a: <?php echo $monthopen12;?>, b: <?php echo $monthclose12;?>}
          ],
          barColors: ['#f56954','#00a65a'],
          xkey: 'y',
          ykeys: ['a', 'b'],
          labels: ['Opened Case', 'Closed Case'],
          hideHover: 'auto',
          stacked: true
        });

      });
     </script>




</body>
</html>
