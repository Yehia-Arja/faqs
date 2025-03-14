<?php
require_once "../../connection/connection.php";

class CreateUserTable{
    public static function up($conn) {

        $sql = "CREATE TABLE IF NOT EXISTS users 
        (id INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(255) NOT NULL UNIQUE,
        username VARCHAR(255) NOT NULL,
        password TEXT NOT NULL)";

        if ($conn->query($sql)) {
            echo "Table created successfully";
        }else {
            echo "Error" . $conn->error;
        }
    }
}
CreateUserTable::up($conn);