<?php require('layout/header.php'); ?>
<?php require('layout/topnav.php'); ?>



<?php

require('../backends/connection-pdo.php');

$sql = 'SELECT orders.order_id, orders.user_name, orders.timestamp, food.fname, food.price FROM orders LEFT JOIN food ON orders.food_id = food.id';

$query  = $pdoconn->prepare($sql);
$query->execute();
$arr_all = $query->fetchAll(PDO::FETCH_ASSOC);



?>

<body style="background: #101820FF;">
  <div class="section white-text">

    <div class="section">
      <h3 class="center-align" style="color: #F2AA4CFF;"><b>Order List</b></h3>
    </div>

    <?php

    if (isset($_SESSION['msg'])) {
      echo '<div class="section center" style="margin: 5px 35px;"><div class="row" style="background: none; color: white;">
      <div class="col s12">
          <h6>' . $_SESSION['msg'] . '</h6>
          </div>
      </div></div>';
      unset($_SESSION['msg']);
    }

    ?>
    <style>
      table,
      td,
      th {
        border: 2px solid #F2AA4CFF;
      }
    </style>
    <div class="section center" style="padding: 20px;">
      <table class="centered responsive-table table table-striped table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>Order ID</th>
            <th>Email User</th>
            <th>Food Name</th>
            <th>Price</th>
            <th>Timestamp</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
          <?php
          $idx = 1;
          foreach ($arr_all as $key) {

          ?>
            <tr>
              <td><?php echo $idx ?></td>
              <td><?php echo $key['order_id']; ?></td>
              <td><?php echo $key['user_name']; ?></td>
              <td><?php echo $key['fname']; ?></td>
              <td><?php echo $key['price']; ?></td>
              <td><?php echo $key['timestamp']; ?></td>
              <td><a href="../backends/admin/order-delete.php?id=<?php echo $key['order_id']; ?>"><span class="new badge btndismiss" data-badge-caption="">Delete</span></a></td>
            </tr>
            <?php $idx++ ?>
          <?php } ?>

        </tbody>
      </table>
    </div>
  </div>
</body>


<?php require('layout/about-modal.php'); ?>
<?php require('layout/footer.php'); ?>