<?php require('layout/header.php'); ?>
<?php require('layout/topnav.php'); ?>


<?php

require('../backends/connection-pdo.php');

$sql = 'SELECT id, fname, description, price, filename FROM food';

$query  = $pdoconn->prepare($sql);
$query->execute();
$arr_all = $query->fetchAll(PDO::FETCH_ASSOC);



?>
<style>
  table,
  td,
  th {
    border: 2px solid #F2AA4CFF;
  }
</style>

<div class="section white-text" style="background: #101820FF;">

  <div class="section">
    <h3 class="center-align" style="color: #F2AA4CFF;"><b>List Menu</b></h3>
  </div>

  <?php

  if (isset($_SESSION['msg'])) {
    echo '<div class="section center" style="margin: 5px 35px;"><div class="row" style="background: #F2AA4CFF; color: white; width: 10%; margin-left: auto; margin-right: auto; border-radius: 3px;">
        <div class="col s12">
            <h6><b>' . $_SESSION['msg'] . '</b></h6>
            </div>
        </div></div>';
    unset($_SESSION['msg']);
  }

  ?>

  <div class="section right" style="padding: 15px 25px;">
    <a href="food-add.php" class="waves-effect waves-light btn btnadd">Add New</a>
  </div>

  <div class="section center" style="padding: 20px;">
    <table class="centered responsive-table table table-striped table-bordered">
      <thead>
        <tr>
          <th>No</th>
          <th>Name</th>
          <th>Description</th>
          <th>Price</th>
          <th>Image</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>
        <?php
        $idx = 1;
        foreach ($arr_all as $key) {
        ?>
          <tr>
            <td><?php echo $idx; ?></td>
            <td><?php echo $key['fname']; ?></td>
            <td><?php echo $key['description']; ?></td>
            <td><?php echo $key['price']; ?></td>
            <td><img width="250" height="150" class="activator" src="../images/<?php echo $key['filename']; ?>"></td>
            <td><a href="food-edit.php?id=<?php echo $key['id']; ?>"><span class="new badge" data-badge-caption="" style="background-color: green;">Edit</span></a><br><br>
              <a href="../backends/admin/food-delete.php?id=<?php echo $key['id']; ?>"><span class="new badge" data-badge-caption="" style="background-color: red;">Delete</span></a>
            </td>
          </tr>
          <?php $idx++; ?>
        <?php } ?>

      </tbody>
    </table>
  </div>
</div>

<?php require('layout/about-modal.php'); ?>
<?php require('layout/footer.php'); ?>