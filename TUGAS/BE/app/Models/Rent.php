<?php

namespace app\Models;
include "../app/config/DatabaseConfig.php";

use app\Config\DatabaseConfig;
use mysqli;

class Rent extends DatabaseConfig
{
    public $conn;

    public function __construct()
    {

        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->database_name, $this->port);
        
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }


    public function findAll()
    {
        $sql = "SELECT * FROM items";
        $result = $this->conn->query($sql);
        $this->conn->close();
        $data = [];
    
        
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }


    public function findById($id)
    {
        $sql = "SELECT * FROM items WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $this->conn->close();
        $data = [];
        
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        
        return $data;
    }


    public function create($data)
    {
        $rentName = $data['name'];
        $rentDescription = $data['description'];
        $rentPrice = $data['price'];
        $rentUrl = $data['image_url'];
        $query = "INSERT INTO items (name,description,price,image_url) VALUES (?,?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssds",$rentName , $rentDescription , $rentPrice , $rentUrl);
        $stmt->execute();
        $this->conn->close();
    }


    public function update($data, $id)
    {
        $RentName= $data['name'];
        $query = "UPDATE items SET name = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $RentName, $id);
        $stmt->execute();
        $this->conn->close();
    }


    public function delete($id)
    {
        $query = "DELETE FROM items WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $this->conn->close();
    }
}