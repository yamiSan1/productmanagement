<?php
session_start();
if (!isset($_SESSION["userID"]))
{
    header("Location: ../account/login.php");
}
?>
<?php
require_once "../utile.php";
try {
    $pdo = UtilePersistance::connectDatabase("ProductManagement");
    $SQLstatment = "SELECT * FROM manageProduct WHERE userID = :userID;";
    $prepare_statment = $pdo->prepare($SQLstatment);
    $prepare_statment->execute([":userID"=>$_SESSION["userID"]]);
    $prd = $prepare_statment->fetchAll(PDO::FETCH_OBJ);
    $pdo=null;
} catch (\Throwable $th) {
    $msg = "";
}
$_SESSION["products"] = $prd;
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
    <title>Products</title>
    <style>
        .edit {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
        }
    </style>
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
                <li><i class="fa-solid fa-microchip"></i><a href="../manageCategory/index.php">Categories</a></li>
                <li><i class="fa-solid fa-laptop"></i><a href="index.php">Products</a></li>
                <li><i class="fa-solid fa-arrow-right-from-bracket"></i><a href="../account/logout.php">Log out</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="main-header">
            <h1>Products</h1>
            <h3><?=$_SESSION["username"]?>&sol;<a href="account.php">Products</a></h3>
        </section>
        <div class="container">
            <section class="edit">
                <?php foreach($prd as $pr):?>
                    <div class="categorycard">
                        <img src="<?=isset($pr->productImage)?$pr->productImage:"../img/cat.png"?>" alt="">
                        <div class="cardcontent">
                            <div class="desc">
                                <h4><?=$pr->productName?></h4>
                                <p>Price: <?=$pr->price?>MAD | Qte: <?=$pr->qte?></p>
                            </div>
                            <div class="operation">
                                <a href="modifyproduct.php?<?=http_build_query($pr)?>">Edit Product</a>
                                <a href="removeproduct.php?<?=http_build_query($pr)?>">Delete Product</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </section>
        </div>
    </main>
    <footer>Hand-crafted by yamiSAn1</footer>
    <script src="../js/main.js"></script>
</body>
</html>