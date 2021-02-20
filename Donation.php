<?php
require 'Donor.php';
require 'DonationDetail.php';

class Donation implements ICRUD
{
    private int $id;
    private int $donorId;
    private float $value;
    private string $date;
    private array $donationDetails = [];

    public function __construct(int $id, int $donorId,string $date, array $donationDetails)
    {
        $this->id = $id;
        $this->donorId = $donorId;
        $this->date = $date;
        $this->donationDetails = $donationDetails;
        $this->calculateValue();
    }

    public function getDonor(): Donor
    {
        $donor= new Donor($this->donorId,"","");
        $servername="sql100.byethost24.com";
        $username="b24_27821514";
        $password="q67cwgnt";
        $database="b24_27821514_db_test";
        $donor->initializeDB($servername,$username,$password,$database);
        $donor->getById("Donor");
        return $donor;
    }

    public function getDonationDetails(): array
    {
        return $this->donationDetails;
    }

    public function addDonationDetail(DonationDetail $detail): void
    {
        array_push($this->donationDetails, $detail);
        $this->calculateValue();
    }

    public function removeDonationDetail(DonationDetail $detail): void
    {
        array_splice($this->donationDetails, array_search($detail, $this->donationDetails), 1);
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function calculateValue(): void
    {
        $this->value = 0.0;
        foreach ($this->donationDetails as $detail)
        {
            $this->value += $detail->getValue();
        }
    }

    function initializeDB($servername, $username, $password, $database)
    {
        $this->con = new mysqli($servername, $username, $password, $database);
    }

    function readData($tableName): array
    {
        $donations = [];

        $query = "SELECT * FROM " . $tableName." WHERE status = TRUE;";
        $result = $this->con->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $donations[] = $row;
            }
        }

        return $donations;
    }

    function addData($tableName, $postData): bool
    {
        $this->donorId = $postData['donorId'];
        $this->date = date("Y-m-d");

        $query = "INSERT INTO " . $tableName . " (donor_id, value, date,status) VALUES('$this->donorId', '0','$this->date', TRUE)";
        $sql = $this->con->query($query);

        if ($sql == true) {
            return true;
        } else {
            return false;
        }
    }
    function getDonorId()
    {
        return $this->donorId;
    }

    function updateData($tableName, $postData): bool
    {
        $this->id = $postData['id'];
        $this->donorId = $postData['donorId'];
        $this->value = $postData['value'];
        $this->date = $postData['date'];
        if (!empty($id) && !empty($postData)) {
            $query = "UPDATE " . $tableName . " SET donor_id = '$this->donorId', value = '$this->value', date = '$this->date' WHERE id = '$this->id'";
            $sql = $this->con->query($query);

            if ($sql == true) {
                return true;
            } else {
                return false;
            }
        }
        else {
            return false;
        }
    }

    function deleteData($tableName): bool
    {
        $query = "UPDATE " . $tableName . " SET status = FALSE WHERE id = " . $this->id;
        $sql = $this->con->query($query);
        if ($sql == true) {
            return true;
        } else {
            return false;
        }
    }
    function getById($tableName): bool
    {
        $query ="SELECT * FROM ".$tableName." WHERE id= ".$this->id." AND status = TRUE";
        $sql = $this->con->query($query);
        if ($sql->num_rows > 0) {
            $row = $sql->fetch_assoc();
            $this->id=$row['id'];
            $this->donorId=$row['donor_id'];
            $this->phoneNumber=$row['value'];
            $this->date=$row['date'];
            return true;
            } else {
            return false;
        }
    }
}