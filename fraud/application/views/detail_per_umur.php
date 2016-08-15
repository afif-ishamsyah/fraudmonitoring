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
                  <h3 class="box-title">Usia Kasus yang Belum Selesai</h3>
                </div>
                <div class="box-body chart-responsive">
                  <div class="chart" id="sales-chart" style="height: 250px; position: relative;"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              </div>
            
              <div class="col-md-6">
             <!-- DONUT CHART -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Lama Penyelesaian Kasus yang Telah Diselesaikan</h3>
                </div>
                <div class="box-body chart-responsive">
                  <div class="chart" id="sales-chart2" style="height: 250px; position: relative;"></div>
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

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="plugins/chartjs/Chart.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="plugins/morris/morris.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <script src="plugins/flot/jquery.flot.min.js"></script>
    <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
    <script src="plugins/flot/jquery.flot.resize.min.js"></script>
    <!-- FLOT PIE PLUGIN - also used to draw donut charts -->
    <script src="plugins/flot/jquery.flot.pie.min.js"></script>
    <!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
    <script src="plugins/flot/jquery.flot.categories.min.js"></script>
    <!-- page script -->

     <script>
      $(function () {
       //DONUT CHART
        var donut = new Morris.Donut({
          element: 'sales-chart',
          resize: true,
          colors: ["#f56954", "#00a65a", "#0111dc", "#ffff00", "#00d4be"],
          data: [
            {label: "Dibawah 1 bulan", value: <?php echo $open1; ?>},
            {label: "1 - 3 bulan", value: <?php echo $open2; ?>},
            {label: "3 - 6 bulan", value: <?php echo $open3; ?>},
            {label: "6 - 12 bulan", value: <?php echo $open4; ?>},
            {label: "Diatas 1 tahun", value: <?php echo $open5; ?>}
          ],
          hideHover: 'auto',
        });

        var donut = new Morris.Donut({
          element: 'sales-chart2',
          resize: true,
          colors: ["#f56954", "#00a65a", "#0111dc", "#ffff00", "#00d4be"],
          data: [
            {label: "Dibawah 1 bulan", value: <?php echo $close1; ?>},
            {label: "1 - 3 bulan", value: <?php echo $close2; ?>},
            {label: "3 - 6 bulan", value: <?php echo $close3; ?>},
            {label: "6 - 12 bulan", value: <?php echo $close4; ?>},
            {label: "Diatas 1 tahun", value: <?php echo $close5; ?>}
          ],
          hideHover: 'auto'
        });

        function format(series) {
                Math.round(series.percent);
      }
        
      });

    </script>

  </body>
</html>
