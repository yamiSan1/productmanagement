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
            $categoryname=$categorydesc="";
            $categoryname_err=$categorydesc_err="";
            if (isset($_POST["categoryname"]))
            {
                $categoryname = UtilePersistance::cleanInput($_POST["categoryname"]);
            }
            else
            {
                $categoryname_err = "INVALID CATEGORY NAME";
            }
            if (isset($_POST["categorydesc"]))
            {
                $categorydesc = UtilePersistance::cleanInput($_POST["categorydesc"]);
            }
            else
            {
                $categorydesc_err = "INVALID CATEGORY DESCRIPTION";
            }
            if (!empty($categoryname) && !empty($categorydesc))
            {
                try {
                    $pdo = UtilePersistance::connectDatabase("ProductManagement");
                    $SQLstatment = "INSERT INTO manageCategory(categoryName,categoryDesc,userID) VALUES (:categoryName,:categoryDesc,:userID);";
                    $prepare_statment = $pdo->prepare($SQLstatment);
                    $prepare_statment->bindParam(":categoryName",$categoryname);
                    $prepare_statment->bindParam(":categoryDesc",$categorydesc);
                    $prepare_statment->bindParam(":userID",$_SESSION["userID"]);
                    $prepare_statment->execute();
                    $pdo=null;
                } catch (\Throwable $th) {
                    $msg = "Category already exists";
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
                <h1>Add Category</h1>
                <h5>Add new category to your account</h5>
                <div class="inputfield form-floating">
                    <input type="text" class="form-control" placeholder="Category Name" name="categoryname" id="categoryname">
                    <label for="categoryname">Category Name</label>
                </div>
                <div class="inputfield">
                    <textarea type="text" placeholder="Description" name="categorydesc" id="categorydesc"></textarea>
                </div>
                <input type="submit" value="Add Category" name="add">
            </form>
            <div id="img">
                <img src="../img/category.png" alt="img-login">
            </div>
        </div>
    </main>
</body>
</html>