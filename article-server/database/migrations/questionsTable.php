<?php

require_once "../../connection/connection.php";

class CreateQuestionTable {
    public static function up ($conn) {
        $sql = "CREATE TABLE IF NOT EXISTS'questions'
        ('id' INT AUTO_INCREMENT PRIMARY KEY,
        'question' VARCHAR(255) NOT NULL,
        'answer' VARCHAR(255) NOT NULL)";

        if ($conn->query($sql)) {
            echo "Table created successfully";
        }else {
            echo "Error" . $conn->error;
        }
    }
}

CreateQuestionTable::up($conn);