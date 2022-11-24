<?php
session_start(); // start a new session or continues the previous
if (isset($_SESSION['user']) != "") {
    header("Location: home.php"); // redirects to home.php
}
if (isset($_SESSION['adm']) != "") {
    header("Location: dashboard.php"); // redirects to home.php
}
require_once 'components/db_connect.php';
require_once 'components/file_upload.php';
$error = false;
$fname = $lname = $email = $phone_number = $pass  = $address = $picture = '';
$fnameError = $lnameError = $emailError = $passError = $picError = '';
if (isset($_POST['btn-signup'])) {


    $fname = trim($_POST['first_name']);
    $fname = strip_tags($fname);
    $fname = htmlspecialchars($fname);

    $lname = trim($_POST['last_name']);
    $lname = strip_tags($lname);
    $lname = htmlspecialchars($lname);

    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['password']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);

    $address = trim($_POST['address']);
    $address = strip_tags($address);
    $address = htmlspecialchars($address);

    $phone_number = trim($_POST['phone_number']);
    $phone_number = strip_tags($phone_number);
    $phone_number = htmlspecialchars($phone_number);

    $uploadError = '';
    $picture = file_upload($_FILES['picture']);


    if (empty($fname) || empty($lname)) {
        $error = true;
        $fnameError = "Please enter your full name and surname";
    } else if (strlen($fname) < 3 || strlen($lname) < 3) {
        $error = true;
        $fnameError = "Name and surname must have at least 3 characters.";
    } else if (!preg_match("/^[a-zA-Z]+$/", $fname) || !preg_match("/^[a-zA-Z]+$/", $lname)) {
        $error = true;
        $fnameError = "Name and surname must contain only letters and no spaces.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address.";
    } else {

        $query = "SELECT email FROM user WHERE email='$email'";
        $result = mysqli_query($connect, $query);
        $count = mysqli_num_rows($result);
        if ($count != 0) {
            $error = true;
            $emailError = "Provided Email is already in use.";
        }
    }
    if (empty($pass)) {
        $error = true;
        $passError = "Please enter password.";
    } else if (strlen($pass) < 6) {
        $error = true;
        $passError = "Password must have at least 6 characters.";
    }
    $password = hash('sha256', $pass);
    if (!$error) {

        $query = "INSERT INTO user(first_name, last_name, password, email, picture , address, phone_number)
                    VALUES('$fname', '$lname', '$password', '$email', '$picture->fileName', '$address', '$phone_number')";
        $res = mysqli_query($connect, $query);

        if ($res) {
            $errTyp = "success";
            $errMSG = "Successfully registered, you may login now";
            $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
        } else {
            $errTyp = "danger";
            $errMSG = "Something went wrong, try again later...";
            $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
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
    <title>Login & Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <?php require_once 'components/boot.php' ?>

    <style>
        body {
            background-image: url("picture/cat13.jpg");
        }

        .container {
            margin-top: 7%;
            
        }

        .register {
            color: gray;
            font-family: Nunito;
        }
    </style>
</head>

<body>
    <div class="cont1 container border rounded border-dark p-2 w-50">
        <form class="w-100" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" enctype="multipart/form-data">
            <h2 class="register">Registration Form</h2>
            <hr />
            <?php
            if (isset($errMSG)) {
            ?>
                <div class="alert alert-<?php echo $errTyp ?>">
                    <p><?php echo $errMSG; ?></p>
                    <p><?php echo $uploadError; ?></p>
                </div>

            <?php
            }
            ?>

            <input type="text" name="first_name" class="form-control mb-1" placeholder="First Name" maxlength="50" value="<?php echo $fname ?>" />
            <span class="text-danger"> <?php echo $fnameError; ?> </span>

            <input type="text" name="last_name" class="form-control mb-1" placeholder="Last Name" maxlength="50" value="<?php echo $lname ?>" />
            <span class="text-danger"> <?php echo $fnameError; ?> </span>

            <input type="email" name="email" class="form-control mb-1" placeholder="E-mail" maxlength="40" value="<?php echo $email ?>" />
            <span class="text-danger"> <?php echo $emailError; ?> </span>
            <div class="d-flex">
                <input class='form-control w-100 mb-1' type="file" name="picture">
                <span class="text-danger"> <?php echo $picError; ?> </span>
            </div>
            <input type="password" name="password" class="form-control mb-1" placeholder="Password" maxlength="15" />
            <span class="text-danger"> <?php echo $passError; ?> </span>
            <input type="text" name="address" class="form-control mb-1" placeholder="Address" maxlength="100" value="<?php echo $address ?>" />
            <input type="number" name="phone_number" class="form-control" placeholder="Phone Number" maxlength="20" value="<?php echo $phone_number ?>" />
            <hr />
            <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Register</button>
            <hr />
            <a class="btn btn-success text-white" href="index.php">Sign In</a>
        </form>
    </div>
</body>

</html>