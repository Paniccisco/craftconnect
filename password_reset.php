<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>
<body>
    <h2>Forgot Your Password?</h2>
    <p>Enter your email address below to receive a password reset link.</p>
    <form action="php/password_reset.php" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <button type="submit" name="reset_password_submit">Reset Password</button>
    </form>
</body>
</html>
