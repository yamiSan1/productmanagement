<?php
session_start();
if (!isset($_SESSION["userID"]))
{
    header("Location: ../account/login.php");
}
?>
<?php
    require_once "../utile.php";

    if ($_SERVER["REQUEST_METHOD"] === "POST")
    {
        if (isset($_POST["add"]))
        {
            $productname=$price=$qte=$categoryID="";
            $productname_err=$price_err=$qte_err=$categoryID_err="";
            if (isset($_POST["productname"]))
            {
                $productname = UtilePersistance::cleanInput($_POST["productname"]);
            }
            else
            {
                $productname_err = "INVALID PRODUCT NAME";
            }
            if (isset($_POST["price"]))
            {
                $price = UtilePersistance::cleanInput($_POST["price"]);
            }
            else
            {
                $price_err = "INVALID PRODUCT PRICE";
            }
            if (isset($_POST["qte"]))
            {
                $qte = UtilePersistance::cleanInput($_POST["qte"]);
            }
            else
            {
                $qte_err = "INVALID PRODUCT QTE";
            }
            if (isset($_POST["categoryID"]))
            {
                $categoryID = UtilePersistance::cleanInput($_POST["categoryID"]);
            }
            else
            {
                $categoryID_err = "INVALID PRODUCT : CATEGORY NOT EXISTS";
            }
            if (!empty($productname) && !empty($price) && !empty($qte) && !empty($categoryID))
            {
                try {
                    $pdo = UtilePersistance::connectDatabase("ProductManagement");
                    $SQLstatment = "INSERT INTO manageProduct(productName,price,qte,categoryID,userID) VALUES (:productName,:price,:qte,:categoryID,:userID);";
                    $prepare_statment = $pdo->prepare($SQLstatment);
                    $prepare_statment->bindParam(":productName",$productname);
                    $prepare_statment->bindParam(":price",$price);
                    $prepare_statment->bindParam(":qte",$qte);
                    $prepare_statment->bindParam(":categoryID",$categoryID);
                    $prepare_statment->bindParam(":userID",$_SESSION["userID"]);
                    $prepare_statment->execute();
                    $pdo=null;
                } catch (\Throwable $th) {
                    $msg = "Product already exists";
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
    <title>Product Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="../style/form.css" type="text/css" rel="stylesheet">
</head>
<body id="categoryproduct">
    <main>
        <div id="logincard">
            <form action="<?=htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
                <h1>Add Product</h1>
                <h5>Add new product to your account</h5>
                <div class="inputfield form-floating">
                    <input type="text" class="form-control" placeholder="Product Name" name="productname" id="productname">
                    <label for="productname">Product Name</label>
                </div>
                <div class="inputfield form-floating">
                    <input type="text" class="form-control" placeholder="Price" name="price" id="price">
                    <label for="price">Price</label>
                </div>
                <div class="inputfield form-floating">
                    <input type="text" class="form-control" placeholder="Qte" name="qte" id="qte">
                    <label for="qte">Qte</label>
                </div>
                <div class="inputfield">
                <select name="categoryID" class="form-select">
                    <option selected>Choose Category</option>
                    <?php foreach($_SESSION["categories"] as $cat):?>
                        <option value="<?=$cat->categoryID?>"><?=$cat->categoryName?></option>
                    <?php endforeach?>
                </select>
                </div>
                <input type="submit" value="Add Product" name="add">
            </form>
            <div id="img">
                <img src="../img/product.png" alt="img-product">
            </div>
        </div>
    </main>
</body>
</html>