<?php
include 'DonationDetail.php';
include 'Furniture.php';
$DonationDetail = new DonationDetail(0,0,0,0,0);

if (isset($_GET['deleteId']) && !empty($_GET['deleteId'])) {
    $deletedId = $_GET['deleteId'];
    echo $deletedId;
    $dd=new DonationDetail($deletedId,0,0,0,0);
    $dd->initializeDB("localhost", "root", "", "test2");   
    $dd->deleteData("donation_details");
    header('Location: addDonationDetailsPage.php');
   }

if (isset($_POST['submit'])) {
 $f= new Furniture($_POST['itemId'],"",true);
 $f->initializeDB("localhost", "root", "", "test2");
 $check=$f-> getById("items");
 if ($check)
 {
 $DonationDetail->initializeDB("localhost", "root", "", "test2");  
 $DonationDetail->addData("donation_details",$_POST);
 header('Location: addDonationDetailsPage.php');
 }else{
     echo'no such item related to this id';
 }
}
$DonationDetail->initializeDB("localhost", "root", "", "test2");   
$data=$DonationDetail->readData("donation_details");


?>
<html lang="ar">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Create DD</title>
</head>
<body>






 <div style="margin: 20px;" dir="rtl">
 <form method="POST" action="./addDonationDetailsPage.php">
 <div>
 <label for="itemId">كود الأثاث</label>
 <input type="text" name="itemId" placeholder="كود الاثاث " required="required" >
 </div>
 <div>
 <label for="quantity">الكمية</label>
 <input type="number" name="quantity" placeholder="الكمية " required="required"min=0 max=1000000 step=1>
 </div>
 <div>
 <label for="value">القيمة</label>
 <input type="number" name="value"placeholder="القيمة" required="required" min=0 max=1000000 step=any>
 </div>
 <input type="submit" name="submit" value="Submit">
 </form>
 </div>

 <div dir="rtl">
  <table dir="rtl">
  <thead>
  <tr>
  <th>كود</th>
  <th>كود المتبرع</th>
  <th>كود الأثاث</th>
  <th>الكمية</th>
  <th>القيمة</th>
  </tr>
  </thead>
  <tbody>
  <?php
  for ($i = 0; $i < count($data); $i++) {
  echo "<tr>";
  echo "<td>" . $data[$i]['id'] . "</td>";
  echo "<td>" . $data[$i]['donor_id'] . "</td>";
  echo "<td>" . $data[$i]['item_id'] . "</td>";
  echo "<td>" . $data[$i]['quantity'] . "</td>";
  echo "<td>" . $data[$i]['value'] . "</td>";

  echo "<td>
  <a href='addDonationDetailsPage.php?deleteId=" . $data[$i]['id'] . "' style='color:r
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