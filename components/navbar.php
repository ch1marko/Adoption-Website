<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
</head>
<body>
        <nav class="navbar navbar-light bg-dark sticky-top navbar-expand-lg">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                            <a class="nav-link active text-light fw-bold" aria-current="page"
                            href="index.php">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-light fw-bold" aria-current="page"
                                href="senior.php?id=<?php echo $_SESSION['user'] ?>">Senior Animals</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link active text-light dropdown-toggle fw-bold" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Sizes
                            </a>
                            <ul class="dropdown-menu text-light">
                                <li><a class="dropdown-item" href="sort1.php">All Sizes</a></li>
                                <li><a class="dropdown-item" href="sort1.php?size=small">Small</a></li>
                                <li><a class="dropdown-item" href="sort1.php?size=medium">Medium</a></li>
                                <li><a class="dropdown-item" href="sort1.php?size=big">Big</a></li>
                            </ul>
                        </li>
                        <li class="nav-item fw-bold">
                            <a href="update.php?id=<?php echo $_SESSION['user'] ?>" class="nav-link active text-light">Update Profile</a>
                        </li>
                        <li class="nav-item fw-bold">
                            <a href="logout.php?logout"class="nav-link active text-light">Sign Out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    
</body>
</html>