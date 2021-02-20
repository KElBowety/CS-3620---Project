<?php
require_once( 'Donation.php');
require_once( 'Donor.php');
$x=array();
$Donation = new Donation(0,0,"",$x);

if (isset($_GET['deleteId']) && !empty($_GET['deleteId'])) {
    $deletedId = $_GET['deleteId'];
    echo $deletedId;
    $d=new Donation($deletedId,0,"",array());
    $d->initializeDB("localhost", "root", "", "test2");   
    $d->deleteData("donations");
    header('Location: addDonationPage.php');
   }

if (isset($_POST['submit'])) {

 $donor= new Donor($_POST['donorId'],"","");
 $donor->initializeDB("localhost", "root", "", "test2");
 $check=$donor-> getById("Donor");
 if ($check)
 {
 $Donation->initializeDB("localhost", "root", "", "test2");  
 $Donation->addData("donations",$_POST);
 header('Location: addDonationPage.php');
 }else{
     echo'no such donor related to this id';
 }
}
$Donation->initializeDB("localhost", "root", "", "test2");   
$data=$Donation->readData("donations");


?>
<html lang="ar">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Create Donation</title>
</head>
<body>






 <div style="margin: 20px;" dir="rtl">
 <form method="POST" action="./addDonationPage.php">

 <div>
 <label for="donorId">كود المتبرع</label>
 <input type="number" name="donorId" placeholder="كود المتبرع " required="required"min=0 max=1000000 step=1>
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
  <th>القيمة</th>
  <th>تاريخ التبرع</th>
  </tr>
  </thead>
  <tbody>
  <?php
  for ($i = 0; $i < count($data); $i++) {
  echo "<tr>";
  echo "<td>" . $data[$i]['id'] . "</td>";
  echo "<td>" . $data[$i]['donor_id'] . "</td>";
  echo "<td>" . $data[$i]['value'] . "</td>";
  echo "<td>" . $data[$i]['date'] . "</td>";

  echo "<td>
  <a href='addDonationPage.php?deleteId=" . $data[$i]['id'] . "' style='color:r
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