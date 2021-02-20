<?php
    $con = new mysqli("localhost", "root", "", "test2");
?>

<html lang="en">

<head>
    <title>Users List</title>
    <style>
        table,
        th,
        td { border: 1px solid black; }
    </style>
</head>

<body>
     <table>
         <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Username</th>
                <th>Type</th>
                <th>Status</th>
            </tr>
         </thead>
         <tbody>
         <?php
            $query = "SELECT * FROM users";
            $result = $con->query($query);
            $data = $result->fetch_all(MYSQLI_ASSOC);

            for($i = 0; $i < count($data); $i++) {
                echo "<tr>";
                echo "<td>" . $data[$i]['id'] . "</td>";
                echo "<td>" . $data[$i]['name'] . "</td>";
                echo "<td>" . $data[$i]['user_name'] . "</td>";
                echo "<td>" . $data[$i]['type'] . "</td>";
                echo "<td>" . $data[$i]['status'] . "</td>";
                echo "</tr>";
            }
         ?>
         </tbody>
     </table>
</body>
</html>