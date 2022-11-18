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
if (mysqli_num_rows($result)   > 0) {
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
    <title>Welcome<?php echo $row['first_name']; ?></title>
    <?php require_once 'components/boot.php' ?>
    <style>
    .userImage {
        width: 150px;
        height: 150px;
    }

    .hero {
       background-color: beige;
    }
    </style>
</head>

<body>
    <div class="container-fluid m-0 p-0 text-center">
        <div class="hero p-4 mb-3">
            <div class ="row">
                <div class ="col-8">
                    <img class="userImage rounded-circle" src="picture/<?php echo $row['picture']; ?>" alt="<?php echo $row['first_name']; ?>">
                    <h2 class="text-white mt-4"><strong class = "text-dark">&nbsp; Nice to see you again, 
                        <?php echo $row['first_name'] . " " . $row['last_name']; ?></strong> </h2>
                </div>
                <div class ="col-4">
                    <a href="logout.php?logout" class="btn btn-danger">Sign Out</a>
                    <a href="update.php?id=<?php echo $_SESSION['user'] ?>" class="btn btn-success">Update Profile</a>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex">
    <div class="col-auto m-4">
    <a href="senior.php?id=<?php echo $_SESSION['user'] ?>" class="btn btn-dark">Sort Age</a>
    </div>
    <div class="dropdown col-auto m-4">
        <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
        Sort Vaccinated
        </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="sort.php">All</a></li>
                <li><a class="dropdown-item" href="sort.php?vaccinated=Yes">Vaccinated</a></li>
                <li><a class="dropdown-item" href="sort.php?vaccinated=No">Not Vaccinated</a></li>
            </ul>
        </div>
        <div class="dropdown col-auto m-4">
            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            Sort Size
            </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="sort1.php">All Size</a></li>
                    <li><a class="dropdown-item" href="sort1.php?size=small">small</a></li>
                    <li><a class="dropdown-item" href="sort1.php?size=medium">medium</a></li>
                    <li><a class="dropdown-item" href="sort1.php?size=big">big</a></li>
                </ul>
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