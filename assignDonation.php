<?php
require_once('Donation.php');
require_once ('DonationDetail.php');
$x=array();
$Donation = new Donation(0,0,"",$x);
$Details= new DonationDetail(0,0,0,0,0);



if (isset($_POST['submit'])) {

 $don= new Donation($_POST['donationId'],0,0,array());
 $don->initializeDB("localhost", "root", "", "test2");
 $check1=$don-> getById("donations");
 $det= new DonationDetail($_POST['detailId'],0,0,0,0);
 $det->initializeDB("localhost", "root", "", "test2");
 $check2=$det-> getById("donation_details");
 if ($check1&&$check2)
 {
 $det->setDonorId($don->getDonorId());
 $det-> updateinternally("donation_details");
 header('Location: assignDonation.php');
 }else{
     echo'you entered wrong data';
 }
}
$Donation->initializeDB("localhost", "root", "", "test2");   
$data=$Donation->readData("donations");
$Details->initializeDB("localhost", "root", "", "test2");   
$data2=$Details->readUnAssigned("donation_details");


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
 <form method="POST" action="./assignDonation.php">

 <div>
 <label for="donationId">كود التبرع</label>
 <input type="number" name="donationId" placeholder="كود التبرع " required="required"min=0 max=1000000 step=1>
 </div>
 <div>
 <label for="detailId">كود التفاصيل</label>
 <input type="number" name="detailId" placeholder="كود التفاصيل " required="required"min=0 max=1000000 step=1>
 </div>

 <input type="submit" name="submit" value="Submit">
 </form>
 </div>

 <h1>كود التبرعات</h1>
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

  echo "</tr>";
  }
  ?>
  </tbody>
  </table>
 </div>

 <h1>كود التفاصيل</h1>
 <div dir="rtl">
  <table dir="rtl">
  <thead>
  <tr>
  <th>كود</th>
  <th>كود المتبرع</th>
  <th>كود الأثاث</th>
  <th>القيمة</th>
  </tr>
  </thead>
  <tbody>
  <?php
  for ($i = 0; $i < count($data); $i++) {
  echo "<tr>";
  echo "<td>" . $data2[$i]['id'] . "</td>";
  echo "<td>" . $data2[$i]['donor_id'] . "</td>";
  echo "<td>" . $data2[$i]['item_id'] . "</td>";
  echo "<td>" . $data2[$i]['quantity'] . "</td>";
  echo "<td>" . $data2[$i]['value'] . "</td>";



  echo "</tr>";
  }
  ?>
  </tbody>
  </table>
 </div>

</body>
</html>