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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once '../components/boot.php' ?>
    <title>Add animal</title>
    <style>
    fieldset {
        margin: auto;
        margin-top: 100px;
        width: 60%;
    }
    </style>
</head>

<body>
    <fieldset>
        <legend class='h2'>Add Animal</legend>
        <form action="actions/a_create.php" method="post" enctype="multipart/form-data">
            <table class='table'>
                <tr>
                    <th>Name</th>
                    <td><input class='form-control' type="text" name="name" placeholder="Name" /></td>
                </tr>
                <tr>
                    <th>Live</th>
                    <td><input class='form-control' type="text" name="live" placeholder="live"/></td>
                </tr>
                <tr>
                    <th>location</th>
                    <td><input class='form-control' type="text" name="location" placeholder="location"/></td>
                </tr>
                <tr>
                    <th>dis</th>
                    <td><input class='form-control' type="text" name="dis" placeholder="dis"/></td>
                </tr>
                <th>Size</th>
                <td> <select name="size">
                        <option value="small">small</option>
                        <option value="medium">medium</option>
                        <option value="big">big</option>
                    </select>
                </td>
                <tr>
                    <th>Age</th>
                    <td><input class='form-control' type="number" name="age" placeholder="**"/></td>
                </tr>
                <th>Vaccinated</th>
                <td> <select name="vaccinated">
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </td>
                <tr>
                    <th>Breed</th>
                    <td><input class='form-control' type="text" name="breed" placeholder="breed"/></td>
                </tr>
                <tr>
                    <th>Picture</th>
                    <td><input class='form-control' type="file" name="picture" /></td>
                </tr>
                <th>Status</th>
                <td> <select name="status">
                        <option value="Available">Available</option>
                        <option value="Adopted">Adopted</option>
                    </select>
                </td>
                <tr>
                    <td><button class='btn btn-success' type="submit">Add To List</button></td>
                    <td><a href="index.php"><button class='btn btn-warning' type="button">Home</button></a></td>
                </tr>
            </table>
        </form>
    </fieldset>
</body>

</html>