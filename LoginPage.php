<?php
require_once 'Login.php';

session_start();

if(!empty($_POST)) {
    $login = new Login();
    $strategy = 0;
    if($_POST['type'] === 'admin') {
        $strategy = new AdminLoginStrategy();
    }
    else if($_POST['type'] === 'user') {
        $strategy = new UserLoginStrategy();
    }
    $strategy->initializeDB("localhost", "root", "", "test2");
    $login->setStrategy($strategy);
    $login->login($_POST);
}

?>

<html lang="en">

<head>
    <title>Login</title>
</head>

<body>
<?php
if(isset($_SESSION['registered'])) {
    echo "<div> Registration successful!</div> <br>";
    unset($_SESSION['registered']);
}
?>
<div>
    Please enter your username and password
</div> <br>
<form action="./LoginPage.php" method="post">
    <label for="user_name">Username:</label><br>
    <input type="text" id="user_name" name="user_name" required><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br>
    Type: <br>
    <input type="radio" id="admin" name="type" value="admin" required>
    <label for="admin">Admin</label><br>
    <input type="radio" id="user" name="type" value="user" required>
    <label for="user">User</label><br><br>
    <input type="submit" value="Login">
</form>

</body>
</html>

