<?php
require_once 'Registration.php';

session_start();

if(!empty($_POST)) {
    $registration = new Registration();
    $strategy = 0;
    if($_POST['type'] === 'admin') {
        $strategy = new AdminRegistrationStrategy();
    }
    else if($_POST['type'] === 'user') {
        $strategy = new UserRegistrationStrategy();
    }
    $strategy->initializeDB("localhost", "root", "", "test2");
    $registration->setStrategy($strategy);
    $registration->register($_POST);
}

?>

<html lang="en">

<head>
    <title>Registration</title>
</head>

<body>
<div>
    Please enter your information
</div> <br>
<form action="./RegistrationPage.php" method="post">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" required><br>
    <label for="user_name">Username:</label><br>
    <input type="text" id="user_name" name="user_name" required><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br>
    Type: <br>
    <input type="radio" id="admin" name="type" value="admin" required>
    <label for="admin">Admin</label><br>
    <input type="radio" id="user" name="type" value="user" required>
    <label for="user">User</label><br><br>
    <input type="submit" value="Register">
</form>

</body>
</html>

