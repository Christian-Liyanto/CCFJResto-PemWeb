<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
// if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
//     header("location: index.php");
//     exit;
// }

// Include config file
require_once "configs.php";

// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if email is empty
    if (empty(trim($_POST["email"]))) {
        $email_err = "Masukkan email Anda";
    } else {
        $email = trim($_POST["email"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Masukkan password Anda";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($email_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, firstname, email, password FROM users WHERE email = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set parameters
            $param_email = $email;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if email exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $firstname, $email, $hashed_password);
                    if (isset($_POST['send'])) {
                        if ($_SESSION['captcha'] == $_POST['captcha']) {
                            if (mysqli_stmt_fetch($stmt)) {
                                if (password_verify($password, $hashed_password)) {
                                    // Password is correct, so start a new session
                                    session_start();

                                    // Store data in session variables
                                    $_SESSION["loggedin"] = true;
                                    $_SESSION["id"] = $id;
                                    $_SESSION["firstname"] = $firstname;
                                    $_SESSION["email"] = $email;

                                    // Redirect user to welcome page
                                    header("location: index.php");
                                } else {
                                    // Display an error message if password is not valid
                                    $password_err = "Email/Password Anda salah";
                                }
                            }
                        } else {
                            echo '<script type="text/javascript">';
                            echo 'alert("Kode Captcha Salah!")';
                            echo '</script>';
                        }
                    }
                } else {
                    // Display an error message if email doesn't exist
                    $email_err = "Akun tidak terdaftar";
                }
            } else {
                echo "Silahkan coba lagi.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body {
            font: 14px sans-serif;
            background-image: url("images/login-user1.png");
        }

        .wrapper {
            width: 350px;
            padding: 20px;
            margin-left: 36%;
            margin-top: 5%;
            border-radius: 5px;
            background-image: url("images/login-user.jpg");
            background-size: 100% 100%;
            background-attachment: fixed;
        }

        h4 {
            text-align: center;
        }
    </style>
</head>

<body style="box-sizing: border-box;">
    <div class="wrapper" style="border: 1px solid black; background-color: white;">
        <h4>Halaman Login</h4><br><br>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div><br>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <br>
                <label>Captcha</label><br>
                <img src="captcha.php" style="width: 80%; height: 20%; border-radius: 5px;">
                <input type="text" name="captcha" maxlength="6" class="form-control" style="margin-top: 10px;">
                <input type="submit" class="btn btn-default" value="Login" name="send" style="margin-left: 40%; margin-top: 20px">
            </div>
            <p style="margin-left:10%">Don't have an account? <a href="register-user.php">Register here</a>.</p>
        </form>
    </div>
</body>

</html>