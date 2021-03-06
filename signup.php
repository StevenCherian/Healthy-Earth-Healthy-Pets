<?php

// Display all errors, very useful for PHP debugging (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Parameters of the MySQL connection
$servername = "localhost";
$username = "cherians2";
$password = "V00860079";
$database = "project_cherians2";

try {
    // Establish a connection with the MySQL server
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

try {
    // If the user_ID session is not set, then the user has not logged in yet
    if (isset($_POST['Email_Address'])) {
        
        $stmt = $conn->prepare("SELECT Email_Address FROM Users WHERE Email_Address=:Email_Address");
        $stmt->bindValue(':Email_Address', $_POST['Email_Address']);
        $stmt->execute();
        $row = $stmt->fetch();
        
        if(is_array($row)) {
            $error = 0;
            echo $error;
            header("Location: login.php");
            exit();
        
        } else {
            $name='Patient';
            $stmt = $conn->prepare("INSERT INTO Users (User_Type, First_Name, Last_Name, Email_Address, User_Password) VALUES (:User_Type, :First_Name, :Last_Name, :Email_Address, :User_Password)");
            $password = password_hash($_POST['User_Password'], PASSWORD_BCRYPT);
            
            $stmt->bindParam(":User_Type", $name);
            $stmt->bindParam(":First_Name", $_POST['First_Name']);
            $stmt->bindParam(":Last_Name", $_POST['Last_Name']);
            $stmt->bindParam(":Email_Address", $_POST['Email_Address']);
            $stmt->bindParam(":User_Password", $password);
            $stmt->execute();
            
            $stmt2 = $conn->prepare("SELECT UserID FROM Users WHERE Email_Address=:Email_Address");
            $stmt2->bindValue(':Email_Address', $_POST['Email_Address']);
            $stmt2->execute();
            
            $queryResult = $stmt2->fetch();

            session_start();
            $_SESSION['user_ID'] = $queryResult['UserID'];
            header("Location: main.php");
            exit();
        }
    }

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}

?>