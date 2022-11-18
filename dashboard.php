<?php
session_start();
require_once 'components/db_connect.php';

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

if (isset($_SESSION["user"])) {
    header("Location: home.php");
    exit;
}


$res = mysqli_query($connect, "SELECT * FROM user WHERE id=" . $_SESSION['adm']);
$rowd = mysqli_fetch_array($res, MYSQLI_ASSOC);

$id = $_SESSION['adm'];
$status = 'adm';
$sql = "SELECT * FROM user WHERE status != '$status'";
$result = mysqli_query($connect, $sql);

$tbody = '';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $tbody .= "<tr>
            <td class ='text-center'><img class='img-thumbnail rounded-circle' src='picture/" . $row['picture'] . "' alt=" . $row['first_name'] . "></td>
            <td class ='text-center'>" . $row['first_name'] . " " . $row['last_name'] . "</td>
            <td class ='text-center'>" . $row['email'] . "</td>
            <td class ='text-center'><a href='update.php?id=" . $row['id'] . "'><button class='btn btn-primary btn-sm' type='button'>Edit</button></a>
            <a href='delete.php?id=" . $row['id'] . "'><button class='btn btn-danger btn-sm' type='button'>Delete</button></a></td>
            </tr>";
    }
} else {
    $tbody = "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator</title>
    <?php require_once 'components/boot.php' ?>
    <style type="text/css">
    .img-thumbnail {
        width: 100px !important;
        height: 100px !important;
    }

    td {
        text-align: left;
        vertical-align: middle;
    }

    tr {
        text-align: center;
    }

    .userImage {
        width: 150px;
        height: auto;
    }
    .hero {
background: beige; 

    }
    </style>
</head>

<body>
<div class="hero p-3 mb-3 text-center">
    <img class="userImage" src="picture/admavatar.png" alt="admavatar">
    <p class="text-dark fs-2">Administrator <?php echo $rowd['first_name'] . " " . $rowd['last_name']; ?></p>
    <a href="animal/index.php" class="btn btn-success m-1">Animals</a>
    <a href="logout.php?logout" class="btn btn-danger m-1">Logout</a>
</div>
<div class="container">
    <div class="mt-1">
        <p class='h2'>Users</p>
        <table class='table table-hover'>
            <thead class='table-light'>
                <tr>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?= $tbody ?>
            </tbody>
        </table>
    </div>
</div>
</body>

</html>