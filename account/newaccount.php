<?php
    require_once "../utile.php";

    if ($_SERVER["REQUEST_METHOD"] === "POST")
    {
        if (isset($_POST["signup"]))
        {
            $username=$email=$password="";
            if (isset($_POST["username"]))
            {
                $username = UtilePersistance::cleanInput($_POST["username"]);
            }
            if (isset($_POST["email"]))
            {
                $email = UtilePersistance::cleanInput($_POST["email"]);
            }
            if (isset($_POST["password"]))
            {
                $password = UtilePersistance::cleanInput($_POST["password"]);
            }
            if (!empty($username) && !empty($email) && !empty($password))
            {
                try {
                    $pdo = UtilePersistance::connectDatabase("ProductManagement");
                    $SQLstatment = "INSERT INTO users(userName,userEmail,userPassword) VALUES (:userName,:userEmail,password(:userPassword));";
                    $prepare_statment = $pdo->prepare($SQLstatment);
                    $prepare_statment->bindParam(":userName",$username);
                    $prepare_statment->bindParam(":userEmail",$email);
                    $prepare_statment->bindParam(":userPassword",$password);
                    $prepare_statment->execute();
                    $pdo=null;
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
    <title>Product Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="../style/form.css" type="text/css" rel="stylesheet">
</head>
<body>
    <main>
        <div id="logincard">
            <form action="<?=htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
                <h1>Sign Up</h1>
                <h5>Create your user account</h5>
                <div class="inputfield form-floating">
                    <input type="text" class="form-control" placeholder="Username" name="username" id="username">
                    <label for="username">Username</label>
                </div>
                <div class="inputfield form-floating">
                    <input type="text" class="form-control" placeholder="Email" name="email" id="email">
                    <label for="email">Email</label>
                </div>
                <div class="inputfield form-floating">
                    <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                    <label for="password">Password</label>
                </div>
                <input type="submit" value="Sign Up" name="signup">
                <p id="form-footer">Already have account ? <a href="login.php">Sign In</a></p>
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