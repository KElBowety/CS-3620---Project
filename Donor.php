<?php
include "ICRUD.php";
class Donor implements ICRUD
{
    private int $id;
    private string $name;
    private string $phoneNumber;
    private array $donations = [];
    private mysqli $con;

    public function __construct(int $id, string $name, string $phoneNumber)
    {
        $this->id = $id;
        $this->name = $name;
        $this->phoneNumber = $phoneNumber;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDonations(): array
    {
        return $this->donations;
    }

    public function addDonation(Donation $donation): void
    {
        array_push($this->donations, $donation);
    }

    function initializeDB($servername, $username, $password, $database)
    {
        $this->con = new mysqli($servername, $username, $password, $database);
    }

    function readData($tableName): array
    {
        $donors = [];

        $query = "SELECT * FROM " . $tableName . " WHERE status = TRUE;";
        $result = $this->con->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $donors[] = $row;
            }
        }

        return $donors;
    }

    function addData($tableName, $postData): bool
    {
        $this->name = $postData['name'];
        $this->phoneNumber = $postData['phoneNumber'];

        $query = "INSERT INTO " . $tableName . " (name, phone_number, status) VALUES('$this->name', '$this->phoneNumber', TRUE)";
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
        $this->name = $postData['name'];
        $this->phoneNumber = $postData['phoneNumber'];

        if (!empty($id) && !empty($postData)) {
            $query = "UPDATE " . $tableName . " SET name = '$this->name', phone_number = '$this->phoneNumber' WHERE id = '$this->id'";
            $sql = $this->con->query($query);

            if ($sql == true) {
                return true;
            } else {
                return false;
            }
        } else {
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
        $query = "SELECT * FROM " . $tableName . " WHERE id= " . $this->id . " AND status = TRUE";
        $sql = $this->con->query($query);
        if ($sql->num_rows > 0) {
            $row = $sql->fetch_assoc();
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->phoneNumber = $row['phone_number'];
            return true;
        } else {
            return false;
        }
    }
}
