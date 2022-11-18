<?php
session_start();

if (isset($_SESSION['user']) != "") {
    header("Location: ../home.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}

require_once '../components/db_connect.php';

if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM animal WHERE id = {$id}";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $name = $data['name'];
        $location = $data['location'];
        $dis = $data['dis'];
        $size = $data['size'];
        $age = $data['age'];
        $vaccinated = $data['vaccinated'];
        $breed = $data['breed'];
        $status = $data['status'];
        $picture = $data['picture'];
    } else {
        header("location: error.php");
    }
    mysqli_close($connect);
} else {
    header("location: error.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit </title>
    <?php require_once '../components/boot.php' ?>
    <style type="text/css">
    fieldset {
        margin: auto;
        margin-top: 100px;
        width: 60%;
    }

    .img-thumbnail {
        width: 70px !important;
        height: 70px !important;
    }
    </style>
</head>

<body>
    <fieldset>
        <legend class='h2'>Update request <img class='img-thumbnail rounded-circle' src='../picture/<?php echo $picture ?>' alt="<?php echo $name ?>"><?php echo $name ?></legend>
        <form action="actions/a_update.php" method="post" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <th>Name</th>
                    <td><input class="form-control" type="text" name="name" value="<?php echo $name ?>" /></td>
                </tr>
                <tr>
                    <th>Location</th>
                    <td><input class="form-control" type="text" name="location"   value="<?php echo $location ?>" /></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><input class="form-control" type="text" name="dis"   value="<?php echo $dis ?>" /></td>
                </tr>
                <th>Size</th>
                <td> <select name="size">
                        <option value="small">Small</option>
                        <option value="medium">Medium</option>
                        <option value="big">Big</option>
                    </select>
                </td>
                <tr>
                    <th>Age</th>
                    <td><input class='form-control' type="number" name="age" value="<?php echo $age ?>"/></td>
                </tr>
                <th>Vaccinated</th>
                <td> <select name="vaccinated" value="<?php echo $vaccinated ?>">
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </td>
                <tr>
                    <th>Breed</th>
                    <td><input class='form-control' type="text" name="breed" value="<?php echo $breed ?>"/></td>
                </tr>
                <tr>
                <th>Status</th>
                <td> <select name="status" value="<?php echo $status ?>">
                        <option value="Available">Available</option>
                        <option value="Adopted">Adopted</option>
                    </select>
                </td>
                </tr>
                <tr>
                    <th>Picture</th>
                    <td><input class="form-control" type="file" name="picture" value="<?php echo $picture ?>"/></td>
                </tr>

                <tr>
                    <input type="hidden" name="id" value="<?php echo $data['id'] ?>" />
                    <input type="hidden" name="picture" value="<?php echo $data['picture'] ?>" />
                    <td><button class="btn btn-success" type="submit">Save Changes</button></td>
                    <td><a href="index.php"><button class="btn btn-warning" type="button">Back</button></a></td>
                </tr>
            </table>
        </form>
    </fieldset>
</body>

</html>