<?php
session_start();
require_once "../utile.php";
if (!isset($_SESSION["userID"]))
{
    header("Location: ../account/login.php");
}
if ($_SERVER["REQUEST_METHOD"] === "GET")
{
    if (isset($_GET["categoryID"]))
    {
        try {
            $pdo = UtilePersistance::connectDatabase("ProductManagement");
            $SQL = "DELETE FROM manageCategory WHERE categoryID = ? AND userID = ?;";
            $stm = $pdo->prepare($SQL);
            $stm->execute([$_GET["categoryID"],$_SESSION["userID"]]);
            $pdo = null;
            header("Location: index.php");

        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
?>