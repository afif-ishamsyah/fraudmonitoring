@extends('layout/layout')
@section('content')
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
      <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="active"><a href="{{URL::to('admin')}}"><i class="fa fa-home"></i><span>Home</span></a></li>
            <li><a href="{{URL::to('userform')}}"><i class="fa fa-edit"></i> <span>Create User</span></a></li>
            <li><a href="{{URL::to('edituserform')}}"><i class="fa fa-search"></i> <span>Edit User</span></a></li>
            <li><a href="{{URL::to('paramform')}}"><i class="fa fa-plus "></i> <span>Input Parameter</span></a></li>
          </ul>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

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
                  <h3 class="box-title">Donut Chart</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
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
          colors: ["#f56954", "#00a65a"],
          data: [
            {label: "Unfinished Case", value: 30},
            {label: "Finished Case", value: 20}
          ],
          hideHover: 'auto'
        });

        //BAR CHART
        var bar = new Morris.Bar({
          element: 'bar-chart',
          resize: true,
          data: [
            {y: '2006', a: 100, b: 90},
            {y: '2007', a: 75, b: 65},
            {y: '2008', a: 50, b: 40},
            {y: '2009', a: 75, b: 65},
            {y: '2010', a: 50, b: 40},
            {y: '2011', a: 75, b: 65},
            {y: '2012', a: 100, b: 90}
          ],
          barColors: ['#00a65a', '#f56954'],
          xkey: 'y',
          ykeys: ['a', 'b'],
          labels: ['CPU', 'DISK'],
          hideHover: 'auto'
        });

        /*
         * DONUT CHART
         * -----------
         */

        var donutData = [
          {label: "One to Many", data: 60, color: getRandomColor()},
          {label: "Many to One", data: 40, color: getRandomColor()},
          {label: "Many to Many", data: 100, color: getRandomColor()}
        ];
        $.plot("#donut-chart", donutData, {
          series: {
            pie: {
              show: true,
              radius: 0.8,
              /*innerRadius: 0.5,*/
              label: {
                show: true,
                radius: 1 / 1,
                formatter: labelFormatter,
                threshold: 0.1
              }

            }
          },
          legend: {
            show: true
          }
        });
        /*
         * END DONUT CHART
         */
      });
      /*
       * Custom Label formatter
       * ----------------------
       */
      function labelFormatter(label, series) {
        return '<div style="font-size:13px; text-align:center; padding:2px; color: #000; font-weight: 600;">'
                + Math.round(series.percent) + "%</div>";
      }

      function getRandomColor() {
      var letters = '0123456789ABCDEF'.split('');
      var color = '#';
      for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
      }
      return color;
      }

    </script>

@endsection