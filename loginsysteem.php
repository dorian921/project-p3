<?php
// Start session
session_start();

// Dummy user data for demonstration
$users = [
    'Jason' => 'Jason123',
    'Stijn' => 'Stijn123',
    'Dorian' => 'Dorian123'
];

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verify login credentials
    if (isset($users[$username]) && $users[$username] === $password) {
        $_SESSION['username'] = $username;
        header('Location: homes.php');
        exit;
    } else {
        echo "<p>Invalid username or password</p>";
    }
}
?>
