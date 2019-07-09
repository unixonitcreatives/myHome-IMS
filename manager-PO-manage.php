<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require_once "config.php";

$alertMessage=$status="";
//Checking the values are existing in the database or not
$query = "Select * from po_transactions order by inv_date asc";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if(isset($_GET['alert'])){
  if($_GET['alert'] == 'deletesuccess'){
    $alertMessage = "<div class='alert alert-danger' role='alert'>Data deleted successfully.</div>"; }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MyHome | Manage PO</title>
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
      <?php include ('template/sidebar-manager.php'); ?>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        MANAGE PURCHASE ORDER
        <small>You can see a brief summary and overview of operation of business</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard active"></i> Dashboard</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <?php echo $alertMessage; ?>
    <!-- Main content -->
    <!-- Main content -->
    <div class="box-body">
      <!-- Search Area -->
      <section class="content">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Manage Purchase Order</h3>
            <br><a href="PO-add.php" class="text-center">+ Add New PO</a>
            <div class="box-body">
              <div class="row">
                <table id="example1" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                  <thead>
                    <tr>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">PO-ID</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Date</th>

                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Supplier</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Notes</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Total Price</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    // Include config file
                    require_once 'config.php';

                    // Attempt select query execution
                    $query = "SELECT * FROM po_transactions order by po_trans_id asc";
                    if($result = mysqli_query($link, $query)){
                      if(mysqli_num_rows($result) > 0){

                        while($row = mysqli_fetch_array($result)){
                          $status = $row['po_status']; //ung 'po status' yan dapat name sa dbase. etong line lang gagalawin mo

                          echo "<tr>";
                          echo "<td>" . $row['po_trans_id'] . "</td>";
                          echo "<td>" . $row['inv_date'] . "</td>";

                          echo "<td>" . $row['supplier_name'] . "</td>";
                          echo "<td>" . $row['paymentTerms'] . "</td>";
                          echo "<td>₱" . number_format($row['totalPrice'],2) . "</td>";

                          // eto ung mag chcheck kung ano value nung 'po status' tapos papalitan nya color
                          // STATUS: 1=PENDING; 2=APPROVED; 3=VOID
                          if($status == 1){
                            echo "<td> <span class='label label-warning'>Pending</span> </td>";
                          } elseif ($status == 2) {
                              echo "<td> <span class='label label-success'>Approved</span> </td>";
                          } elseif ($status == 3) {
                            echo "<td> <span class='label label-danger'>Void</span> </td>";
                          } else {
                            echo "<td> <span class='label label-default'>Error</span> </td>";
                          }
                          //end here

                          //echo "<td> <span class='label label-warning'>Pending</span> </td>";
                          echo "<td>";

                          echo "<a href='manager-PO-view.php?id=". $row['po_trans_id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-share'></span></a>";
                          //echo " &nbsp; <a href='PO-delete.php?id=". $row['po_trans_id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash remove'></span></a>";
                          echo "</td>";
                          echo "</tr>";
                        }

                        // Free result set
                        mysqli_free_result($result);
                      } else{
                        echo "<p class='lead'><em>No records were found.</em></p>";
                      }
                    } else{
                      echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }

                    // Close connection
                    mysqli_close($link);
                    ?>
                  </tbody>
                </table>
                <!-- /.content -->
              </div>
              <!-- /.content-wrapper -->
              <!-- /.content-wrapper -->
              <!-- /.box-header -->
            </div>
            <!-- /.content -->
          </div>
          <!-- /.content-wrapper -->

        </section>
        <!-- .Search Area end -->


        <!-- /.content -->
      </div>
    </div>
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

<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>


<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
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
