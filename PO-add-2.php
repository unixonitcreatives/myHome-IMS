<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MyHome | Add PO</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
<body class="hold-transition skin-green fixed sidebar-mini">

        <div class="table-responsive">
          <table class="table table-bordered" id="crud_table">
            <tr>
              <th width="18%">Quantity</th>
              <th width="18%">Unit</th>
              <th width="18%">Description</th>
              <th width="18%">Unit Price</th>
              <th width="18%">Amount</th>
              <th width="10%"></th>
            </tr>

            <tr>
              <td>
                <div class="form-group">
                  <input type="number" id="po_qty" name="po_qty[]" placeholder="Product Qty">
                </div>
              </td>
              <td>
                <div class="form-group">
                  <input type="number" id="po_unit" name="po_unit[]" placeholder="Product Unit">
                </div>
              </td>
              <td>
                <div class="form-group">



                  <select class="form-control" style="width: 100%;" name='po_supplier'>
                    <option>--SELECT SUPPLIER--</option>
                    <?php

                    $q = intval($_GET['q']);

                    require_once "config.php";

                    $query = "select request_po.po_description from request_po where request_po.po_trans_id = '".$q."' ";
                    $result = mysqli_query($link, $query);

                    //$po_supplier_name = $_POST['po_description'];

                    while ($row = mysqli_fetch_assoc($result)) { ?>
                      <option value="<?php echo $row['po_description']; ?>"><?php echo $row['po_description']; ?></option>
                    <?php } mysqli_close($link); ?>
                  </select>
                </div>
              </td>
              <td>
                <div class="form-group">
                  <input type="number" id="po_unit_price" name="po_unit_price[]" placeholder="Product Unit Price">
                </div>
              </td>
              <td>
                <div class="form-group">
                  <input type="number" id="po_total_amount" name="po_total_amount[]" value="0" readonly>
                </div>
              </td>

              <td></td>
            </tr>
            <tfoot>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td align="right">Grand Total Amount:</td>
                <td>
                  <div class="form-group">
                    <input type="number" class= "totalPrice" id="totalPrice[]" name="totalPrice[]" value="0" readonly>
                  </div>
                </td>
              </tr>
            </tfoot>
          </table>
          <div align="right">
            <button type="button" name="add" id="add" class="btn btn-success btn-xs">Add Row</button>
          </div>
        </div>

</form>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<footer class="main-footer">
  <?php include('template/footer.php'); ?>
</footer>

<!-- Add the sidebar's background. This div must be placed
immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page script -->
<script>
$(function () {
  //Initialize Select2 Elements
  $('.select2').select2()

  //Datemask dd/mm/yyyy
  $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
  //Datemask2 mm/dd/yyyy
  $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
  //Money Euro
  $('[data-mask]').inputmask()

  //Date range picker
  $('#reservation').daterangepicker()
  //Date range picker with time picker
  $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
  //Date range as a button
  $('#daterange-btn').daterangepicker(
    {
      ranges   : {
        'Today'       : [moment(), moment()],
        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate  : moment()
    },
    function (start, end) {
      $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    }
  )

  //Date picker
  $('#datepicker').datepicker({
    autoclose: true
  })

  //iCheck for checkbox and radio inputs
  $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass   : 'iradio_minimal-blue'
  })
  //Red color scheme for iCheck
  $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
    checkboxClass: 'icheckbox_minimal-red',
    radioClass   : 'iradio_minimal-red'
  })
  //Flat red color scheme for iCheck
  $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass   : 'iradio_flat-green'
  })

  //Colorpicker
  $('.my-colorpicker1').colorpicker()
  //color picker with addon
  $('.my-colorpicker2').colorpicker()

  //Timepicker
  $('.timepicker').timepicker({
    showInputs: false
  })
})
</script>

<script>
$(document).ready(function(){
  var count = 1;
  $('#add').click(function(){
    count = count + 1;
    var html_code = "<tr id='row"+count+"'>";
    html_code += "<td><input type='number' id='po_qty' name='po_qty[]' placeholder='Product Qty'></td>";
    html_code += "<td><input type='number' id='po_unit' name='po_unit[]' placeholder='Product Unit'></td>";
    html_code += "<td><input type='text' id='po_description' name='po_description[]' placeholder='Product Description'></td>";
    html_code += "<td><input type='number' id='po_unit_price' name='po_unit_price[]' placeholder='Product Unit Price'></td>";
    html_code += "<td><input type='number' id='po_total_amount' name='po_total_amount[]' value='0' readonly></td>";
    html_code += "<td><button type='button' name='remove' data-row='row"+count+"' class='btn btn-danger btn-xs remove'>Delete Row</button></td>";
    html_code += "</tr>";
    $('#crud_table').append(html_code);
  });
  $(document).on('click', '.remove', function(){
    var delete_row = $(this).data("row");
    $('#' + delete_row).remove();
  });

});
</script>

<script>
function calculateSum() {
  var t = 0,
  e = 0,
  p = 0;
  $(".total_price").each(function() {
    isNaN(this.value) || 0 == this.value.length || (t += parseFloat(this.value))
  }),
  e = t.toFixed(2),
  $("#grandTotal").val(e)
}
</script>

<!-- Alert animation -->
<script type="text/javascript">
$(document).ready(function () {

  window.setTimeout(function() {
    $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
      $(this).remove();
    });
  }, 1000);

});
</script>
</body>
</html>
