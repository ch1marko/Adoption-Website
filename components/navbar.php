<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        .navbar {
            font-family: Nunito;
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-light bg-black sticky-top navbar-expand-lg">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active fs-4" aria-current="page" style="color:gray; font-weight:900;" href="index.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fs-5" aria-current="page" style="color:gray; font-weight:800;" href="senior.php?id=<?php echo $_SESSION['user'] ?>">Senior Animals</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle fs-5" style="color:gray; font-weight:800;" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Sizes
                        </a>
                        <ul class="dropdown-menu" style="color:gray; font-weight:800;">
                            <li><a class="dropdown-item" href="sort1.php">All Sizes</a></li>
                            <li><a class="dropdown-item" href="sort1.php?size=small">Small</a></li>
                            <li><a class="dropdown-item" href="sort1.php?size=medium">Medium</a></li>
                            <li><a class="dropdown-item" href="sort1.php?size=big">Big</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="update.php?id=<?php echo $_SESSION['user'] ?>" class="nav-link active fs-5" style="color:gray; font-weight:800;">Update Profile</a>
                    </li>
                    <li class="nav-item fw-bold">
                        <a href="logout.php?logout" class="nav-link active fs-5" style="color:#992E23; font-weight:800;">Sign Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</body>

</html>