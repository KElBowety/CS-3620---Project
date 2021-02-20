<?php
include 'Donor.php';
$Donor = new Donor(0,"","");

if (isset($_GET['deleteId']) && !empty($_GET['deleteId'])) {
    $deletedId = $_GET['deleteId'];
    echo $deletedId;
    $deletedDonor=new Donor($deletedId,"","");
    $deletedDonor->initializeDB("localhost", "root", "", "test2");   
    $deletedDonor->deleteData("Donor");
    header('Location: addDonorPage.php');
   }

if (isset($_POST['submit'])) {
 $Donor->initializeDB("localhost", "root", "", "test2");   
 $Donor->addData("Donor",$_POST);
 header('Location: addDonorPage.php');
}
$Donor->initializeDB("localhost", "root", "", "test2");   
$data=$Donor->readData("Donor");


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
 <form method="POST" action="./addDonorPage.php">
 <div>
 <label for="name">الإسم:</label>
 <input type="text" name="name" placeholder="الإسم بالكامل" required="required">
 </div>
 <div>
 <label for="name">رقم الهاتف:</label>
 <input type="text" name="phoneNumber" pattern="^\d{11}$" placeholder="رقم الهاتف" required="required">
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
  <th>رقم الهاتف المحمول</th>
  </tr>
  </thead>
  <tbody>
  <?php
  for ($i = 0; $i < count($data); $i++) {
  echo "<tr>";
  echo "<td>" . $data[$i]['id'] . "</td>";
  echo "<td>" . $data[$i]['name'] . "</td>";
  echo "<td>" . $data[$i]['phone_number'] . "</td>";

  echo "<td>
  <a href='addDonorPage.php?deleteId=" . $data[$i]['id'] . "' style='color:r
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