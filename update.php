<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL); 

session_start();
require_once 'components/db_connect.php';
require_once 'components/file_upload.php';
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

$backBtn = '';

if (isset($_SESSION["user"])) {
    $backBtn = "home.php";
}

if (isset($_SESSION["adm"])) {
    $backBtn = "dashboard.php";
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM user WHERE id = {$id}";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $first_name = $data['first_name'];
        $last_name = $data['last_name'];
        $password = $data['password'];
        $address = $data['address'];
        $status = $data['status'];
        $phone_number = $data['phone_number'];
        $email = $data['email'];
        $picture = $data['picture'];
    }
}

$class = 'd-none';
if (isset($_POST["submit"])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $id = $_POST['id'];
    $uploadError = '';
    $pictureArray = file_upload($_FILES['picture']);
    $picture = $pictureArray->fileName;
    if ($pictureArray->error === 0) {
        ($_POST["picture"] == "avatar.png") ?: unlink("picture/{$_POST["picture"]}");
        $sql = "UPDATE user SET first_name = '$first_name', last_name = '$last_name', email = '$email', password = '$password', address = '$address', phone_number = '$phone_number',  picture = '$pictureArray->fileName' WHERE id = {$id}";
    } else {
        $sql = "UPDATE user SET first_name = '$first_name', last_name = '$last_name', email = '$email', password = '$password', address = '$address', phone_number = '$phone_number' WHERE id = {$id}";
    }
    if (mysqli_query($connect, $sql) === true) {
        $class = "alert alert-success";
        $message = "The record was successfully updated";
        $uploadError = ($pictureArray->error != 0) ? $pictureArray->ErrorMessage : '';
        header("refresh:3;url=dashboard.php?id={$id}");
    } else {
        $class = "alert alert-danger";
        $message = "Error while updating record : <br>" . $connect->error;
        $uploadError = ($pictureArray->error != 0) ? $pictureArray->ErrorMessage : '';
    }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <?php require_once 'components/boot.php' ?>
    <style type="text/css">
        fieldset {
            margin: auto;
            width: 60%;
        }

        .img-thumbnail {
            width: 70px !important;
            height: 70px !important;
        }

        .container{
            background-color: #fdfdff;
        }
    </style>
</head>

<body>
    <div class="container border border-dark border-2 rounded p-3 mt-4">
        <div class="<?php echo $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
        </div>
        <h2>Update</h2>
        <img class='img-thumbnail rounded-circle' src='picture/<?php echo $data['picture'] ?>' alt="<?php echo $f_name ?>">
        <form method="post" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <th>First Name</th>
                    <td><input class="form-control" type="text" name="first_name" placeholder="First Name" value="<?php echo $first_name ?>" /></td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td><input class="form-control" type="text" name="last_name" placeholder="Last Name" value="<?php echo $last_name ?>" /></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><input class="form-control" type="email" name="email" placeholder="Email" value="<?php echo $email ?>" /></td>
                </tr>
                <tr>
                    <th>Password</th>
                    <td><input class="form-control" type="password" name="password" placeholder="***" value="<?php echo $password ?>" /></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><input class="form-control" type="address" name="address" placeholder="address" value="<?php echo $address ?>" /></td>
                </tr>
                <tr>
                    <th>Phone Number</th>
                    <td><input class="form-control" type="text" name="phone_number" placeholder="+43**" value="<?php echo $phone_number ?>" /></td>
                </tr>
                <tr>
                    <th>Picture</th>
                    <td><input class="form-control" type="file" name="picture" /></td>
                </tr>
                <tr>
                    <input type="hidden" name="id" value="<?php echo $data['id'] ?>" />
                    <input type="hidden" name="picture" value="<?php echo $picture ?>" />
                    <td><button name="submit" class="btn btn-success" type="submit">Save Changes</button></td>
                    <td><a href="<?php echo $backBtn ?>"><button class="btn btn-warning" type="button">Back</button></a></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>