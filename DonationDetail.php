<?php
require_once 'Item.php';

class DonationDetail implements ICRUD
{
    private int $id;
    private int $itemId;
    private int $donorId;
    private int $quantity;
    private float $value;

    public function __construct(int $id,int $donorId, int $itemId, int $quantity,float $value) 
    {
        $this->id = $id;
        $this->donorId= $donorId;
        $this->itemId = $itemId;
        $this->quantity = $quantity;
        $this->value=$value;
    }


    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): bool
    {
        if($quantity > 0) {
            $this->quantity = $quantity;
            $this->calculateValue();
            return true;
        }
        else {
            return false;
        }
    }
    public function setDonorId(int $id)
    {
        $this->donorId=$id;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function calculateValue(): void
    {
        $this->value = $this->item->getValue() * $this->quantity;
    }

    public function getDonor()
    {
        $donor= new Donor($this->donorId,"","");
        $servername="localhost";
        $username="root";
        $password="";
        $database="test2";
        $donor->initializeDB($servername,$username,$password,$database);
        $donor->getById("Donor");
        return $donor;    
    }
    public function getItem()
    {
        $item= new Furniture($this->itemId,"",0,false);
        $servername="localhost";
        $username="root";
        $password="";
        $database="test2";
        $item->initializeDB($servername,$username,$password,$database);
        $item->getById("Donor");
        return $item;      
    }
    
    function initializeDB($servername, $username, $password, $database)
    {
        $this->con = new mysqli($servername, $username, $password, $database);
    }

    function readData($tableName): array
    {
        $donationDetails = [];

        $query = "SELECT * FROM " . $tableName." WHERE status = TRUE;";
        $result = $this->con->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $donationDetails[] = $row;
            }
        }

        return $donationDetails;
    }

    function readUnAssigned($tableName): array
    {
        $donationDetails = [];

        $query = "SELECT * FROM " . $tableName." WHERE status = TRUE AND donor_id = 0;";
        $result = $this->con->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $donationDetails[] = $row;
            }
        }

        return $donationDetails;
    }

    function addData($tableName, $postData): bool
    {
        //$this->donorId = $postData['donorId'];
        $this->itemId = $postData['itemId'];
        $this->quantity = $postData['quantity'];
        $this->value = $postData['value'];


        $query = "INSERT INTO " . $tableName . "(donor_id, item_id, quantity, value,status) VALUES('0', '$this->itemId','$this->quantity','$this->value', TRUE)";
        $sql = $this->con->query($query);

        if ($sql == true) {
            return true;
        } else {
            return false;
        }
    }

    function updateData($tableName, $postData): bool
    {
        $this->id = $postData['id'];
        $this->donorId = $postData['donorId'];
        $this->itemId = $postData['itemId'];
        $this->quantity = $postData['quantity'];
        $this->value = $postData['value'];
        if (!empty($id) && !empty($postData)) {
            $query = "UPDATE " . $tableName . " SET donor_id = '$this->donorId',item_id = '$this->itemId',quantity = '$this->quantity', value = '$this->value' WHERE id = '$this->id'";
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





    function updateinternally($tableName): bool
    {
       
        if (!empty($id) && !empty($postData)) {
            $query = "UPDATE " . $tableName . " SET donor_id = '$this->donorId',item_id = '$this->itemId',quantity = '$this->quantity', value = '$this->value' WHERE id = '$this->id'";
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
            $this->itemId=$row['item_id'];
            $this->quantity=$row['quantity'];
            $this->value=$row['value'];
            return true;
            } else {
            return false;
        }
    }
}