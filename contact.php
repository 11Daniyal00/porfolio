<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo "Invalid request!";
    exit;
}

$name    = trim($_POST['name'] ?? '');
$email   = trim($_POST['email'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

/* Validation */

if ($name == "") {
    echo "Name is required!";
    exit;
}

if ($email == "") {
    echo "Email is required!";
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Enter valid email address!";
    exit;
}

if ($subject == "") {
    echo "Subject is required!";
    exit;
}

if ($message == "") {
    echo "Message cannot be empty!";
    exit;
}

/* Mail */

$to = "daniyalmuhammad320@gmail.com";

$headers  = "From: $name <$email>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

$body  = "New Contact Message\n\n";
$body .= "Name: $name\n";
$body .= "Email: $email\n";
$body .= "Subject: $subject\n\n";
$body .= "Message:\n$message\n";

if (mail($to, $subject, $body, $headers)) {
    echo "OK";
} else {
    echo "Mail server error! Hosting mail disabled.";
}

?>
