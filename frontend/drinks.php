<?php

require('backends/connection-pdo.php');

$sql = "SELECT * FROM food WHERE category = 'drink'";

$query  = $pdoconn->prepare($sql);

$query->execute();

$arr_all = $query->fetchAll(PDO::FETCH_ASSOC);



?>


<section class="fcategories">

    <div class="container">

        <?php

        if (isset($_SESSION['msg'])) {
            echo '<div class="section center" style="margin: 10px; padding: 3px 10px; margin-top: 35px; border: 2px solid black; border-radius: 5px; color: #101820FF; background-color: #F2AA4CFF">
						<p><b>' . $_SESSION['msg'] . '</b></p>
					</div>';

            unset($_SESSION['msg']);
        }
        ?>

        <div class="section white center">
            <h3 class="header">List Menu Minuman</h3>
        </div>

        <?php if (count($arr_all) == 0) {
            echo '<div class="section gray center" style="border: 1px solid black; border-radius: 5px;">
			<p class="header">Sorry No Categories to Display!</p>
		</div>';
        } else {  ?>

            <?php for ($i = 1; $i <= count($arr_all);) { ?>

                <div class="row">

                    <?php for ($j = 1; $j <= 3; $j++) { ?>


                        <?php if ($i + $j - 2 == count($arr_all)) {
                            break;
                        }  ?>

                        <div class="col s12 m4">
                            <div class="card" data-aos="zoom-in">
                                <div class="card-image waves-effect waves-block waves-light">
                                    <img class="activator" src="images/<?php echo $arr_all[$i + $j - 2]['filename']; ?>">
                                </div>
                                <div class="card-content">
                                    <span class="card-title activator grey-text text-darken-4"><a class="black-text" href=""><?php echo $arr_all[$i + $j - 2]['fname']; ?></a><i class="material-icons right">more_vert</i></span>
                                    <a class="black-text" href="">Harga : <?php echo $arr_all[$i + $j - 2]['price']; ?> Rupiah</a>
                                    <div class="card-content center">
                                        <a href="backends/order-food.php?id=<?php echo $arr_all[$i + $j - 2]['id']; ?>" style="background: #101820FF; color: #F2AA4CFF;" class="btn waves-effect waves-block waves-light" href="">Order Now!</a>
                                    </div>
                                </div>
                                <div class="card-reveal">
                                    <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i><?php echo $arr_all[$i + $j - 2]['fname']; ?></span>
                                    <p><?php echo $arr_all[$i + $j - 2]['description']; ?></p>
                                </div>
                            </div>
                        </div>

                    <?php } ?>

                    <?php $i = $i + 3; ?>


                </div>


        <?php
            }
        }
        ?>




    </div>

</section>