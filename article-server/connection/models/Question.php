<?php
require_once "../connection.php";

class Question {
    
    public static function getAllQuestions() {
        global $conn;

        $sql = "SELECT * FROM questions";
        $result = $conn->query($sql);
        $row = $result->fetch_all(MYSQLI_ASSOC);
        return $row;
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