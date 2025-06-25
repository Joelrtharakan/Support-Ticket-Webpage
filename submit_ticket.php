<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";  
$port = "5432";       
$dbname = "support_system";  
$user = "postgres";   
$password = "joel2004";  

$conn_string = "host=$host port=$port dbname=$dbname user=$user password=$password";

$conn = pg_connect($conn_string);


if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

$feedbackMessage = '';
$feedbackClass = ''; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $email = $_POST['email'];
    $software_name = $_POST['software_name'];
    $title = $_POST['title'];
    $description = $_POST['description'];

 
    $file = $_FILES['proof'];


    $upload_dir = 'uploads/';

    $file_path = null;

    if ($file['error'] == 0) {
        $file_name = basename($file['name']);
        $file_tmp_name = $file['tmp_name'];
        $file_path = $upload_dir . $file_name;

        $allowed_types = ['image/jpeg', 'image/png', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];

        if (in_array($file['type'], $allowed_types)) {
            
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            
            if (move_uploaded_file($file_tmp_name, $file_path)) {
                $feedbackMessage .= "File uploaded successfully!<br>";
            } else {
                $feedbackMessage .= "There was an error with the file.<br>";
                $feedbackClass = 'error';
            }
        } else {
            $feedbackMessage .= "Invalid file type. Only images, PDFs, and Word documents are allowed.<br>";
            $file_path = null;
            $feedbackClass = 'error';
        }
    } else {
        
        $feedbackMessage .= "No file uploaded.<br>";
    }

    
    if ($file_path) {
        
        $query = "INSERT INTO support_tickets (email, software_name, title, description, proof_file) VALUES ($1, $2, $3, $4, $5)";
        $result = pg_prepare($conn, "insert_ticket", $query);
        $result = pg_execute($conn, "insert_ticket", array($email, $software_name, $title, $description, $file_path));
    } else {
       
        $query = "INSERT INTO support_tickets (email, software_name, title, description) VALUES ($1, $2, $3, $4)";
        $result = pg_prepare($conn, "insert_ticket", $query);
        $result = pg_execute($conn, "insert_ticket", array($email, $software_name, $title, $description));
    }

   
    if ($result) {
        $feedbackMessage .= "Ticket submitted successfully!<br>";
        $feedbackClass = 'success';
    } else {
        $feedbackMessage .= "Error: " . pg_last_error($conn) . "<br>";
        $feedbackClass = 'error';
    }

    
    pg_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Submission Feedback</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <div class="container">
        
        <div class="feedback-message <?php echo $feedbackClass; ?>">
            <?php echo $feedbackMessage; ?>
        </div>
        <a href="submit_ticket_form.html" class="back-btn">Back to Ticket Form</a>
    </div>
</body>
</html>
