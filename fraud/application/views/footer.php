
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>

    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url("/bootstrap/js/bootstrap.min.js"); ?>"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url("/plugins/datatables/jquery.dataTables.min.js"); ?>"></script>
    <script src="<?php echo base_url("/plugins/datatables/dataTables.bootstrap.min.js"); ?>"></script>
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
    <script src="<?php echo base_url("/plugins/daterangepicker/daterangepicker.js"); ?>"></script>
    <!-- bootstrap color picker -->
    <script src="<?php echo base_url("/plugins/colorpicker/bootstrap-colorpicker.min.js"); ?>"></script>
    <!-- bootstrap time picker -->
    <script src="<?php echo base_url("/plugins/timepicker/bootstrap-timepicker.min.js"); ?>"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?php echo base_url("/plugins/slimScroll/jquery.slimscroll.min.js"); ?>"></script>
    <!-- iCheck 1.0.1 -->
    <script src="<?php echo base_url("/plugins/iCheck/icheck.min.js"); ?>"></script>
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


    <script>
     
     $(function () {

       $('#repass').bind("cut copy paste",function(e) {
       e.preventDefault();
       });

        $( "#datepicker" ).datepicker({constrainInput: true, dateFormat:"dd-mm-yy"});
        $( "#datepicker2" ).datepicker({constrainInput: true, dateFormat:"dd-mm-yy"});
        $( "#datepicker3" ).datepicker({constrainInput: true, dateFormat:"dd-mm-yy"});
        $( "#datepicker4" ).datepicker({constrainInput: true, dateFormat:"dd-mm-yy"});
        $( "#datepickera" ).datepicker({constrainInput: true, dateFormat:"dd-mm-yy"});
        $( "#datepicker6" ).datepicker({constrainInput: true, dateFormat:"dd-mm-yy"});

        //Initialize Select2 Elements
        $(".select2").select2();
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
        $('#example3').DataTable({
          "paging": false,
          "lengthChange": false,
          "searching": false,
          "ordering": false,
          "info": false,
          "autoWidth": false
        });
        $('#example4').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
        $('#example5').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
        $("#example6").DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
        $("#example7").DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });

      });
     </script>




</body>
</html>