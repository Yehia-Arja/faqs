<?php
require_once "../../../connection.php";
require_once "../../../models/User.php";
require_once "../../../models/UserSkeleton.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Missing information']);
        return;
    }

    $user = new UserSkeleton(' ', $email, $password);
    if (!User::checkUser($user)) {
        echo json_encode(['success' => false, 'message' => 'Email not registered']);
        return;
    }

    if (!User::verifyUser($user)) {
        echo json_encode(['success' => false, 'message' => 'Password is not correct']);
        return;
    }
    
}