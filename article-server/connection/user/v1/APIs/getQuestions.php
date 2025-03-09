<?php
require_once "../../../connection.php";
require_once "../../../models/Question.php";


if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (isset($_GET['value'])) {
        $search = $_GET['value'];
        $questions = Question::getSearchedQuestions($search);

        if (!$questions) {
            echo json_encode(['success' => false, 'message' => 'No questions yet']);
            return;
        }
        echo json_encode(['success' => true, 'message' => $questions]);
        return;
    }


    $questions = Question::getAllQuestions();

    if (!$questions) {
        echo json_encode(['success' => false, 'message' => 'No questions yet']);
        return;
    }
    echo json_encode(['success' => true, 'message' => $questions]);
    return;
}