<?php

// Create uploads folder if not exists
$uploadDir = "uploads/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Get form data
$authors = $_POST['author'];   // multiple authors
$email   = $_POST['email'];
$title   = $_POST['title'];

// File details
$fileName = $_FILES['paper']['name'];
$fileTmp  = $_FILES['paper']['tmp_name'];
$fileSize = $_FILES['paper']['size'];
$fileError= $_FILES['paper']['error'];

// Allowed file types
$allowed = ['pdf', 'doc', 'docx'];
$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

// Validation
if (!in_array($fileExt, $allowed)) {
    echo "Only PDF/DOC/DOCX files allowed!";
    exit();
}

if ($fileError !== 0) {
    echo "Error uploading file!";
    exit();
}

// Rename file to avoid duplicates
$newFileName = time() . "_" . basename($fileName);
$targetPath = $uploadDir . $newFileName;

// Move file
if (move_uploaded_file($fileTmp, $targetPath)) {

    // Save data (optional: to file)
    $data = "Authors: " . implode(", ", $_POST['author']) . "\n";
    $data .= "Email: $email\n";
    $data .= "Title: $title\n";
    $data .= "File: $newFileName\n";
    $data .= "--------------------------\n";

    file_put_contents("submissions.txt", $data, FILE_APPEND);

    echo "Paper submitted successfully!";

} else {
    echo "Failed to upload file!";
}

?>