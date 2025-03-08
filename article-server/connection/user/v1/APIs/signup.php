<?php
require_once "../../../connection.php";
require_once "../../../models/User.php";
require_once "../../../models/UserSkeleton.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Missing information']);
        return;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email']);
        return;
    }

    $hashed_password = password_hash($password,PASSWORD_DEFAULT);

    $user = new UserSkeleton($username, $email, $hashed_password);
    if (User::checkUser($user)) {
        echo json_encode(['success' => false, 'message' => 'Email already registered']);
        return;
    }

    $user_id = User::addUser($user);

    if (!$user_id) {
        echo json_encode(['success' => false, 'message' => 'Coul not register user try again later']);
        return;
    }
    echo json_encode(['success' => true, 'message' => $user_id]);
    return;
}