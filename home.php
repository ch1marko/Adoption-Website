<?php
session_start();
require_once 'components/db_connect.php';


if (isset($_SESSION['adm'])) {
    header("Location: dashboard.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}


$res = mysqli_query($connect, "SELECT * FROM user WHERE id=" . $_SESSION['user']);
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);



$sql = "SELECT * FROM animal  WHERE status = 'Available'";
$result = mysqli_query($connect, $sql);
$tbody = '';
if (mysqli_num_rows($result) > 0) {
    while ($rowp = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $tbody .= "
    <div class = 'col-lg-4 col-md-6 col-sm-12 p-3'>
        <div class='card' style='width: 18rem;'>
            <img src='picture/" . $rowp['picture'] . "' class='card-img-top' alt='...'>
                <div class='card-body shadow-lg'>
                <h5 class='card-title'>" . $rowp['name'] . "</h5>
                <p class='card-text'><span class = 'fw-bold'>Live : </span>" . $rowp['live'] . "</p>
                <p class='card-text'><span class = 'fw-bold'>Location : </span>" . $rowp['location'] . "</p>
                <p class='card-text'><span class = 'fw-bold'>Status : </span>" . $rowp['status'] . "</p>
                <p class='card-text'><span class = 'fw-bold'>Vaccinated : </span>" . $rowp['vaccinated'] . "</p>
                <p class='card-text'><span class = 'fw-bold'>Description : </span>" . $rowp['dis'] . "</p>
                <p class='card-text'><span class = 'fw-bold'>Breed : </span>" . $rowp['breed'] . "</p>
                <p class='card-text'><span class = 'fw-bold'>Size : </span>" . $rowp['size'] . "</p>
                <p class='card-text'><span class = 'fw-bold'>Age : </span>" . $rowp['age'] . "</p>
                <a href='details.php?id=" . $rowp['id'] . "' class='btn btn-warning'>Details</a>
                <a href='adoption.php?id=" . $rowp['id'] . "' class='btn btn-primary'>Adopt Me</a>
            </div>
        </div>
    </div>";
    }
    ;
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
    <title>Welcome
        <?php echo $row['first_name']; ?>
    </title>
    <?php require_once 'components/boot.php' ?>
    <style>
        .userImage {
            width: 150px;
            height: 150px;
        }

        .hero {
            background-color: beige;
            background-position: cover;
        }
    </style>
</head>

<body>

    <?php require_once 'components/navbar.php' ?>

    <div class="container-fluid m-0 p-0 text-center border-bottom border-dark border-1" style="--bs-border-opacity: .3;">
        <div class="hero p-2">
            <div class="row">
                <div class="col-12">
                    <img class="userImage rounded-circle" src="picture/<?php echo $row['picture']; ?>"
                        alt="<?php echo $row['first_name']; ?>">
                    <h2 class="text-white mt-4"><strong class="text-dark">&nbsp; Nice to see you again,
                            <?php echo $row['first_name'] . " " . $row['last_name']; ?>!
                        </strong> </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex">
        <div class="col-auto m-4">

        </div>

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