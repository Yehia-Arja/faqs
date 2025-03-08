<?php
require_once "../../../connection.php";
require_once "../../../models/Question.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $questions = Question::getAllQuestions();

    if (!$questions) {
        echo json_encode(['success' => false, 'message' => 'No questions yet']);
        return;
    }
    echo json_encode(['success' => true, 'message' => $questions]);
    return;
}