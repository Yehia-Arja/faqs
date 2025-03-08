<?php
require_once __DIR__ . "/../connection.php";

class Question {
    
    public static function getAllQuestions() {
        global $conn;

        $sql = "SELECT * FROM questions";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC);
            return $row;
        }
        return false;
        
    }
    public static function addQuestion($question) {
        global $conn;

        $sql = $conn->prepare("INSERT INTO questions (question,answer) VALUES (?,?)");
        $sql->bind_param('ss', $question->question, $question->answer);

        if(!$sql->execute()) {
            return false;
        }
        return true;
    }
}