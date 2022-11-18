<?php
session_start();

if (isset($_SESSION['user']) != "") {
    header("Location: ../../home.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../../index.php");
    exit;
}


require_once '../../components/db_connect.php';
require_once '../../components/file_upload.php';


if ($_POST) {
    $name = $_POST['name'];
    $live = $_POST['live'];
    $location = $_POST['location'];
    $dis = $_POST['dis'];
    $size = $_POST['size'];
    $age = $_POST['age'];
    $vaccinated = $_POST['vaccinated'];
    $breed = $_POST['breed'];
    $status = $_POST['status'];
    $id = $_POST['id'];

    $uploadError = '';

    $picture = file_upload($_FILES['picture']); 
    if ($picture->error === 0) {
        ($_POST["picture"] == "animal.png") ?: unlink("../../picture/$_POST[picture]");
        $sql = "UPDATE animal SET name = '$name', live = '$live', picture = '$picture->fileName', location = '$location', dis = '$dis', size = '$size', age = '$age', vaccinated = '$vaccinated', breed = '$breed', status = '$status'  WHERE id = {$id}";
    } else {
        $sql = "UPDATE animal SET name = '$name', live = '$live', location = '$location', dis = '$dis', size = '$size', age = '$age', vaccinated = '$vaccinated', breed = '$breed', status = '$status'  WHERE id = {$id}";
    }
    if (mysqli_query($connect, $sql) === TRUE) {
        $class = "success";
        $message = "The record was successfully updated";
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
        header("refresh:3;url= ../index.php");
    } else {
        $class = "danger";
        $message = "Error while updating record : <br>" . mysqli_connect_error();
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    }
    mysqli_close($connect);
} else {
    header("location: ../error.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update</title>
    <?php require_once '../../components/boot.php' ?>
</head>

<body>
    <div class="container">
        <div class="mt-3 mb-3">
            <h1>Update Request</h1>
        </div>
        <div class="alert alert-<?php echo $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
            <a href='../update.php?id=<?= $id; ?>'><button class="btn btn-warning" type='button'>Back</button></a>
            <a href='../index.php'><button class="btn btn-success" type='button'>Home</button></a>
        </div>
    </div>
</body>

</html>