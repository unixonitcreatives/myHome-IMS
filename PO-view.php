<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}

// Define variables and initialize with empty values
$inv_num=$po_supplier_name=$po_qty=$po_unit=$po_description=$po_unit_price=$po_total_amount=$totalPrice=$remarks=$user=$paymentTerms=$transID=$alertMessage="";

$supplier_address=$status="";

require_once "config.php";

$users_id = $_GET['id'];

$query = "SELECT request_po.po_trans_id, suppliers.supplier_address,po_transactions.supplier_name,po_transactions.po_status, suppliers.supplier_address, request_po.po_qty, request_po.po_unit, request_po.po_unit_price, request_po.po_description, request_po.po_unit_price, request_po.po_total_amount,po_transactions.inv_date, po_transactions.paymentTerms, po_transactions.totalPrice, request_po.user from suppliers " .
"INNER JOIN po_transactions ON suppliers.supplier_name = po_transactions.supplier_name ".
"INNER JOIN request_po ON po_transactions.po_trans_id = request_po.po_trans_id WHERE po_transactions.po_trans_id = $users_id";

$result = mysqli_query($link, $query) or die(mysqli_error($link));
if (mysqli_num_rows($result) > 0) {

  while ($row = mysqli_fetch_assoc($result)){
    $po_supplier_name   = $row['supplier_name'];
    $totalPrice         = $row['totalPrice'];
    $po_qty             = $row['po_qty'];
    $po_description     = $row['po_description'];
    $po_unit_price      = $row['po_unit_price'];
    $po_total_amount    = $row['po_total_amount'];
    $supplier_address   = $row['supplier_address'];
    $po_unit            = $row['po_unit'];

    if($row['po_status'] == 1){
      $showStatus = "<span class='text-yellow'>Pending</span>";
    }elseif ($row['po_status'] == 2){
      $showStatus = "<span class='text-success'>Approved</span>";
    }elseif ($row['po_status'] == 3){
      $showStatus = "<span class='text-danger'>Void</span>";

    }else {
      $showStatus = "<span class='text-default'>Error</span>";

    }


  }
  $num_rows = mysqli_num_rows($result);
} else{
  echo "<p class='lead'><em>No records were found.</em></p>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){

  $query = "UPDATE po_transactions SET po_status = 2 WHERE po_trans_id='$users_id'";
  $approved = mysqli_query($link, $query) or die(mysqli_error($link));

  $showStatus = "<span class='label label-success'>Approved</span>";
  header("Location: PO-manage.php");


}


