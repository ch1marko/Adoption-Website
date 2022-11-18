<?php
session_start();
require_once '../components/db_connect.php';

if (isset($_SESSION['user']) != "") {
    header("Location: ../home.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}
$res = mysqli_query($connect, "SELECT * FROM user WHERE id=" . $_SESSION['adm']);
$rowd = mysqli_fetch_array($res, MYSQLI_ASSOC);


$sql = "SELECT * FROM animal ";
$result = mysqli_query($connect, $sql);
$tbody = '';
if (mysqli_num_rows($result)  > 0) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $tbody .= "<div class = 'col-lg-4 col-md-6 col-sm-12 p-3'>
        <div class='card' style='width: 18rem;'>
            <img src='../picture/" . $row['picture'] . "' class='card-img-top' alt='...'>
                <div class='card-body shadow-lg'>
                <h5 class='card-title'>" . $row['name'] . "</h5>
                <p class='card-text'><span class = 'fw-bold'>Live : </span>" . $row['live'] . "</p>
                <p class='card-text'><span class = 'fw-bold'>Location : </span>" . $row['location'] . "</p>
                <p class='card-text'><span class = 'fw-bold'>Status : </span>" . $row['status'] . "</p>
                <p class='card-text'><span class = 'fw-bold'>Vaccinated : </span>" . $row['vaccinated'] . "</p>
                <p class='card-text'><span class = 'fw-bold'>Description : </span>" . $row['dis'] . "</p>
                <p class='card-text'><span class = 'fw-bold'>Breed : </span>" . $row['breed'] . "</p>
                <p class='card-text'><span class = 'fw-bold'>Size : </span>" . $row['size'] . "</p>
                <p class='card-text'><span class = 'fw-bold'>Age : </span>" . $row['age'] . "</p>
                <a href='update.php?id=" . $row['id'] . "'><button class='btn btn-primary btn-sm' type='button'>Edit</button></a>
                <a href='delete.php?id=" . $row['id'] . "'><button class='btn btn-danger btn-sm' type='button'>Delete</button></a>
            </div>
        </div>
    </div>";
    };
} else {
    $tbody =  "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <?php require_once '../components/boot.php' ?>
    <style type="text/css">
    .img-thumbnail {
        width: 70px !important;
        height: 70px !important;
    }

    td {
        text-align: left;
        vertical-align: middle;
    }

    tr {
        text-align: center;
    }

    .userImage {
        width: 100px;
        height: auto;
    }
    .hero {
background: #4c4c4c; 
background: -moz-linear-gradient(top,  #4c4c4c 0%, #595959 12%, #666666 25%, #474747 39%, #2c2c2c 50%, #000000 51%, #111111 60%, #2b2b2b 76%, #1c1c1c 91%, #131313 100%);
background: -webkit-linear-gradient(top,  #4c4c4c 0%,#595959 12%,#666666 25%,#474747 39%,#2c2c2c 50%,#000000 51%,#111111 60%,#2b2b2b 76%,#1c1c1c 91%,#131313 100%); 
background: linear-gradient(to bottom,  #4c4c4c 0%,#595959 12%,#666666 25%,#474747 39%,#2c2c2c 50%,#000000 51%,#111111 60%,#2b2b2b 76%,#1c1c1c 91%,#131313 100%);

    }
    </style>
</head>

<body>

<div class="hero p-4 mb-3 text-center">
    <img class="userImage" src="../picture/admavatar.png" alt="admavatar">
    <p class="text-warning">Administrator <?php echo $rowd['first_name'] . " " . $rowd['last_name']; ?></p>
</div>

    <div class="manageProduct w-75 mt-3">
        <div class='m-4'>
            <a href="create.php"><button class='btn btn-primary' type="button">Add </button></a>
            <a href="../dashboard.php"><button class='btn btn-success' type="button">Dashboard</button></a>
        </div>
    </div>
    <div class="container">
        <p class='h2'>Animal</p>
            <div class="container">
                <div class="row">
                <?= $tbody; ?>
                </div>
            </div>
    </div>
</body>

</html>