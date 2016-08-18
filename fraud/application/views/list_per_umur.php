

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>Detail</h1>
        </section>

        <!-- Main content -->
        <section class="content">
              <div class="box box-danger">
                <div class="box-header with-border">
               <?php if($choice=='0'): ?><h3 class="box-title">Detail Umur Open Case : <b>< 1 Bulan</b></h3><?php endif; ?>
               <?php if($choice=='1'): ?><h3 class="box-title">Detail Umur Open Case : <b>1 - 3 Bulan</b></h3><?php endif; ?>
               <?php if($choice=='2'): ?><h3 class="box-title">Detail Umur Open Case : <b>3 - 6 Bulan</b></h3><?php endif; ?>
               <?php if($choice=='3'): ?><h3 class="box-title">Detail Umur Open Case : <b>6 - 12 Bulan</b></h3><?php endif; ?>
               <?php if($choice=='4'): ?><h3 class="box-title">Detail Umur Open Case : <b>> 1 Tahun</b></h3><?php endif; ?>
    <?php if($choice=='5'): ?><h3 class="box-title">Detail Waktu Penyelesaian Closed Case : <b>< 1 Bulan</b></h3><?php endif; ?>
    <?php if($choice=='6'): ?><h3 class="box-title">Detail Waktu Penyelesaian Closed Case : <b>1 - 3 Bulan</b></h3><?php endif; ?>
    <?php if($choice=='7'): ?><h3 class="box-title">Detail Waktu Penyelesaian Closed Case : <b>3 - 6 Bulan</b></h3><?php endif; ?>
    <?php if($choice=='8'): ?><h3 class="box-title">Detail Waktu Penyelesaian Closed Case : <b>6 - 12 Bulan</b></h3><?php endif; ?>
    <?php if($choice=='9'): ?><h3 class="box-title">Detail Waktu Penyelesaian Closed Case : <b>> 1 Tahun</b></h3><?php endif; ?>
                <div class="pull-right">
                 <a href="javascript:void(0)" onclick="location.href='<?php echo site_url("agelist"); ?>';" type="get" class="btn btn-danger"><span>Back</span></a>
                <a href="javascript:void(0)" onclick="location.href='<?php echo site_url("downloadage/$choice"); ?>';" type="get" class="btn btn-success"><i class="fa fa-download"></i> <span>Download Result</span></a>
                </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example9" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Telephone Number</th>
                        <th>Corporate Customer</th>
                        <th>Account Manager</th>
                        <th>Destination Number</th>
                        <th>Destination Country</th>
                        <th>Case Date</th>
                        <th>Case Type</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($detail as $details): ?>
                      <tr>
                        <td> <?php echo $details->TELEPHONE_NUMBER; ?></td>
                        <td> <?php echo $details->CUSTOMER; ?></td>
                        <td> <?php echo $details->AM; ?></td>
                        <td> <?php echo $details->DESTINATION_NUMBER; ?></td>
                        <td> <?php echo $details->DESTINATION; ?></td>
                        <td> <?php echo $details->CASE_TIME; ?></td>
                        <td> <?php echo $details->CASE_PARAMETER; ?></td>
                      </tr>
                    <?php endforeach; ?>
                      </tbody>
                    </table>
                    </div>
                    </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="plugins/select2/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="plugins/input-mask/jquery.inputmask.js"></script>
    <script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>

     <script>
     $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
        $('#example9').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });

      });
     </script>
  </body>
</html>
