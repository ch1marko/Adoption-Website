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

$sql = "SELECT * FROM animal WHERE age > 8 "; 
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
    <title>Welcome - <?php echo $row['first_name']; ?></title>
    <?php require_once 'components/boot.php' ?>
    <style>

         body{
            background-image: linear-gradient( 109.6deg,  rgba(45,116,213,1) 11.2%, rgba(121,137,212,1) 91.2% );
        }

    .userImage {
        width: 200px;
        height: 200px;
    }

    .hero {

background-color: beige;    }
    </style>
</head>

<body>

<?php require_once 'components/navbar.php' ?>

<div class="container-fluid m-0 p-0 text-center">
        <div class="hero p-4 mb-3">
            <div class ="row row-cols-4">
                <div class ="col">
                    <img class="userImage rounded-circle" src="picture/<?php echo $row['picture']; ?>" alt="<?php echo $row['first_name']; ?>">
                </div>
                <div class = "col">
                <h2 class="text-white mt-4"><strong class = "text-dark">Hi, &nbsp; <?php echo $row['first_name'] ?>!
                <p>Below is the list of vaccinated Animals</p>
                        </strong> </h2>
                </div>
            </div>
        </div>
    </div>
    <div class='mb-3 col-auto m-4'>
            <a href= "index.php"><button class='btn btn-dark'type="button" >Home</button></a>
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