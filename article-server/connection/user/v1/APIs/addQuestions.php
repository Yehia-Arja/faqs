<?php
require_once "../../../connection.php";
require_once "../../../models/Question.php";
require_once "../../../models/QuestionSkeleton.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question = $_POST['question'] ?? '';
    $answer = $_POST['answer'] ?? '';

    if (empty($question) || empty($answer)) {
        echo json_encode(['success' => false, 'message' => 'Missing information']);
        return;
    }
    $question_structure = new QuestionSkeleton($question, $answer);

    if (!Question::addQuestion($question_structure)) {
        echo json_encode(['success' => false, 'message' => 'Could not add question']);
        return;
    }
    echo json_encode(['success' => true, 'message' => 'Question added']);
    return;
}