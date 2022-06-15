<?php
session_start();
$msg_error = '';
if (isset($_SESSION['msg'])) {
    $msg_error = $_SESSION['msg'];
    unset($_SESSION['msg']);
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/form-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.css">
    <title>Login Admin</title>
</head>
<style>
    body {
        background-image: url("../images/admin.png");
        background-size: 100% 100%;
        background-attachment: fixed;
    }

    .admin {
        border-radius: 5px;
        background-image: url("../images/admin1.jpg");
        background-size: 100% 100%;
    }

    b {
        color: white;
    }

    input {
        color: white;
    }
</style>

<body>
    <div class="login-page section">
        <div class="row">
            <div class="col s12">
                <div class="container">
                    <div class="container">
                        <div class="container">
                            <div class="card horizontal hoverable admin">
                                <div class="card-stacked">
                                    <form class="card-content" action="login-admin.php" method="post">
                                        <h4 style="text-align: center; color: white;"><b>Login as Admin</b></h4>

                                        <div class="row">
                                            <div class="input-field col s12">
                                                <span for="email"><b>Email</b></span>
                                                <input name="email" id="email" type="email" class="validate">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="input-field col s12">
                                                <span for="email"><b>Password</b></span>
                                                <input id="password" name="password" type="password" class="validate">
                                            </div>
                                        </div>
                                        <?php
                                        if (!empty($msg_error)) {
                                            echo '<div class="row error-msg" style="color: red;">
                                                            <div class="col">
                                                                <b>' . $msg_error . '</b>
                                                            </div>
                                                        </div>';
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col s12">
                                                <button type="submit" class="waves-effect waves-light btn"><b>Login</b></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https: //cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.js"></script>
</body>

</html>