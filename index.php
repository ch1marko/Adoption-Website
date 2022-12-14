<?php
session_start();
require_once 'components/db_connect.php';

if (isset($_SESSION['user']) != "") {
    header("Location: home.php");
    exit;
}
if (isset($_SESSION['adm']) != "") {
    header("Location: dashboard.php");
}

$error = false;
$email = $password = $emailError = $passError = '';

if (isset($_POST['btn-login'])) {

    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['password']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);

    if (empty($email)) {
        $error = true;
        $emailError = "Please enter your email address.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address.";
    }

    if (empty($pass)) {
        $error = true;
        $passError = "Please enter your password.";
    }

    if (!$error) {

        $password = hash('sha256', $pass);

        $sql = "SELECT id, first_name, password, status FROM user WHERE email = '$email'";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($result);
        $count = mysqli_num_rows($result);
        if ($count == 1 && $row['password'] == $password) {
            if ($row['status'] == 'adm') {
                $_SESSION['adm'] = $row['id'];
                header("Location: dashboard.php");
            } else {
                $_SESSION['user'] = $row['id'];
                header("Location: home.php");
            }
        } else {
            $errMSG = "Incorrect Credentials, Try again...";
        }
    }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <?php require_once 'components/boot.php' ?>

    <style>
        body {
            background-image: url("picture/cat13.jpg");
        }

        .container {
            margin-top: 10%;
        }
    </style>

</head>

<body>
        <div class="container border rounded border-dark p-5 w-50">
            <form class="w-75" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
                <h1 style="color:gray; font-family: Nunito;">Please log-in or register</h1>
                <hr />
                <?php
                if (isset($errMSG)) {
                    echo $errMSG;
                }
                ?>

                <input type="email" autocomplete="off" name="email" class="form-control mb-2" placeholder="E-mail" value="<?php echo $email; ?>" maxlength="40" />
                <span class="text-danger"><?php echo $emailError; ?></span>

                <input type="password" name="password" class="form-control" placeholder="Password" maxlength="15" />
                <span class="text-danger"><?php echo $passError; ?></span>
                <hr />
                <button class="btn btn-block btn-primary" type="submit" name="btn-login">Sign In</button>
                <hr />
                <a class="btn btn-success" href="register.php">Register</a>
            </form>
        </div>
</body>

</html>