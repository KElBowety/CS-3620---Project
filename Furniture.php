<?php
require_once 'Item.php';

class Furniture extends Item
{
    protected bool $new;

    public function __construct(int $id, string $name, bool $new)
    {
        $this->id = $id;
        $this->name = $name;
        $this->new = $new;
    }

    function readData($tableName): array
    {
        $furniture = [];

        $query = "SELECT * FROM " . $tableName." WHERE status = TRUE AND type= 'furniture';";
        $result = $this->con->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $furniture[] = $row;
            }
        }

        return $furniture;
    }

    function addData($tableName, $postData): bool
    {
        $this->name = $postData['name'];
        $this->new = $postData['new'];
        if ($this->new =="new")
        {
            $query = "INSERT INTO " . $tableName . " (name, type , is_new ,status) VALUES('$this->name','furniture',TRUE, TRUE)"; 
        }
        else
        {
            $query = "INSERT INTO " . $tableName . " (name, type , is_new ,status) VALUES('$this->name','furniture',0, TRUE)"; 
        }
        $sql = $this->con->query($query);

        if ($sql == true) {
            return true;
        } else {
            return false;
        }
    }

    function updateData($tableName, $postData): bool
    {
        
        $this->name = $postData['name'];
        $this->new = $postData['new'];
        if (!empty($id) && !empty($postData)) {
            $query = "UPDATE " . $tableName . " SET name = '$this->name', new = '$this->new' WHERE id = '$this->id' AND type= 'furniture'";
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

    function getById($tableName): bool
    {
        $query ="SELECT * FROM ".$tableName." WHERE id= ".$this->id." AND status = TRUE AND type= 'furniture'";
        $sql = $this->con->query($query);
        if ($sql->num_rows > 0) {
            $row = $sql->fetch_assoc();
            $this->name=$row['name'];
            $this->value=$row['value'];
            $this->type=$row['type'];
            $this->new=$row['is_new'];
            return true;
            } else {
            return false;
        }
    }
}