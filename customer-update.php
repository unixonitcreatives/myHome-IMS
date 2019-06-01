<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$alertMessage=$customers_name=$customers_contact=$customers_email=$customers_address=$created_at="";

require_once "config.php";


$users_id = $_GET['id'];
$query = "SELECT * from customers WHERE id='$users_id'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)){
        $customers_name  =  $row['customer_name'];
        $customers_contact  =  $row['customer_contact'];
        $customers_email  =  $row['customer_email'];
        $customers_address  =  $row['customer_address'];
        $created_at  =  $row['created_at'];

    }
}else {
    $alertMessage="<div class='alert alert-danger' role='alert'>Theres Nothing to see Here.</div>";
}
//If the form is submitted or not.
//If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    //Assigning posted values to variables.
    $customers_name = test_input($_POST['customer_name']);
    $customers_contact = test_input($_POST['customer_contact']);
    $customers_email = test_input($_POST['customer_email']);
    $customers_address = test_input($_POST['customer_address']);

    // Validate category
    if(empty($customers_name)){
        $alertMessage = "Please enter a customer name.";
    }
    if(empty($customers_contact)){
        $alertMessage = "Please enter a customer contact number.";
    }
    if(empty($customers_email)){
        $alertMessage = "Please enter a email.";
    }
    if(empty($customers_address)){
        $alertMessage = "Please enter a address.";
    }


    // Check input errors before inserting in database
    if(empty($alertMessage)){

    //Checking the values are existing in the database or not
    $query = "UPDATE customers SET customer_name='$customers_name', customer_contact='$customers_contact',  customer_email='$customers_email', customer_address='$customers_address' WHERE id='$users_id'";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    if($result){
        $alertMessage = "<div class='alert alert-success' role='alert'>
  Customers data successfully updated in database.
</div>";
    }else {
        $alertMessage = "<div class='alert alert-success' role='alert'>
  Error updating record.
</div>";
    }
}
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Close connection
mysqli_close($link);

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MyHome | Dashboard</title>
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
        ADD CUSTOMER
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard active"></i> Dashboard</a></li>
      </ol>
    </section>

    <!-- Main content -->
<section class="content">
    <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Customer's Information</h3>
            </div>
            <!-- /.box-header -->
            <?php echo $alertMessage; ?>
            <!-- form start -->
            <form  method="POST"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id=<?php echo $users_id; ?>">
              <div class="box-body">
                <div class="form-group">
                  <label>Customer Name</label>
                  <input type="text" class="form-control" placeholder="Fullname" name="customer_name" value="<?php echo $customers_name; ?>" required>
                </div>

                <div class="form-group">
                  <label>Phone</label>
                  <input type="number" class="form-control" placeholder="Phone" name="customer_contact" value="<?php echo $customers_contact; ?>" required>
                </div>

                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" placeholder="Email" name="customer_email" value="<?php echo $customers_email; ?>" required>
                </div>

                <div class="form-group">
                  <label>Address</label>
                  <input type="text" class="form-control" placeholder="Address" name="customer_address" value="<?php echo $customers_address; ?>" required>
                </div>

                <div class="form-group">
                  <label>Createad at</label>
                  <input type="text" class="form-control" placeholder="created_at" name="createad_at" value="<?php echo $created_at; ?>" disabled>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-success">Save</button>
              </div>
            </form>
          </div>
          <!-- /.box -->


        </div>
    <!-- /.content -->
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
<!-- jQuery 3 -->
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
