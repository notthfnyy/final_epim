<?php 
include "db.php";
include "session.php";

$error ="";
$email = $_POST['email'] ?? "";
$password = $_POST['password'] ?? "";
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $query = "SELECT * FROM user where email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {    
        $email = $_SESSION['email'];
        $password = $_SESSION['password'];
        header('Location: payment.php');
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoginPage</title>
    <style>
        body{
            text-align : center;
            margin-bottom : 10px;
        }
        #loginForm{
            font-family : arial;
        }
        #email{
            display : relative;
            margin-bottom : 20px;
            width : 300px;
        }
        #password{
            width : 300px;
            margin-bottom : 20px;
        }
    </style>
</head>
<body>
    <h2>LOGIN</h2>
    <form id="loginForm">
        <label for="email">Email: </label>
        <input type="email" id="email" required>
        <br>
        <label for="password">Password: </label>
        <input type="password" id="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>