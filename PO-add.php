<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
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
      <!-- Sidebar user panel -->
      <div class="user-panel">
             <div class="pull-left image">
               <img src="dist/img/profile.jpg" class="img-circle" alt="User Image">
             </div>
             <div class="pull-left info">
               <p><?php echo htmlspecialchars($_SESSION["username"]); ?></p>
               <!-- Status -->
               <a href="#"><i class="fa fa-circle text-success"></i> Online
               </a>
             </div>
           </div>

           <!-- Sidebar Menu -->
           <ul class="sidebar-menu" data-widget="tree">
             <!-- Optionally, you can add icons to the links -->
              <li class="active"><a href="index.php"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                             <li class="treeview">
                                 <a href="#"><i class="fa fa-id-card-o"></i> <span>Suppliers</span>
                                     <span class="pull-right-container">
                                         <i class="fa fa-angle-left pull-right"></i>
                                     </span>
                                 </a>
                                 <ul class="treeview-menu">
                                     <li><a href="supplier-add.php">Add Suppliers</a></li>
                                     <li><a href="supplier-manage.php">Manage Suppliers</a></li>
                                 </ul>
                             </li>

                             <li class="treeview">
                                 <a href="#"><i class="fa fa-th-large"></i> <span>Category</span>
                                     <span class="pull-right-container">
                                         <i class="fa fa-angle-left pull-right"></i>
                                     </span>
                                 </a>
                                 <ul class="treeview-menu">
                                     <li><a href="category-add.php">Add Categories</a></li>
                                     <li><a href="category-manage.php">Manage Categories</a></li>
                                 </ul>
                             </li>

                             <li class="treeview">
                                 <a href="#"><i class="fa fa-archive"></i> <span>Branches</span>
                                     <span class="pull-right-container">
                                         <i class="fa fa-angle-left pull-right"></i>
                                     </span>
                                 </a>
                                 <ul class="treeview-menu">
                                     <li><a href="branch-add.php">Add Branches</a></li>
                                     <li><a href="branch-manage.php">Manage Branches</a></li>
                                 </ul>
                             </li>

                             <li class="treeview">
                                 <a href="#"><i class="fa fa-cart-plus"></i> <span>Purchase Order</span>
                                     <span class="pull-right-container">
                                         <i class="fa fa-angle-left pull-right"></i>
                                     </span>
                                 </a>
                                 <ul class="treeview-menu">
                                     <li><a href="PO-add.php">Add PO</a></li>
                                     <li><a href="PO-manage.php">Manage PO</a></li>
                                     <li><a href="PO-request.php">Request PO</a></li>
                                 </ul>
                             </li>

                             <li class="treeview">
                                 <a href="#"><i class="fa fa-th"></i> <span>Products</span>
                                     <span class="pull-right-container">
                                         <i class="fa fa-angle-left pull-right"></i>
                                     </span>
                                 </a>
                                 <ul class="treeview-menu">
                                     <li><a href="product-add.php">Add Products</a></li>
                                     <li><a href="product-manage.php">Manage Products</a></li>
                                     <li><a href="product-aging.php">Aging Products</a></li>
                                 </ul>
                             </li>

                             <li class="treeview">
                                 <a href="#"><i class="fa fa-users"></i> <span>Customers</span>
                                     <span class="pull-right-container">
                                         <i class="fa fa-angle-left pull-right"></i>
                                     </span>
                                 </a>
                                 <ul class="treeview-menu">
                                     <li><a href="customer-add.php">Add Customers</a></li>
                                     <li><a href="customer-manage.php">Manage Customers</a></li>
                                 </ul>
                             </li>

                             <li class="treeview">
                                 <a href="#"><i class="fa fa-user-circle-o"></i> <span>Add Users</span>
                                     <span class="pull-right-container">
                                         <i class="fa fa-angle-left pull-right"></i>
                                     </span>
                                 </a>
                                 <ul class="treeview-menu">
                                     <li><a href="user-add.php">Add Users</a></li>
                                     <li><a href="user-manage.php">Manage Users</a></li>
                                 </ul>
                             </li>

                             <li><a href="report.php"><i class="fa fa-pie-chart"></i> <span>Reports</span></a>
                             </li>

                             <li><a href="support.php"><i class="fa fa-superpowers"></i> <span>Support</span></a>
                             </li>
                         </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        ADD PURCHASE ORDER
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
          <h3 class="box-title">Product Information</h3>


        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">

            <form role="form">
                <div class="col-md-6">
                  <!-- 1st column content -->
                      <div class="form-group">
                        <label>Purchase Order No.</label>
                        <input type="text" class="form-control" placeholder="Purchase Order No.">
                      </div>

                      <div class="form-group">
                        <label>Supplier</label>
                        <select class="form-control" style="width: 100%;">
                          <option selected="selected">Main Branch</option>
                          <option>populate</option>
                          <option>to ng names</option>
                          <option>of</option>
                          <option>suppliers</option>
                          <option>from</option>
                          <option>database</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" placeholder="Address (auto-fill)" disabled>
                      </div>

                      <div class="form-group">
                        <label>Contact Person</label>
                        <input type="text" class="form-control" placeholder="Contact Person (auto-fill or manual?)" disabled>
                      </div>

                  </div>

                <div class="col-md-6">
                  <!-- 2nd column content -->
                      <div class="form-group">
                        <label>Payment Date</label>
                        <input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask>
                      </div>


                      <div class="form-group">
                        <label>Payment Mode</label>
                        <select class="form-control" style="width: 100%;">
                          <option selected="selected">Cash</option>
                          <option>Cheque</option>
                          <option disabled="disabled">Card (Available Soon)</option>
                          <option>Other</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Payment Terms</label>
                        <input type="text" class="form-control" placeholder="Payment Terms">
                      </div>

                      <div class="form-group">
                        <label>Due Date</label>
                        <input type="text" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask>
                      </div>

                </div>

                <div class="col-md-12">
                  <!-- 2nd row content -->


                                <form class="form-vertical">

                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="crud_table">
                                            <tr>
                                                <th width="18%">Product Name</th>
                                                <th width="18%">Product Code</th>
                                                <th width="18%">Quantity</th>
                                                <th width="18%">Unit Price</th>
                                                <th width="18%">Amount</th>
                                                <th width="10%"></th>
                                                
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="item_name" name="item_name[]" placeholder="Product Name">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="item_code" name="item_code[]" placeholder="Product Code">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="item_quantity" name="item_quantity[]" placeholder="Quantity">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="item_unit_price" name="item_unit_price[]" placeholder="Product Amount">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="item_amount" name="item_amount[]" value="0.00" readonly>
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
                                                            <input type="text" class= "totalPrice" id="totalPrice" name="total" value="0.00" readonly>
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
                            </div>
                          </div>
                        </form>


        </div>

        <div class="box-footer">
          <!-- Buttons -->
           <button type="submit" class="btn btn-success pull-right">Save</button>
        </div>

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
                    html_code += "<td><input tyep='text' id='item_name' name='item_name[]' placeholder='Product Name'> </td>";
                    html_code += "<td><input tyep='text' id='item_code' name='item_code[]' placeholder='Product Code'></td>";
                    html_code += "<td><input tyep='text' id='item_quantity' name='item_quantity[]' placeholder='Quantity'></td>";
                    html_code += "<td><input tyep='text' id='item_unit_price' name='item_unit_price[]'class='totalPrice' placeholder='Product Amount'></td>";
                    html_code += "<td><input tyep='text' id='item_amount' name='item_amount[]'class='totalPrice' value='0.00' readonly></td>";
                    html_code += "<td><button type='button' name='remove' data-row='row"+count+"' class='btn btn-danger btn-xs remove'>Delete Row</button></td>";   
                    html_code += "</tr>";  
                    $('#crud_table').append(html_code);
                });
                $(document).on('click', '.remove', function(){
                    var delete_row = $(this).data("row");
                    $('#' + delete_row).remove();
                });
                /*$('#save').click(function(){
                    var item_name = [];
                    var item_code = [];
                    var item_desc = [];
                    var item_price = [];
                    $('.item_name').each(function(){
                        item_name.push($(this).text());
                    });
                    $('.item_code').each(function(){
                        item_code.push($(this).text());
                    });
                    $('.item_desc').each(function(){
                        item_desc.push($(this).text());
                    });
                    $('.item_price').each(function(){
                        item_price.push($(this).text());
                    });
                    $.ajax({
                        url:"insert.php",
                        method:"POST",
                        data:{item_name:item_name,item_code:item_code, item_desc:item_desc, item_price:item_price},
                        success:function(data){
                            alert(data);
                            $("td[contentEditable='true']").text("");
                            for(var i=2; i<= count; i++)
                            {
                                $('tr#'+i+'').remove();
                            }
                        }
                    });
                });*/
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
</body>
</html>
