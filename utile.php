<?php
class UtilePersistance {
    public static function connectDatabase($dbname)
    {
        $dsn = "mysql:host=localhost;port=3306;dbname=$dbname";
        $user = "root";
        $pass = "";
        $options = [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION];
        return new PDO($dsn,$user,$pass,$options);
    }
    public static function cleanInput($input)
    {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }
    
}
?>