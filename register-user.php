<?php
// Include config file
require_once "configs.php";

date_default_timezone_set("Asia/Jakarta");

// Define variables and initialize with empty values
$firstname = $lastname = $tanggallahir = $gender = $email = $password = $confirm_password = "";
$firstname_err = $lastname_err = $tanggallahir_err = $gender_err = $email_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate firstname
    if (empty(trim($_POST["firstname"]))) {
        $firstname_err = "Nama depan harus diisi";
    } else {
        $firstname = trim($_POST["firstname"]);
    }

    // Validate lastname
    if (empty(trim($_POST["lastname"]))) {
        $lastname_err = "Nama belakang harus diisi";
    } else {
        $lastname = trim($_POST["lastname"]);
    }

    // Validate tanggal lahir
    if (empty(trim($_POST["tanggallahir"]))) {
        $tanggallahir_err = "Tanggal lahir harus diisi";
    } else {
        $tanggallahir = trim($_POST["tanggallahir"]);
    }

    // Validate gender
    if (empty(trim($_POST["gender"]))) {
        $gender_err = "Jenis kelamin harus diisi";
    } else {
        $gender = trim($_POST["gender"]);
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Email harus diisi";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $email_err = "email sudah diambil.";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Silahkan coba lagi.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Password harus diisi";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password minimal 6 karakter";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Mohon lakukan konfirmasi password";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password tidak cocok";
        }
    }

    // Check input errors before inserting in database
    if (empty($firstname_err) && empty($lastname_err) && empty($tanggallahir_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO users (firstname, lastname, tanggallahir, jeniskelamin, email, password, timestamp) VALUES (?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssss", $param_firstname, $param_lastname, $param_tanggal, $param_gender, $param_email, $param_password, $param_timest);

            // Set parameters
            $param_timest = date("d:m:Y h:i:sa");
            $param_firstname = $firstname;
            $param_lastname = $lastname;
            $param_email = $email;
            $param_tanggal = $tanggallahir;
            $param_gender = $gender;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: index.php");
            } else {
                echo "Silahkan coba lagi";
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
    <title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body {
            font: 14px sans-serif;
            background-image: url("images/wallpaper.jpg");
            background-size: 100% 100%;
            background-attachment: fixed;
        }

        .wrapper {
            width: 360px;
            padding: 20px;
            margin-left: 36%;
            margin-top: 8px;
            background-image: url("images/register.png");
            background-repeat: no-repeat;
            color: white;
            border-radius: 5px;
            background-size: 100% 100%;
            background-attachment: fixed;
        }

        h4 {
            text-align: center;
        }
    </style>
</head>

<body style="box-sizing: border-box;">
    <div class="wrapper" style="border: 1px solid black;">
        <h4>Halaman Register</h4><br><br>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">
                <label>First Name</label>
                <input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>">
                <span class="help-block"><?php echo $firstname_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
                <label>Last Name</label>
                <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>">
                <span class="help-block"><?php echo $lastname_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($tanggallahir_err)) ? 'has-error' : ''; ?>">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggallahir" class="form-control" value="<?php echo $tanggallahir; ?>">
                <span class="help-block"><?php echo $tanggallahir_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($gender)) ? 'has-error' : ''; ?>">
                <label>Jenis Kelamin</label><br>
                <input type="radio" name="gender" checked <?php if (isset($gender) && $gender == "laki-laki") echo "checked"; ?> value="laki-laki"> Laki-laki
                <input type="radio" name="gender" <?php if (isset($gender) && $gender == "perempuan") echo "checked"; ?> value="perempuan"> Perempuan
            </div>
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-default" value="REGISTER" style="margin-left: 37%;">
            </div>
            <p style="margin-left:10%">Already have an account? <a href="login-user.php">Login here</a>.</p>
        </form>
    </div>
</body>

</html>