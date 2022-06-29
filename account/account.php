<?php
session_start();
if (!isset($_SESSION["userID"]))
{
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/fontawesome.min.css" integrity="sha512-xX2rYBFJSj86W54Fyv1de80DWBq7zYLn2z0I9bIhQG+rxIF6XVJUpdGnsNHWRa6AvP89vtFupEPDP8eZAtu9qA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style/style.css" type="text/css">
    <title>Profile</title>
</head>
<body>
    <header class="navbar">
        <nav>
            <div class="first">
                <div class="navmenu">
                    <div class="line1"></div>
                    <div class="line2"></div>
                    <div class="line3"></div>
                </div>
                <form class="searchfield" method="get" action="search.php">
                    <input type="text" placeholder="Search here" name="search">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
            <div class="first">
                <i class="fa-regular fa-bell"></i>
                <span></span>
                <img src="<?=isset($_SESSION["image"])?$_SESSION["image"]:"../img/profile.jpg"?>" alt="">
                <i style="color:#461457;" class="fa-solid fa-caret-down"></i>
            </div>
        </nav>
    </header>
    <header class="sidebar">
        <nav>
            <ul>
                <li><i class="fa-solid fa-gauge"></i><a href="#">Dashboard</a></li>
                <li><i class="fa-solid fa-microchip"></i><a href="../manageCategory/index.php">Categories</a></li>
                <li><i class="fa-solid fa-laptop"></i><a href="../manageProduct/index.php">Products</a></li>
                <li><i class="fa-solid fa-arrow-right-from-bracket"></i><a href="logout.php">Log out</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="main-header">
            <h1>Profile</h1>
            <h3><?=$_SESSION["username"]?>&sol;<a href="account.php">Profile</a></h3>
        </section>
        <div class="container">
            <section class="main-card">
                <div class="first">
                    <div class="second">
                        <img src="<?=isset($_SESSION["image"])?$_SESSION["image"]:"../img/profile.jpg"?>" alt="<?=$_SESSION["username"]?>">
                    </div>
                    <div class="second">
                        <h3><?=$_SESSION["username"]?></h3>
                        <h4><?=isset($_SESSION["title"])?$_SESSION["title"]:""?></h4>
                        <span><?=$_SESSION["useremail"]?></span>
                    </div>
                </div>
                <hr>
                <div class="first">
                    <div class="second">
                        <p>---</p>
                        <p>Products</p>
                    </div>
                    <div class="second">
                        <p>---</p>
                        <p>Categories</p>
                    </div>
                    <div class="second">
                        <p>---</p>
                        <p>Connections</p>
                    </div>
                </div>
            </section>
            <section id="content">
                <img src="../img/construction.png" alt="">
            </section>
        </div>
    </main>
    <footer>Hand-crafted by yamiSAn1</footer>
    <script src="../js/main.js"></script>
</body>
</html>