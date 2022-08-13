<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- /.content-wrapper -->
<footer class="main-footer">
  <strong>Copyright &copy; AGM - American Giant Mattress.</strong> All rights reserved.
</footer>
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?= base_url('asset/bower_components/jquery/dist/jquery.min.js');?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('asset/bower_components/jquery-ui/jquery-ui.min.js');?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
$.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url('asset/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
<!-- Morris.js charts -->
<script src="<?= base_url('asset/bower_components/raphael/raphael.min.js');?>"></script>
<!-- <script src="<?= base_url('asset/bower_components/morris.js/morris.min.js');?>"></script> -->
<!-- Sparkline -->
<script src="<?= base_url('asset/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js');?>"></script>
<!-- jvectormap -->
<script src="<?= base_url('asset/plugins/jquery-vectormap/jquery-jvectormap-2.0.3.min.js');?>"></script>
<script src="<?= base_url('asset/plugins/jquery-vectormap/jquery-jvectormap-world-mill-en.js');?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url('asset/bower_components/jquery-knob/dist/jquery.knob.min.js');?>"></script>
<!-- daterangepicker -->
<script src="<?= base_url('asset/bower_components/moment/min/moment.min.js');?>"></script>
<script src="<?= base_url('asset/bower_components/bootstrap-daterangepicker/daterangepicker.js');?>"></script>
<!-- datepicker -->
<script src="<?= base_url('asset/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js');?>"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?= base_url('asset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js');?>"></script>
<!-- Slimscroll -->
<script src="<?= base_url('asset/bower_components/jquery-slimscroll/jquery.slimscroll.min.js');?>"></script>
<!-- FastClick -->
<script src="<?= base_url('asset/bower_components/fastclick/lib/fastclick.js');?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('asset/dist/js/adminlte.min.js');?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('asset/dist/js/demo.js');?>"></script>
<!-- CK Editor -->
<script src="<?= base_url('asset/bower_components/ckeditor/ckeditor.js"');?>"></script>
<!-- DataTables -->
<script src="<?= base_url('asset/bower_components/datatables.net/js/jquery.dataTables.js');?>"></script>
<script src="<?= base_url('asset/bower_components/datatables.net-bs/js/dataTables.bootstrap.js');?>"></script>
<!-- Select2 -->
<script type="text/javascript" src="<?= base_url('asset/bower_components/select2/dist/js/select2.full.min.js');?>"></script>
<!-- AutoNumber -->
<script type="text/javascript" src="https://unpkg.com/autonumeric"></script>
<!-- Bootstrap Toggle -->
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<!-- Image Popup -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/plugins/magnific-popup/magnific-popup.css'); ?>">
<script type="text/javascript" src="<?php echo base_url('asset/plugins/magnific-popup/jquery.magnific-popup.min.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.image-link').magnificPopup({type:'image'});
        
        $('#dataTable1').DataTable({
          'paging'      : true, // harus ada
          'lengthChange': true, // harus ada
          'ordering'    : true, // harus ada
          'info'        : true,
          'autoWidth'   : false,
          'searching'   : true,
          'processing'  : true,
          // 'pageLength'  : 15,
          // "dom": '<"top"f>rt<"bottom"ilp><"clear">'
        });

        $('#dataTable').DataTable({

          'paging'      : true, // harus ada
          'lengthChange': true, // harus ada
          'ordering'    : true, // harus ada
          'info'        : true,
          'autoWidth'   : false,
          'searching'   : true,
          'processing'  : true,
        });

        function thumbnail(){
          var preview = document.querySelector('#logoBrand');
          console.log(preview);
          var file    = document.querySelector('input[type=file]').files[0];
          var reader  = new FileReader();

          reader.onloadend = function(){
            perview.src = reader.result;
          }

          if(file){
            redear.readAsDataURL(file);
          }else{
            preview.src = "";
          }
        }
    });
</script>
</body>
</html>
