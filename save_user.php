<?php
// Debugging: Show all errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    // $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';

    if ($name && $phone && $email) {
        $file = 'user_entries.csv';
        $row = [date('Y-m-d H:i:s'), $name, $phone, $email];
        $fp = @fopen($file, 'a');
        if ($fp === false) {
            echo 'Error: Unable to open file for writing. Check permissions.';
            exit;
        }
        if (fputcsv($fp, $row) === false) {
            echo 'Error: Unable to write to file.';
            fclose($fp);
            exit;
        }
        fclose($fp);
        echo 'Thank you! Your details have been saved.';
    } else {
        echo 'Please fill in all fields.';
    }
} else {
    echo 'Invalid request.';
}
?>
