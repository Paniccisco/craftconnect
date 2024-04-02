<?php
session_start();
include "../db_conn.php";

if (isset($_POST['reset_password_submit'])) {
    // Validate and sanitize email
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

    if (!$email) {
        // Invalid email format
        header("Location: ../password_reset.php?error=invalid_email");
        exit;
    }

    // Check if the email exists in the database
    $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Generate a unique token for the password reset
        $token = bin2hex(random_bytes(32));

        // Insert the token and user's email address into the password_reset table
        $stmt = $conn->prepare("INSERT INTO password_reset (token, email, created_at) VALUES (?, ?, NOW())");
        $stmt->execute([$token, $email]);

        // Construct the password reset link
        $reset_link = "http://localhost/craftconnect/password_reset_success.php?token=$token";

        // Send the password reset email
        $subject = "Password Reset Request";
        $message = "To reset your password, click the following link:\n\n$reset_link";
        $headers = "From: your_email@example.com"; // Update with your email address
        if (mail($email, $subject, $message, $headers)) {
            // Email sent successfully, redirect the user to the success page
            header("Location: ../password_reset_success.php");
            exit;
        } else {
            // Error sending email
            header("Location: ../password_reset.php?error=email_not_sent");
            exit;
        }
    } else {
        // Email not found in the database
        header("Location: ../password_reset.php?error=email_not_found");
        exit;
    }
} else {
    // If the form was not submitted, redirect the user to the reset password page
    header("Location: ../password_reset.php");
    exit;
}
?>