?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MyHome | Purchase Order #
    <?php
    echo $users_id;
    ?></title>
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
          <?php include ('template/sidebar-admin.php'); ?>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- =============================================== -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="invoice">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <h2 class="header">
                <div class="col-xs-3">
                  <img class="img-responsive" src="dist/img/logo-01.png">
                  <br>
                </div>
                <small class="pull-right">
                    <button onclick="Print()" target="_blank" class="btn btn-default no-print" ><i class="fa fa-print">Print</i></button> 
                </small>

              </h2>
            </div>
            <!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              From
              <address>
                <strong>
                  <?php
                  //dito bro, company name nung supplier sa PO na to
                  echo $po_supplier_name;
                  ?>

                </strong><br>
                <?php echo $supplier_address; ?>
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              To
              <address>
                <strong>MyHome Interior Furniture Co.</strong><br>
                Unit 13-16 #30th Real St. Las Pinas Commercial Complex <br>
                Alabang-Zapote Road, Las Piñas<br>
                Phone: (555) 539-1037<br>
                Email: hello.world@example.com
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              <h3>
                <b>Purchase Order &nbsp;</b>#
                  <?php
                  echo $users_id;
                  ?>

                <br>
                <b>Status: &nbsp;</b><?php echo $showStatus; ?><br>
                <b>Date:</b> <script> document.write(new Date().toLocaleDateString()); </script> <br>

              </h3>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- Table row -->
          <div class="row">
            <div class="col-xs-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>

                    <th width="40%">Product Description</th>
                    <th width="15%">Quantity</th>
                    <th width="15%">Unit</th>
                    <th width="15%">Unit Price</th>
                    <th width="15%">Total Amount</th>
                  </tr>
                </thead>

                <tbody>
                  <?php

                  $result = mysqli_query($link, $query) or die(mysqli_error($link));
                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)){

                      $totalPrice  =  $row['totalPrice'];

                      echo "<tr>";
                      //echo "<td>" .$row['po_trans_id'] . "</td>";

                      echo "<td>" . $row['po_description'] . "</td>";
                      echo "<td>" .$row['po_qty'] . "</td>";
                      echo "<td>" . $row['po_unit'] . "</td>";
                      echo "<td>₱ " . number_format($row['po_unit_price'],2) . "</td>";
                      echo "<td>₱ " . number_format($row['po_total_amount'],2) . "</td>";

                      echo "</tr>";

                    }


                    // Free result set
                    mysqli_free_result($result);
                  } else{
                    echo "<p class='lead'><em>No records were found.</em></p>";
                  }

                  ?>
                  <tr>
                    <td>No of Items : </td>
                    <td><?php echo $num_rows; ?> </td>
                  </tr>

                </tbody>

              </table>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
              <p class="lead">Payment Methods:</p>
              <img src="dist/img/credit/visa.png" alt="Visa">
              <img src="dist/img/credit/mastercard.png" alt="Mastercard">
              <img src="dist/img/credit/american-express.png" alt="American Express">
              <img src="dist/img/credit/paypal2.png" alt="Paypal">

              <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                Pwede maglagay ng note dito company, pwede din to gawin text box sana
              </p>
            </div>
            <!-- /.col -->
            <div class="col-xs-6">
              <p class="lead">Amount Due 2/22/2014</p>

              <div>
                <table class="table-responsive">
                  <!--
                  <tr>
                  <th style="width:50%">Subtotal:</th>
                  <td>₱ <?php
                  echo number_format($totalPrice,2,'.',',');
                  ?></td>
                </tr>
                <
                <tr>
                <th>Tax (9.3%)</th>
                <td>Kailangan paba ito?</td>
              </tr>
              <tr>
              <th>Shipping:</th>
              <td>Kailangan paba ito?</td>
            </tr>
          -->
          <tr>
            <td width="20%"><h3>Grand Total: &nbsp;</h3></td>
            <td width="80%"><h3> ₱ <?php
            echo number_format($totalPrice,2,'.',',');?></h3></td>
          </tr>
        </table>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- this row will not appear when printing -->
  <div class="row no-print">
    <div class="col-xs-12">

      

      <form  method="POST"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id=<?php echo $users_id; ?>">
      <button type="submit" class="btn btn-success pull-right" name="Approved"><i class="fa fa-thumbs-o-up"></i> Approve Purchase Order</button>
      </form>


      <form  method="POST"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id=<?php echo $users_id; ?>">
        
      <button type="submit" class="btn btn-danger" name="Void"><i class="fa fa-trash"></i>Void Purchase Order</a></button>
      </form>


      <?php
          if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['Approved']))
          {
             $query = "UPDATE po_transactions SET po_status = 2 WHERE po_trans_id='$users_id'";
             $approved = mysqli_query($link, $query) or die(mysqli_error($link));

             $showStatus = "<span class='label label-success'>Approved</span>";
             header("Location: PO-manage.php");
          }

          elseif ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['Void']))
          {
             $query = "UPDATE po_transactions SET po_status = 3 WHERE po_trans_id='$users_id'";
             $approved = mysqli_query($link, $query) or die(mysqli_error($link));

             $showStatus = "<span class='label label-success'>Approved</span>";
             header("Location: PO-manage.php");
          }

      ?>


        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>

  <footer class="main-footer no-print">
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
<script>
function Print() {
  window.print();
}
</script>
</body>
</html>
