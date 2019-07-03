<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}

// Include config file
require_once 'config.php';

// Define variables and initialize with empty values
$supplier_name=$category=$branch_name=$product_description=$model=$po_number=$qty=$retail_price=$cost_price=$date_arrival=$alertMessage="";


//If the form is submitted or not.
//If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  //Assigning posted values to variables.
  $supplier_name = test_input($_POST['supplier_name']);
  $category = test_input($_POST['category']);
  $branch_name = test_input($_POST['branch_name']);
  $product_description = test_input($_POST['product_description']);
  $model = test_input($_POST['model']);
  $po_number = test_input($_POST['po_number']);
  $qty = test_input($_POST['qty']);
  $retail_price = test_input($_POST['retail_price']);
  $cost_price = test_input($_POST['cost_price']);
  $date_arrival = test_input($_POST['date_arriv']);



  if(empty($supplier_name)){
    $alertMessage = "Please enter a supplier name.";
  }

  if(empty($category)){
    $alertMessage = "Please enter a product category.";
  }

  if(empty($branch_name)){
    $alertMessage = "Please enter a branch name.";
  }

  if(empty($product_description)){
    $alertMessage = "Please enter a product description.";
  }

  if(empty($model)){
    $alertMessage = "Please enter a model.";
  }

  if(empty($po_number)){
    $alertMessage = "Please enter a PO number.";
  }

  if(empty($qty)){
    $alertMessage = "Please enter a product quantity.";
  }

  if(empty($retail_price)){
    $alertMessage = "Please enter a retail price.";
  }

  if(empty($cost_price)){
    $alertMessage = "Please enter a actual price.";
  }

  if(empty($date_arrival)){
    $alertMessage = "Please enter a date or arrival.";
  }

  // Check input errors before inserting in database
  if(empty($alertMessage)){


    $supplier_name = test_input($_POST['supplier_name']);
    $category = test_input($_POST['category']);
    $branch_name = test_input($_POST['branch_name']);
    $product_description = test_input($_POST['product_description']);
    $model = test_input($_POST['model']);
    $po_number = test_input($_POST['po_number']);
    $qty = test_input($_POST['qty']);
    $retail_price = test_input($_POST['retail_price']);
    $cost_price = test_input($_POST['cost_price']);
    $date_arr = test_input($_POST['date_arriv']);

  //Checking the values are existing in the database or not
    $query = "INSERT INTO inventory (supplier_name, category, branch_name, product_description, model, po_number, qty, retail_price, cost_price, date_arriv) VALUES ('$supplier_name', '$category', '$branch_name', '$product_description', '$model', '$po_number', '$qty', '$retail_price', '$cost_price', '$date_arr')";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));

    if($result){
      $alertMessage = "<div class='alert alert-success' role='alert'>
      New Product Successfully Added in Database.
      </div>";
    }else{
      $alertMessage = "<div class='alert alert-danger' role='alert'>
      Error Adding data in Database.
      </div>";}

      // remove all session variables
      //session_unset();
      // destroy the session
      //session_destroy();

      // Close connection
      mysqli_close($link);

    }
  }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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
                <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <?php echo $alertMessage; ?>
                  <div class="col-md-6">
                    <!-- 1st column content -->
                    <div class="form-group">
                      <label>Supplier</label> <a href="supplier-add.php">+add new</a>
                      <select class="form-control select2" style="width: 100%;" name="supplier_name">
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
                      <label>Category</label> <a href="category-add.php">+add new</a>
                      <select class="form-control select2" style="width: 100%;" name="category">
                        <?php
                        require_once "config.php";
                        $query = "select category from categories order by category";
                        $result = mysqli_query($link, $query);

                        $category = $_POST['category'];

                        while ($row = mysqli_fetch_assoc($result)) { ?>
                          <option value="<?php echo $row['category']; ?>"><?php echo $row['category']; ?></option>
                        <?php } ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Branch</label> <a href="branch-add.php">+add new</a>
                      <select class="form-control select2" style="width: 100%;" name="branch_name">
                        <?php
                        require_once "config.php";
                        $query = "select branch_name from branches order by branch_name";
                        $result = mysqli_query($link, $query);

                        $branch_name = $_POST['branch_name'];

                        while ($row = mysqli_fetch_assoc($result)) { ?>
                          <option value="<?php echo $row['branch_name']; ?>"><?php echo $row['branch_name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Product Description</label>
                      <input type="text" class="form-control" placeholder="Product Description" name="product_description">
                    </div>

                    <div class="form-group">
                      <label>Model</label>
                      <input type="text" class="form-control" placeholder="Model No." name="model">
                    </div>

                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>PO Number</label>
                      <input type="number" class="form-control" placeholder="PO Number" name="po_number">
                    </div>

                    <div class="form-group">
                      <label>Quantity</label>
                      <input type="number" class="form-control" placeholder="Quantity" name="qty">
                    </div>

                    <div class="form-group">
                      <label>Retail Price</label>
                      <input type="number" class="form-control" placeholder="Retail Price" name="retail_price">
                    </div>

                    <div class="form-group">
                      <label>Supplier Price</label>
                      <input type="number" class="form-control" placeholder="Cost Price" name="cost_price">
                    </div>

                    <div class="form-group">
                      <label>Date Arrival</label>
                      <input type="date" class="form-control" placeholder="Date Arrival" name="date_arriv">
                    </div>

                  </div>

                </div>
                <div class="box-footer">
                  <!-- Buttons -->
                  <button type="submit" class="btn btn-success pull-right">Save</button>
                </div>
              </div>
            </form>

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
