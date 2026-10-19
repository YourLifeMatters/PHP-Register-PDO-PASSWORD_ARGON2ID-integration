<?php
/*
$sn = 'host';
$us = 'dbadmin';
$ps = '';
$db = 'user_db';
Preferably change creds to a .ENV
*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    if (empty($username) || empty($email) || empty($password)) {
        echo "All fields are required!";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
        exit;
    }
	$ARGON2IDUser = password_hash($username, PASSWORD_ARGON2ID);
    $ARGON2ID = password_hash($password, PASSWORD_ARGON2ID);
    try {
        //$connectdb = "mysql:host=$sn;dbname=$db;charset=utf8";
        $pdo = new PDO($connectdb, $us, $ps);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "INSERT INTO customers (username, password, email) VALUES (:username, :password, :email)";
        $safeprep = $pdo->prepare($query);
        $safeprep->bindParam(':username', $username);
        $safeprep->bindParam(':password', $bcryption);
        $safeprep->bindParam(':email', $email);
        if ($safeprep->execute()) {
            echo "Registration successful!";
        } else {
            echo "There was an error registering the user.";
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
