<?php require('layout/header.php'); ?>
<?php require('layout/topnav.php'); ?>


<?php

require('../backends/connection-pdo.php');
?>

<style>
    input[type=text] {
        color: white;
    }
</style>

<div class="section white-text" style="background: #101820FF;">

    <div class="section" style="color: #F2AA4CFF; text-align: center;">
        <h3><b>Add New Menu</b></h3>
    </div>


    <div class="section center" style="padding: 40px;">

        <form action="../backends/admin/food-add.php" method="post" enctype="multipart/form-data">

            <?php

            if (isset($_SESSION['msg'])) {
                echo '<div class="row" style="background: none; color: white;">
                <div class="col s12">
                    <h6>' . $_SESSION['msg'] . '</h6>
                    </div>
                </div>';
                unset($_SESSION['msg']);
            }

            ?>

            <div class="row">
                <div class="col s6">
                    <div class="input-field">
                        <input id="name" name="name" type="text" class="validate" style="color: white; width: 70%">
                        <label for="name" style="color: white;"><b>Food Name :</b></label>
                    </div>
                </div>
                <div class="col s6">
                    <div class="input-field" style="color: white !important; width: 70%">
                        <select name='category'>
                            <option value="food">Makanan</option>
                            <option value="drink">Minuman</option>
                        </select>
                        <label style="color: white;">Kategori</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <div class="input-field">
                        <input id="desc" name="desc" type="text" class="validate" style="color: white; width: 70%">
                        <label for="desc" style="color: white;"><b>Description :</b></label>
                    </div>

                </div>

            </div>
            <div class="row">
                <div class="col s12">
                    <div class="input-field">
                        <input id="price" name="price" type="number" class="validate" style="color: white; width: 70%">
                        <label for="price" style="color: white;"><b>Price :</b></label>
                    </div>

                </div>

            </div>
            <?php if (!empty($statusmsg)) { ?>
                <p class="status-msg"><?php echo $statusmsg; ?></p>
            <?php } ?>

            <div class="row">
                <div class="col s12">

                    <div class="input-field">
                        <b style="float: left;">Upload Image : </b>
                        <input accept=".png, .jpg, .jpeg" id="image" name="file" type="file" class="image" style="color: white; width: 28%; float:left; margin-left: 95px;">
                    </div>
                </div>
            </div>
            <br>
            <br>
            <br>
            <div class="row">
                <div class="col s12">
                    <div class="section right" style="padding: 15px 10px;">
                        <a href="food-list.php" class="waves-effect waves-light btn btndismiss">Dismiss</a>
                    </div>
                    <div class="section right" style="padding: 15px 20px;">
                        <button type="submit" value="submit" name="submit" class="waves-effect waves-light btn btnadd">Add New</button>
                    </div>
                </div>
            </div>

        </form>


    </div>

</div>

<?php require('layout/about-modal.php'); ?>
<?php require('layout/footer.php'); ?>