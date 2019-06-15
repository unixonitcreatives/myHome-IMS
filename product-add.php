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
  <title>MyHome | Add Product</title>
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
                             <li><a href="logout.php"><i class="fa fa-close"></i> <span>Logout</span></a>
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
        ADD PRODUCT
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
                        <label>Supplier</label> <a href="supplier-add.php">+add new supplier</a>
                        <select class="form-control select2" style="width: 100%;">
                      <?php
                      require_once "config.php";
                      $query = "select supplier_name from suppliers order by supplier_name";
                      $result = mysqli_query($link, $query);

                      $supplier_name = $_POST['supplier_name'];

                      while ($row = mysqli_fetch_assoc($result)) { ?>
                        <option value="<?php echo $row['supplier_name']; ?>"><?php echo $row['supplier_name']; ?></option>
                      <?php } ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Category</label> <a href="category-add.php">+add new category</a>
                        <select class="form-control select2" style="width: 100%;">
                      <?php
                      require_once "config.php";
                      $query = "select category from categories order by category";
                      $result = mysqli_query($link, $query);

                      $category_name = $_POST['category'];

                      while ($row = mysqli_fetch_assoc($result)) { ?>
                        <option value="<?php echo $row['category']; ?>"><?php echo $row['category']; ?></option>
                      <?php } ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Branch</label> <a href="branch-add.php">+add new branch</a>
                        <select class="form-control select2" style="width: 100%;">
                      <?php
                      require_once "config.php";
                      $query = "select branch_name from branches order by branch_name";
                      $result = mysqli_query($link, $query);

                      $branch_name = $_POST['supplier_name'];

                      while ($row = mysqli_fetch_assoc($result)) { ?>
                        <option value="<?php echo $row['branch_name']; ?>"><?php echo $row['branch_name']; ?></option>
                      <?php } ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Product Description</label>
                        <input type="text" class="form-control" placeholder="Product Description">
                      </div>

                      <div class="form-group">
                        <label>Model</label>
                        <input type="text" class="form-control" placeholder="Model No.">
                      </div>

                      

                      



                  </div>

                <div class="col-md-6">
                      <div class="form-group">
                        <label>PO Number</label>
                        <input type="text" class="form-control" placeholder="PO Number">
                      </div>

                      <div class="form-group">
                        <label>Quantity</label>
                        <input type="text" class="form-control" placeholder="Quantity">
                      </div>

                      <div class="form-group">
                        <label>Retail Price</label>
                        <input type="text" class="form-control" placeholder="Retail Price">
                      </div>

                      <div class="form-group">
                        <label>Supplier Price</label>
                        <input type="text" class="form-control" placeholder="Cost Price">
                      </div>

                      <div class="form-group">
                        <label>Date Arrival</label>
                        <input type="text" class="form-control" placeholder="Date Arrival">
                      </div>



                      




                </div>
            </form>
          </div>

        </div>

        <div class="box-footer">
          <!-- Buttons -->
           <button type="submit" class="btn btn-success pull-right">Save</button>
        </div>
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
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
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
