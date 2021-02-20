<?php
include 'Furniture.php';
$Item = new Furniture(0,"","");

if (isset($_GET['deleteId']) && !empty($_GET['deleteId'])) {
    $deletedId = $_GET['deleteId'];
    echo $deletedId;
    $deletedItem=new Furniture($deletedId,"","");
    $deletedItem->initializeDB("localhost", "root", "", "test2");   
    $deletedItem->deleteData("items");
    header('Location: addItemPage.php');
   }

if (isset($_POST['submit'])) {
 $Item->initializeDB("localhost", "root", "", "test2");   
 $Item->addData("items",$_POST);
 echo print_r($_POST);
 header('Location: addItemPage.php');
}
$Item->initializeDB("localhost", "root", "", "test2");   
$data=$Item->readData("items");


?>
<html lang="ar">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Create User</title>
</head>
<body>






 <div style="margin: 20px;" dir="rtl">
 <form method="POST" action="./addItemPage.php">
 <div>
 <label for="name">الإسم:</label>
 <input type="text" name="name" placeholder="الإسم " required="required">
 </div>
 <div>
 <label for="type">النوع:</label>
 <select name="type" id="type" required="required">
  <option value="furniture">furniture</option>
</select>
</div>
 <div>
 <label for="new">الحالة:</label>
 <select name="new" id="new" required="required">
  <option value="new">new</option>
  <option value="new">used</option>
</select>
</div>
 <input type="submit" name="submit" value="Submit">
 </form>
 </div>

 <div dir="rtl">
  <table dir="rtl">
  <thead>
  <tr>
  <th>كود</th>
  <th>إسم</th>
  <th>النوع</th>
  <th>الحالة</th>
  </tr>
  </thead>
  <tbody>
  <?php
  for ($i = 0; $i < count($data); $i++) {
  echo "<tr>";
  echo "<td>" . $data[$i]['id'] . "</td>";
  echo "<td>" . $data[$i]['name'] . "</td>";
  echo "<td>" . $data[$i]['type'] . "</td>";
  echo "<td>" . $data[$i]['is_new'] . "</td>";

  echo "<td>
  <a href='addItemPage.php?deleteId=" . $data[$i]['id'] . "' style='color:r
 ed'>Delete</a>
  </td>";
  echo "</tr>";
  }
  ?>
  </tbody>
  </table>
 </div>

</body>
</html>