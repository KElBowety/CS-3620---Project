<?php

require_once 'ICRUD.php';

abstract class Item implements ICRUD
{
    protected int $id;
    protected string $name;

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



    function initializeDB($servername, $username, $password, $database)
    {
        $this->con = new mysqli($servername, $username, $password, $database);
    }

    abstract function readData($tableName): array;

    abstract function addData($tableName, $postData): bool;
 

    abstract function updateData($tableName, $postData): bool;

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
    abstract function getById($tableName): bool;
}