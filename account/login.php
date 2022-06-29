<?php
    require_once "../utile.php";
    session_start();
    if ($_SERVER["REQUEST_METHOD"] === "POST")
    {
        if (isset($_POST["login"]))
        {
            $username=$email=$password="";
            if (isset($_POST["username"]))
            {
                $username = UtilePersistance::cleanInput($_POST["username"]);
            }
            if (isset($_POST["password"]))
            {
                $password = UtilePersistance::cleanInput($_POST["password"]);
            }
            if (!empty($username) && !empty($password))
            {
                $pdo = UtilePersistance::connectDatabase("ProductManagement");
                $SQLstatment = "SELECT * FROM users WHERE userName = :userName AND userPassword = password(:userPassword);";
                $prepare_statment = $pdo->prepare($SQLstatment);
                $prepare_statment->bindParam(":userName",$username);
                $prepare_statment->bindParam(":userPassword",$password);
                $prepare_statment->execute();
                $user = $prepare_statment->fetch(PDO::FETCH_OBJ);
                $pdo=null;
            }
            else {
                $msg = "All inputs are required";
            }
            if (isset($user))
            {
                if (empty($user->userID))
                {
                    $msg = "User Does not exists";
                }
                else {
                $_SESSION["userID"] = $user->userID;
                $_SESSION["username"] = $user->userName;
                $_SESSION["useremail"] = $user->userEmail;
                $_SESSION["title"] = $user->title;
                $pdo = UtilePersistance::connectDatabase("ProductManagement");
                $stm = "SELECT * FROM images WHERE userID = :userID";
                $prepare_stm = $pdo->prepare($stm);
                $prepare_stm->bindParam(":userID",$user->userID);
                $prepare_stm->execute();
                $userImage = $prepare_stm->fetch(PDO::FETCH_OBJ);
                $pdo=null;
                if ($userImage->image)
                {
                    $_SESSION["image"] = $userImage->image;
                }
                header("Location: account.php");
                }
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
<body>
    <main>
        <div id="logincard">
            <form action="<?=htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
                <h1>Sign In</h1>
                <h5>To interact with your account</h5>
                <div class="inputfield form-floating">
                    <input type="text" class="form-control" placeholder="Username" name="username" id="username">
                    <label for="username">Username</label>
                </div>
                <div class="inputfield form-floating">
                    <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                    <label for="password">Password</label>
                </div>
                <div class="checkfield">
                    <input type="checkbox" name="remeberme" id="rememberme">
                    <label for="rememberme">Remember me</label>
                </div>
                <input type="submit" value="Sign In" name="login">
                <p id="form-footer">Don't have an account yet ? <a href="newaccount.php">Sign Up</a></p>
            </form>
            <div id="img">
                <img src="../img/login.png" alt="img-login">
            </div>
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
    
</body>
</html>