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

$supplier_address="";

require_once "config.php";

$users_id = $_GET['id'];


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
    <body>

      <table>
        <th>
          <tr>
            <td>PO ID</td>
            <td>Qty</td>
            <td>Unit</td>
            <td>Description</td>
            <td>Unit Price</td>
            <td>Total Amount</td>
          </tr>
        </th>
        <tbody>
          <?php
          $query = "SELECT request_po.po_trans_id,po_transactions.supplier_name, suppliers.supplier_address, request_po.po_qty, request_po.po_unit, request_po.po_unit_price, request_po.po_description, request_po.po_unit_price, request_po.po_total_amount,po_transactions.inv_date, po_transactions.paymentTerms, po_transactions.totalPrice, request_po.user from suppliers " .
           "INNER JOIN po_transactions ON suppliers.supplier_name = po_transactions.supplier_name ".
           "INNER JOIN request_po ON po_transactions.po_trans_id = request_po.po_trans_id WHERE po_transactions.po_trans_id = $users_id";

          $result = mysqli_query($link, $query) or die(mysqli_error($link));
          if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)){
                  $totalPrice  =  $row['totalPrice'];
            echo "<tr>";
                echo "<td>" .$row['po_trans_id'] . "</td>";
                echo "<td>" .$row['po_qty'] . "</td>";
                echo "<td>" . $row['po_unit'] . "</td>";
                echo "<td>" . $row['po_description'] . "</td>";
                echo "<td>" . $row['po_unit_price'] . "</td>";
                echo "<td>" . $row['po_total_amount'] . "</td>";
            echo "</tr>";

          }
          // Free result set
          mysqli_free_result($result);
        } else{
          echo "<p class='lead'><em>No records were found.</em></p>";
        }

            ?>
            <tr>
              <td>Total Amount : </td>
              <td><?php echo $totalPrice; ?> </td>
            </tr>
        </tbody>

      </table>

    </body>
    </html>
