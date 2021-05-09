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

// Start or resume session variables
session_start();

// If the user_ID session is not set, then the user has not logged in yet
if (!isset($_SESSION['user_ID']))
{
    // If the page is receiving the email and password from the login form then verify the login data
    if (isset($_POST['Email_Address']) && isset($_POST['User_Password']))
    {
        $stmt = $conn->prepare("SELECT UserID, User_Type, User_Password FROM Users WHERE Email_Address=:Email_Address");
        $stmt->bindValue(':Email_Address', $_POST['Email_Address']);
        $stmt->execute();
        
        $queryResult = $stmt->fetch();
        
        // Verify password submitted by the user with the hash stored in the database
        if(!empty($queryResult) && password_verify($_POST["User_Password"], $queryResult['User_Password']))
        {

            if($queryResult['UserID'] = '102') {
                $_SESSION['user_ID'] = $queryResult['UserID'];
    
                // Redirect to URL
                header("Location: admin_main.php");

            }
    
            if($queryResult['User_Type'] = "SolarPowerComp") {
                $_SESSION['user_ID'] = $queryResult['UserID'];
    
                // Redirect to URL
                header("Location: solarpowerinfo.php");
    
            }
    
            if($queryResult['User_Type'] = "WindPowerComp") {
                $_SESSION['user_ID'] = $queryResult['UserID'];
    
                // Redirect to URL
                header("Location: windpowerinfo.php");
                
            }
            
//             if($queryResult['User_Type'] = "Patient") {
//                 // Create session variable
//                 $_SESSION['user_ID'] = $queryResult['UserID'];
                
//                 // Redirect to URL
//                 header("Location: contact.php");
//             }
        
        } else {
            // Password mismatch
            require('login.php');
            exit();
        }
        
    } else {
        // Show login page
        require('login.php');
        exit();
    }
    
} else {
    header("Location: contact.php");
}

?>