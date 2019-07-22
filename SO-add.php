<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}

// Define variables and initialize with empty values
$customer_name=
$so_date=
$model=
$po_qty=
$po_units=
$po_unit_price=
$po_total_amount=
$alertMessage="";


require_once "config.php";

//If the form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $customers_name = $POST[''];

  $query = "INSERT INTO po_transactions (inv_date, supplier_name, paymentTerms, totalPrice, po_status) VALUES ( CURRENT_TIMESTAMP, '$po_supplier_name', '$paymentTerms', '$totalPrice', 1)";
  $result = mysqli_query($link, $query) or die(mysqli_error($link));


  if ($result) {
    $j = 0;
    $count = sizeof($_POST['po_qty']);

    // Use insert_id property
    $po_trans_id = $link->insert_id;
    $user  = $_SESSION["username"];

    for ($j = 0; $j < $count; $j++) {

      $query = "INSERT INTO request_po (po_trans_id,po_qty,po_unit,po_description,po_unit_price,po_total_amount,user) VALUES (
        '".$po_trans_id."',
        '".$_POST['po_qty'][$j]."',
        '".$_POST['po_unit'][$j]."',
        '".$_POST['po_description'][$j]."',
        '".$_POST['po_unit_price'][$j]."',
        '".$_POST['po_total_amount'][$j]."',
        '".$user."')";

        $result = mysqli_multi_query($link, $query) or die(mysqli_error($link));

      }

      if($result){
        $alertMessage = "<div class='alert alert-success' role='alert'>
        New user successfully added in database.
        </div>";
      }else{
        $alertMessage = "<div class='alert alert-danger' role='alert'>
        Error Adding data in Database.
        </div>";}


        //mysqli_close($link);

      }
    }

    ?>

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
      <!-- daterange picker -->
      <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
      <!-- bootstrap datepicker -->
      <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
      <!-- iCheck for checkboxes and radio inputs -->
      <link rel="stylesheet" href="plugins/iCheck/all.css">
      <!-- Bootstrap Color Picker -->
      <link rel="stylesheet" href="bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
      <!-- Bootstrap time Picker -->
      <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
      <!-- Select2 -->
      <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
      <!-- AdminLTE Skins. Choose a skin from the css/skins
      folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

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
      <!-- Site wrapper -->
      <div class="wrapper">

        <header class="main-header">
          <!-- Logo -->
          <a href="index.php" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>I</b>MS</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>MyHome</b>IMS</span>
          </a>
          <!-- Header Navbar: style can be found in header.less -->
          <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                  <a href="profile.php" class="icon-bar">
                    <span class="hidden-xs">Hello, <?php echo htmlspecialchars($_SESSION["username"]); ?></span>
                  </a>
                </li>

                <li class="dropdown user user-menu">
                  <a href="logout.php" class="icon-bar">
                    <span class="hidden-xs">Log out</span>
                  </a>
                </li>

              </ul>
            </div>
          </nav>
        </header>

        <!-- =============================================== -->

        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
          <!-- sidebar: style can be found in sidebar.less -->
          <section class="sidebar">
            <?php include ('template/sidebar-admin.php'); ?>
          </section>
          <!-- /.sidebar -->
        </aside>

        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              ADD SALES ORDER
              <small></small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-dashboard active"></i> Dashboard</a></li>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Sales Order Form </h3>


              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <?php echo $alertMessage; ?>
                  <form class="form-vertical" enctype="multipart/form-data" method="post" accept-charset="utf-8" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">


                    <div class="col-md-6">
                      <!-- 1st column content -->
                      <div class="form-group">
                        <label class="text text-red">*</label>
                        <label>Name</label>
                        <select class="form-control select2" style="width: 100%;" id="" maxlength="50" placeholder="customer name" name="customer_name" required>
                          <option selected="selected">~~SELECT~~</option>
                          <?php

                          // Include config file
                          require_once "config.php";
                          // Attempt select query execution
                          // $query = "SELECT * FROM orders WHERE name LIKE '%$name%' AND item LIKE '%$item%' AND status LIKE '%$status%'";
                          $query = "SELECT customer_name FROM customers ORDER BY customer_name ASC";
                          $result = mysqli_query($link, $query);

                          $customer_name = $_POST['customer_name'];

                          while ($row = mysqli_fetch_assoc($result)) { ?>
                            <option value="<?php echo $row['customer_name']; ?>"><?php echo $row['customer_name']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Date</label>
                        <input type="date" class="form-control"  name="so_date">
                      </div>
<<<<<<< HEAD
          
                    </div>

          <div class="col-md-12">
            <!-- 2nd row content -->
            <div class="table-responsive">
              <table class="table table-bordered" id="crud_table">
                <tr>
                  <th width="18%">Item</th>
                  <th width="18%">Quantity</th>
                  <th width="18%">Unit</th>
                  <th width="18%">Unit Price</th>
                  <th width="18%">Amount</th>
                  <th width="10%"></th>
                </tr>

                <tr>
                  <td>
                    <div class="form-group">
                      <input type="text" class="form-control" id="po_desciption" name="po_desciption[]" placeholder="Product Name">
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <input type="number" class="form-control" id="po_qty" name="po_qty[]" placeholder="Product Qty">
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <input type="text" class="form-control" id="po_unit" name="po_unit[]" placeholder="Product Unit">
                    </div>
                  </td>
                  
                  <td>
                    <div class="form-group">
                      <input type="number" class="form-control" id="po_unit_price" name="po_unit_price[]" placeholder="Product Unit Price">
=======

>>>>>>> 22678c3e62ebbefce94288cadb373a519b4974f3
                    </div>

                    <div class="col-md-12">
                      <!-- 2nd row content -->
                      <div class="table-responsive">
                        <table class="table table-bordered" id="crud_table">
                          <tr>
                            <th width="18%">Model</th>
                            <th width="18%">Quantity</th>
                            <th width="18%">Unit</th>
                            <th width="18%">Unit Price</th>
                            <th width="18%">Amount</th>
                            <th width="10%"></th>
                          </tr>

                          <tr>
                            <td>
                              <div class="form-group">
                                <input type="text" class="form-control" id="model" name="model[]" placeholder="Model">
                              </div>
                            </td>
                            <td>
                              <div class="form-group">
                                <input type="number" class="form-control" id="po_qty" name="po_qty[]" placeholder="Product Qty">
                              </div>
                            </td>
                            <td>
                              <div class="form-group">
                                <select class="form-control" id="po_unit" name="po_unit[]" placeholder="Product Unit">
                                  <option value="PC/S">pc/s</option>
                                  <option value="SET/S">set/s</option>
                                </select>
                              </div>
                            </td>

                            <td>
                              <div class="form-group">
                                <input type="number" class="form-control" id="po_unit_price" name="po_unit_price[]" placeholder="Product Unit Price">
                              </div>
                            </td>
                            <td>
                              <div class="form-group">
                                <input type="number" class="form-control po_total_amount" id="po_total_amount" name="po_total_amount[]" placeholder= "0.00" readonly>
                              </div>
                            </td>

                            <td>
                              <div align="right">
                                <button type="button" name="add" id="add" class="btn btn-success pull-left">Add Row</button>
                              </div>
                            </td>
                          </tr>


                          <tfoot >
                            <tr>
                              <td align="right" colspan="4">Delivery Fee:</td>
                              <td>
                                <div class="form-group">
                                  <input type="number" class="form-control" id="deliveryFee" name="deliveryFee" value="100" placeholder="0.00">
                                </div>
                              </td>
                              <td>

                              </td>
                            </tr>
                            <tr>
                              <td align="right" colspan="4">Sub Total Amount:</td>
                              <td>
                                <div class="form-group">
                                  <input type="number" class="form-control" id="subTotal" name="subTotal" placeholder="0.00" readonly>
                                </div>
                              </td>
                              <td>

                              </td>
                            </tr>
                            
                            
                            <tr>
                              <td align="right" colspan="4">Discount/s:</td>
                              <td>
                                <div class="form-group">
                                  <input type="number" class="form-control" id="disc" value="0" name="discount" placeholder="0.00">
                                </div>
                              </td>
                              <td>

                              </td>
                            </tr>
                            <tr>
                              <td align="right" colspan="4">Grand Total Amount:</td>
                              <td>
                                <div class="form-group">
                                  <input type="number" class="form-control" id="totalPrice" name="totalPrice" placeholder="0.00" readonly>
                                </div>
                              </td>
                              <td>

                              </td>
                            </tr>
                          </tfoot>
                        </table>

                      </div>
                    </div>
                  </div>
                </div>
                <div class="box-footer">
                  <!-- Buttons -->
                  <button type="submit" name="save" id="save" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();" class="btn btn-success pull-right">Save</button>
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

        <!-- DataTables -->
        <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

        <!-- page script -->
        <script>
        $(function () {
          $('#example1').DataTable()
          $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true
          })
        })
        </script>

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

          $('#datepicker2').datepicker({
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
      //uppercase text box
      function upperCaseF(a){
        setTimeout(function(){
          a.value = a.value.toUpperCase();
        }, 1);
      }

      function copyTextValue(bf) {
        var text1 = bf.checked ? document.getElementById("Name1").value : '';

        document.getElementById("Name2").value = text1;
        document.getElementById("Name3").value = text1;

      }

      $(function()
      {
        $('#theform').submit(function(){
          $("input[type='submit']", this)
          .val("Please Wait...")
          .attr('disabled', 'disabled');
          return true;
        });
      });




    </script>

    <!-- Add Rows -->
    <script>
    $(document).ready(function(){
      var count = 1;
      $('#add').click(function(){
        count = count + 1;
        var html_code = "<tr id='row"+count+"'>";
        html_code += "<td><input type='text' class='form-control' id='model name='model[]' placeholder='model'></td>";
        html_code += "<td><input type='number' class='form-control' id='po_qty' name='po_qty[]' placeholder='Product Qty'></td>";
        html_code += "<td><select class='form-control' id='po_unit' name='po_unit[]' placeholder='Product Unit'><option value='PC/S'>pc/s</option><option value='SET/S'>set/s</option></select></td>";
        html_code += "<td><input type='number' class='form-control' id='po_unit_price' name='po_unit_price[]' placeholder='Product Unit Price'></td>";
        html_code += "<td><input type='number' class='form-control po_total_amount' id='po_total_amount' name='po_total_amount[]' placeholder='0.00' readonly></td>";
        html_code += "<td><button type='button' name='remove' data-row='row"+count+"' class='btn btn-danger btn-s remove'>-</button></td>";
        html_code += "</tr>";
        $('#crud_table').append(html_code);
      });
      $(document).on('click', '.remove', function(){
        var delete_row = $(this).data("row");
        $('#' + delete_row).remove();
      });


      $('#crud_table tbody').on('keyup change',function(){
        calc();
      });
      $('#totalPrice').on('keyup change',function(){
        calc_total();
      });
            $('#deliveryFee').on('keyup change',function(){
        calc_total();
      });

      $('#disc').on('keyup change',function(){
        calc_total();
      });



    });

    $(document).ready(calculate);
    $(document).on("keyup", calculate);

    function calc()
    {
      $('#crud_table tbody tr').each(function(i, element) {
        var html = $(this).html();
        if(html!='')
        {
          var qty = $(this).find('#po_qty').val();
          var price = $(this).find('#po_unit_price').val();

          $(this).find('#po_total_amount').val(qty*price);

          calc_total();
        }
      });
    }

    function calc_total()
    {
      total=0;

        var deliveryFee = parseFloat(document.getElementById("deliveryFee").value);
        var disc = parseInt(document.getElementById("disc").value||0);
        var discount_total = disc;

      $('.po_total_amount').each(function() {
        total += parseInt($(this).val());
      });
        var discount_grand_total = total * discount_total;
      $('#subTotal').val((total+deliveryFee).toFixed(2));

       $('#totalPrice').val(((total - disc) + deliveryFee).toFixed(2));
    
      //tax_sum=total/100*$('#tax').val();
      //$('#tax_amount').val(tax_sum.toFixed(2));
      //$('#total_amount').val((tax_sum+total).toFixed(2));
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

  //disable button on click
  $(function()
  {
    $('#theform').submit(function(){
      $("input[type='submit']", this)
      .val("Please Wait...")
      .attr('disabled', 'disabled');
      return true;
    });
  });
</script>


</body>
</html>
