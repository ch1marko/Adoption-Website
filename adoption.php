<?php
session_start();


if (isset($_SESSION['adm'])) {
    header("Location: dashboard.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

require_once "components/db_connect.php";

$res = mysqli_query($connect, "SELECT * FROM user WHERE id=" . $_SESSION['user']);
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);

$result4 = mysqli_query($connect, "SELECT * FROM animal WHERE id =" . $_GET['id']);
$rowp = mysqli_fetch_array($result4, MYSQLI_ASSOC);

if (isset($_POST["submit"])) {
    $animal_id = $_GET["id"];
    $user_id = $_SESSION["user"];
    $date_adoption = $_POST["date_adoption"];

    $sql = "INSERT INTO adoption (date_adoption, fk_animal_id,  fk_user_id) VALUES ('$date_adoption', '$animal_id', '$user_id')";
    $sql2 = "UPDATE animal set status = 'Adopted' WHERE id = $animal_id";
    $result2 = mysqli_query($connect, $sql2);
    $result = mysqli_query($connect, $sql);
    if ($result && $result2) {
        echo "<h1>Successfully addopted! Congratulations!</h1>";
        mysqli_close($connect);
        header("refresh:3; url= home.php");
    } else {
        echo "Error";
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Adoption-
            <?php echo $row['first_name']; ?>
        </title>
        <?php require_once 'components/boot.php' ?>

        <style>
            body {

                background-image: linear-gradient(109.6deg, rgba(45, 116, 213, 1) 11.2%, rgba(121, 137, 212, 1) 91.2%);


            }

            .userImage {
                width: 200px;
                height: 200px;
            }

            .hero {}
        </style>
    </head>
</head>

<body>

    <?php require_once 'components/navbar.php' ?>


    <div class="container-fluid m-0 p-0 text-center">
        <div class="hero p-4 mb-3">
            <img class="userImage rounded-circle" src="picture/<?php echo $row['picture']; ?>"
                alt="<?php echo $row['first_name']; ?>">
            <h2 class="text-white mt-4"><strong class="text-light">&nbsp; Thank you for your interest ,
                    <?php echo $row['first_name'] . " " . $row['last_name']; ?>
                </strong> </h2>
            <a href="home.php?home" class="btn btn-light m-5 p-3">Home</a>
        </div>
    </div>
    <div class="container mt-3">
        <h1>Adoption</h1><br>
        <form method="POST">
            <img src="picture/<?php echo $rowp['picture']; ?>" class="img-thumbnail w-50">
            <h5 class="card-title">
                <?php echo 'Name : ' . $rowp['name']; ?>
            </h5>
            <p class="card-text">
                <?php echo '<p class = "fw-bold">Description:</p>' . $rowp['dis']; ?>
            </p>
            <p class="card-text">
                <?php echo '<p class = "fw-bold">Size:</p>' . $rowp['size']; ?>
            </p>
            <p class="card-text">
                <?php echo '<p class = "fw-bold">Age:</p>' . $rowp['age']; ?>
            </p>
            <h4>Adopt date start</h4><br>
            <input type="date" name="date_adoption">
            <input class="btn btn-dark m-5 p-3" type="submit" name="submit">
        </form>
    </div>

    <?php require_once 'components/footer.php' ?>

</body>

</html>