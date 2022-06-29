<?php

session_start();
require_once "../utile.php";

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    if(isset($_POST['edit'])) {
        $description=$categoryname="";
        if (isset($_POST["description"]))
        {
            $description = UtilePersistance::cleanInput($_POST["description"]);
        }
        if (isset($_POST["categoryName"]))
        {
            $categoryname = UtilePersistance::cleanInput($_POST["categoryName"]);
        }
        $query = "UPDATE manageCategory SET categoryImage = ? WHERE userID = ? AND categoryName = ? ;";
            $pdo = UtilePersistance::connectDatabase("ProductManagement");
            $statement = $pdo->prepare($query);
            $filename = $_FILES['catimage']['name'];
            // Location
            $target_file = '../uploads/categories/'.$filename;
            // file extension
            $file_extension = pathinfo(
                $target_file, PATHINFO_EXTENSION);
            $file_extension = strtolower($file_extension);
            // Valid image extension
            $valid_extension = array("png","jpeg","jpg");
            if(in_array($file_extension, $valid_extension)) {
                // Upload file
                    if(move_uploaded_file(
                        $_FILES['catimage']['tmp_name'],
                        $target_file)
                    ) {
                        // Execute query
                        $statement->execute(array($target_file,$_SESSION["userID"],$categoryname));
                        $pdo = null;
                    }
            }
        if (!empty($description) && !empty($categoryname))
        {
            try {
                $pdo = UtilePersistance::connectDatabase("ProductManagement");
                $SQLstatment = "UPDATE manageCategory SET categoryDesc = :categoryDesc WHERE userID = :userID AND categoryName = :categoryName;";
                $prepare_statment = $pdo->prepare($SQLstatment);
                $prepare_statment->execute([":categoryDesc"=>$description,":userID"=>$_SESSION["userID"],":categoryName"=>$categoryname]);
                $pdo=null;
                header("Location: index.php");
            } catch (\Throwable $th) {
                $msg = "User already exists";
            }
            
        }
        else {
            $msg = "All inputs are required";
        }
    }
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
    <title>Edit Category</title>
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
                <img src="<?=isset($_SESSION['image'])?$_SESSION['image'] :'../img/profile.jpg'?>" alt="">
                <i style="color:#461457;" class="fa-solid fa-caret-down"></i>
            </div>
        </nav>
    </header>
    <header class="sidebar">
        <nav>
            <ul>
                <li><i class="fa-solid fa-gauge"></i><a href="../account/account.php">Dashboard</a></li>
                <li><i class="fa-solid fa-microchip"></i><a href="index.php">Categories</a></li>
                <li><i class="fa-solid fa-laptop"></i><a href="../manageProduct/index.php">Products</a></li>
                <li><i class="fa-solid fa-arrow-right-from-bracket"></i><a href="../account/logout.php">Log out</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="main-header">
            <h1>Edit Category</h1>
            <h3><?=$_SESSION["username"]?>&sol;<a href="account.php">editCategory</a></h3>
        </section>
        <div class="container">
            <section class="edit">
                <form action="<?=htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST" enctype="multipart/form-data">
                    <input type='file' name='catimage' style="background-image:url(<?=isset($_GET["categoryImage"])?$_GET["categoryImage"]:"../img/cat.png"?>); background-repeat:no-repeat; background-size: cover; background-position: center">
                    <input type="text" name="categoryName" value="<?=isset($_GET["categoryName"])?$_GET["categoryName"]:""?>" readonly>
                    <textarea placeholder="Description" name="description"><?=isset($_GET["categoryDesc"])?$_GET["categoryDesc"]:""?></textarea>
                    <input type='submit' value='Edit Category' name='edit' />
                </form>
            </section>
        </div>
    </main>
    <?php
        if (isset($msg)):
    ?>
        <div id="alert" style="width: 300px; height: auto; padding: 10px 0px; background-color: rgb(141, 14, 14); color: white; text-align: center; font-size: 1em; position:absolute; bottom: 5px; left: 5px;">
            <?=$msg?>
        </div>
    <?php
        endif
    ?>
    <footer>Hand-crafted by yamiSAn1</footer>
    <script src="../js/main.js"></script>
</body>
</html>