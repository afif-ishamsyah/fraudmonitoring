 <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url("/plugins/jQuery/jQuery-2.1.4.min.js"); ?>"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url("/bootstrap/js/bootstrap.min.js"); ?>"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="<?php echo base_url("/plugins/chartjs/Chart.min.js"); ?>"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="<?php echo base_url("/plugins/morris/morris.min.js"); ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url("/plugins/fastclick/fastclick.min.js"); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url("/dist/js/app.min.js"); ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url("/dist/js/demo.js"); ?>"></script>
    <script src="<?php echo base_url("/plugins/flot/jquery.flot.min.js"); ?>"></script>
    <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
    <script src="<?php echo base_url("/plugins/flot/jquery.flot.resize.min.js"); ?>"></script>
    <!-- FLOT PIE PLUGIN - also used to draw donut charts -->
    <script src="<?php echo base_url("/plugins/flot/jquery.flot.pie.min.js"); ?>"></script>
    <!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
    <script src="<?php echo base_url("/plugins/flot/jquery.flot.categories.min.js"); ?>"></script>
    <!-- page script -->
    <script type="text/javascript">
      $(function () {
       
        var donut = new Morris.Donut({
          element: 'sales-chart',
          resize: true,
          colors: ["#f56954", "#00a65a"],
          data: [
            {label: "Unfinished Case", value: <?php echo $unfinish; ?>},
            {label: "Finished Case", value: <?php echo $finish; ?>}
          ],
          hideHover: 'auto'
        });

        
        var bar = new Morris.Bar({
          element: 'bar-chart',
          resize: true,
          data: [
            {y: <?php echo $tahun1; ?> , a: <?php echo $closed1; ?>, b: <?php echo $open1; ?>},
            {y: <?php echo $tahun2; ?> , a: <?php echo $closed2; ?>, b: <?php echo $open2; ?>},
            {y: <?php echo $tahun3; ?> , a: <?php echo $closed3; ?>, b: <?php echo $open3; ?>},
            {y: <?php echo $tahun4; ?> , a: <?php echo $closed4; ?>, b: <?php echo $open4; ?>},
            {y: <?php echo $tahun5; ?> , a: <?php echo $closed5; ?>, b: <?php echo $open5; ?>}
          ],
          barColors: ['#00a65a', '#f56954'],
          xkey: 'y',
          ykeys: ['a', 'b'],
          labels: ['Closed Case', 'Open Case'],
          hideHover: 'auto'
        });

        var donutData = [
          <?php foreach($parameter as $param):?>
          {label: '<?php echo $param->DESCRIPTION; ?>', data: <?php echo $param->TOTAL; ?>, color: getRandomColor()},
          <?php endforeach; ?>
        ];
        $.plot("#donut-chart", donutData, {
          series: {
            pie: {
              show: true,
              radius: 0.8,
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
    
</body>
</html>