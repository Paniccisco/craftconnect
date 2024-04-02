<?php
session_start();
$login_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include "db_conn.php";

  $uname = $_POST['uname'];
  $pass = $_POST['pass'];

  if (empty($uname)) {
    $login_error = "Username is required";
  } elseif (empty($pass)) {
    $login_error = "Password is required";
  } else {
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$uname]);
    $user = $stmt->fetch();

    if ($user && password_verify($pass, $user['password'])) {
      if ($user['role'] === 'admin') {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['fname'] = $user['fname'];
        $_SESSION['pp'] = $user['pp'];
        $_SESSION['role'] = 'admin';
        header("Location: adminhome.php");
        exit;
      } elseif ($user['role'] === 'user') {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['fname'] = $user['fname'];
        $_SESSION['pp'] = $user['pp'];
        $_SESSION['role'] = 'user';
        header("Location: userhome.php");
        exit;
      }
    } else {
      $login_error = "Incorrect Username or Password!";
    }

    $stmt = $conn->prepare("SELECT * FROM sellers WHERE username = ?");
    $stmt->execute([$uname]);
    $seller = $stmt->fetch();

    if ($seller && password_verify($pass, $seller['password'])) {
      if ($seller['status'] == 'approved') {
        $_SESSION['seller_id'] = $seller['seller_id'];
        $_SESSION['fname'] = $seller['businessname'];
        $_SESSION['pp'] = $seller['pp'];
        header("Location: sellerhome.php");
        exit;
      } elseif ($seller['status'] == 'pending') {
        $login_error = "Your account is still pending approval. Please wait for admin approval.";
      } else {
        $login_error = "Incorrect Username or Password!";
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="images/favicon2.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <title>Login / Register</title>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap");

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      padding: 0;
      background-image: url("images/WB 2.png");
      background-size: cover;
      background-position: center;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      font-family: "Poppins", sans-serif;
      overflow: hidden;
      min-height: 100vh;
    }

    h1 {
      font-weight: 700;
      letter-spacing: -1.5px;
      margin: 0;
    }

    h1.title {
      font-size: 45px;
      line-height: 45px;
      margin: 0;
      text-shadow: 0 0 10px rgba(16, 64, 74, 0.5);
    }

    /* 
    .get-find-button {
      color: #ffffe6;
      font-size: 45px;
      line-height: 45px;
      margin: 0;
      text-shadow: 0 0 10px rgba(16, 64, 74, 0.5);
    } */
    .get-find-button {
      color: #ffffe6;
    }

    p {
      font-size: 14px;
      font-weight: 100;
      line-height: 20px;
      letter-spacing: 0.5px;
      margin: 20px 0 30px;
      text-shadow: 0 0 10px rgba(16, 64, 74, 0.5);
    }

    span {
      font-size: 14px;
      margin-top: 20px;
    }

    a {
      color: #333;
      font-size: 14px;
      text-decoration: none;
      margin: 15px 0;
      transition: 0.3s ease-in-out;
    }

    a:hover {
      color: #4bb6b7;
    }

    .content {
      display: flex;
      width: 100%;
      height: 50px;
      align-items: center;
      justify-content: space-around;
    }

    .content .checkbox {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .content input {
      accent-color: #333;
      width: 12px;
      height: 12px;
    }

    .content label {
      font-size: 14px;
      user-select: none;
      padding: 5px;
    }

    button {
      position: relative;
      border-radius: 20px;
      border: 1px solid #113448;
      background-color: #113448;
      color: #fff;
      font-size: 15px;
      font-weight: 700;
      margin: 20px;
      padding: 12px 80px;
      letter-spacing: 1px;
      text-transform: capitalize;
      transition: 0.3s ease-in-out;
      cursor: pointer;
    }

    button:hover {
      letter-spacing: 3px;
    }

    button:active {
      transform: scale(0.95);
    }

    button:focus {
      outline: none;
    }

    button.ghost {
      background-color: rgba(255, 255, 255, 0.2);
      border: 2px solid #fff;
      color: #fff;
    }

    #login i {
      position: absolute;
      left: 50px;
    }

    #register i {
      position: absolute;
      right: 50px;
    }

    button.ghost i {
      position: absolute;
      opacity: 1;
      transition: 0.3s ease-in-out;
      z-index: 6;
    }

    button.ghost i.register {
      right: 70px;
    }

    button.ghost i.login {
      left: 70px;
    }

    button.ghost i.registerseller {
      right: 70px;
    }

    form {
      background-color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      padding: 0 50px;
      height: 100%;
      text-align: center;
    }

    .container {
      border-radius: 25px;
      box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 0px 10px rgba(0, 0, 0, 0.22);
      position: relative;
      overflow: hidden;
      width: 768px;
      max-width: 100%;
      min-height: 550px;
    }

    .form-container {
      position: absolute;
      top: 0;
      height: 100%;
      transition: all 0.6s ease-in-out;
    }

    .form-lg label {
      text-align: left;
      display: block;
      font-size: 16px;
      font-weight: 600;
      padding: 1px;
      text-align: left;
    }

    .register-container input {
      width: 100%;
      margin: 2px;
      border: none;
      outline: none;
      padding: 8px;
      border-radius: 5px;
      border: 1px solid gray;
    }

    .register-container label {
      text-align: left;
      display: block;
      font-size: 10px;
      font-weight: 600;
      padding: 1px;
      text-align: left;
    }

    .error-message {
      color: red;
      text-align: center;
      font-size: 15px;
      margin-top: 10px;
    }

    .username-feedback {
      color: black;
      text-align: center;
      font-size: 13px;
      margin-top: 10px;
    }

    .text-success {
      color: green;
      text-align: center;
      font-size: 13px;
      margin-top: 10px;
    }

    .text-danger {
      color: red;
      text-align: center;
      font-size: 13px;
      margin-top: 10px;
    }

    .form-control {
      width: 100%;
      position: relative;
    }

    .form-control2 input {
      width: 100%;
      margin: 2px;
      border: none;
      outline: none;
      padding: 8px;
      border-radius: 5px;
      border: 1px solid gray;
    }

    .form-control2 label {
      text-align: left;
      display: block;
      font-size: 16px;
      font-weight: 600;
      padding: 1px;
      text-align: left;
    }

    .form-control2 {
      width: 100%;
      position: relative;
    }

    .form-control2 span {
      position: absolute;
      border-bottom: 3px solid #113448;
      left: 0;
      bottom: 8px;
      width: 0%;
      transition: all 0.3s ease;
    }

    .form-control2 input:focus~span {
      width: 100%;
    }

    .form-control span {
      position: absolute;
      border-bottom: 3px solid #113448;
      left: 0;
      bottom: 8px;
      width: 0%;
      transition: all 0.3s ease;
    }

    .form-control input:focus~span {
      width: 100%;
    }

    .form-control2 span {
      position: absolute;
      border-bottom: 3px solid #113448;
      left: 0;
      bottom: 8px;
      width: 0%;
      transition: all 0.3s ease;
    }

    .form-control2 input:focus~span {
      width: 100%;
    }

    .login-container {
      left: 0;
      width: 50%;
      z-index: 2;
    }

    .container.right-panel-active .login-container {
      transform: translateX(100%);
    }

    .register-container {
      left: 0;
      width: 50%;
      opacity: 0;
      z-index: 1;
    }

    .get-post-button {
      display: inline-block;
      padding: 10px 20px;
      background-color: transparent;
      color: #ffffff;
      text-decoration: none;
      border: 2px solid #ffffff;
      border-radius: 5px;
      font-size: 20px;
      transition: background-color 0.3s;
      border-radius: 20px;

    }

    .get-post-button:hover {
      background-color: #113448;
      color: #ffffff;
      z-index: 1;
      box-shadow: 0 50px 80px rgba(0, 0, 0, 0.2);
      transform: scale(1.1);
    }

    .container.right-panel-active .register-container {
      transform: translateX(100%);
      opacity: 1;
      z-index: 5;
      animation: show 0.6s;
    }

    @keyframes show {

      0%,
      49.99% {
        opacity: 0;
        z-index: 1;
      }

      50%,
      100% {
        opacity: 1;
        z-index: 5;
      }
    }

    .overlay-container {
      position: absolute;
      top: 0;
      left: 50%;
      width: 50%;
      height: 100%;
      overflow: hidden;
      transition: transform 0.6s ease-in-out;
      z-index: 100;
    }

    .container.right-panel-active .overlay-container {
      transform: translate(-100%);
    }

    .overlay {
      background-color: #113448;
      background-repeat: no-repeat;
      background-size: cover;
      background-position: 0 0;
      color: #fff;
      position: relative;
      left: -100%;
      height: 100%;
      width: 200%;
      transform: translateX(0);
      transition: transform 0.6s ease-in-out;
    }

    .overlay::before {
      content: "";
      position: absolute;
      left: 0;
      right: 0;
      top: 0;
      bottom: 0;
    }

    .container.right-panel-active .overlay {
      transform: translateX(50%);
    }

    .overlay-panel {
      position: absolute;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      padding: 0 40px;
      text-align: center;
      top: 0;
      height: 100%;
      width: 50%;
      transform: translateX(0);
      transition: transform 0.6s ease-in-out;
    }

    .overlay-left {
      transform: translateX(-20%);
    }

    .container.right-panel-active .overlay-left {
      transform: translateX(0);
    }

    .overlay-right {
      right: 0;
      transform: translateX(0);
    }

    .container.right-panel-active .overlay-right {
      transform: translateX(20%);
    }
  </style>
</head>

<body>
  <div class="container" id="container">
    <div class="form-container register-container">
      <form class="shadow w-450 p-3" action="php/signup.php" method="post" enctype="multipart/form-data">
        <?php if (isset($_GET['error'])) { ?>
          <div class="alert alert-danger" role="alert">
            <?php echo $_GET['error']; ?>
          </div>
        <?php } ?>

        <?php if (isset($_SESSION['success'])) { ?>
          <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['success']; ?>
          </div>
        <?php
          unset($_SESSION['success']);
        } ?>
        <h1>Register here!</h1>

        <div class="form-control">
          <label class="form-label">Full Name</label>
          <input type="text" class="form-control" name="fname" autocomplete="off" value="<?php echo (isset($_GET['fname'])) ? $_GET['fname'] : "" ?>">
        </div>

        <div class="form-control">
          <label class="form-label">Mobile Number</label>
          <input type="number" class="form-control" name="mob" autocomplete="off" value="<?php echo (isset($_GET['mob'])) ? $_GET['mob'] : "" ?>">
        </div>

        <div class="form-control">
          <label class="form-label">Address</label>
          <input type="text" class="form-control" name="address" autocomplete="off" value="<?php echo (isset($_GET['address'])) ? $_GET['address'] : "" ?>">
        </div>

        <div class="form-control">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" name="email" autocomplete="off" value="<?php echo (isset($_GET['email'])) ? $_GET['email'] : "" ?>">
        </div>

        <div class="form-control">
          <label class="form-label">Username</label>
          <input type="text" class="form-control" name="uname" id="username" autocomplete="off" value="<?php echo (isset($_GET['uname'])) ? $_GET['uname'] : "" ?>">
          <div class="username-feedback"></div>
        </div>

        <div class="form-control">
          <label class="form-label">Password</label>
          <input type="password" class="form-control" name="pass" id="password" minlength="8" required>
        </div>

        <div class="form-control">
          <label class="form-label">Profile Picture</label>
          <input type="file" class="form-control" name="pp">
        </div>

        <button type="submit" class="btn btn-primary">Sign Up</button>
      </form>
    </div>

    <script src="js/username_checker.js"></script>

    </script>
    <div class="form-container login-container">
      <form class="shadow w-450 p-3" action="" method="post">
        <h1>Welcome, Login Here!</h1>
        <div class="form-control2">
          <label>Username</label>
          <input type="text" class="form-control" name="uname" autocomplete="off" value="<?php echo (isset($_GET['uname'])) ? $_GET['uname'] : "" ?>" required>
        </div>
        <div class="form-control2">
          <label>Password</label>
          <input type="password" class="form-control" name="pass" required>
        </div>

        <div class="error-message" id="error-message">
          <?php echo $login_error; ?>
        </div>

        <div class="content">
          <div class="checkbox">
            <input type="checkbox" name="checkbox" id="checkbox" />
            <label>Remember me</label>
          </div>
          <div class="pass-link">
            <a href="password_reset.php">Forgot password?</a>
          </div>
        </div>
        <button type="submit" value="submit">Login</button>
      </form>
    </div>

    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-left">
          <h1 class="title">
            Hello, <br />
            Crafters!
          </h1>
          <p>If you have an account, login here and happy finding!</p>
          <button class="ghost" id="login">
            Login
            <i class="fa-solid fa-arrow-left"></i>
          </button>
        </div>

        <div class="overlay-panel overlay-right">
          <h1 class="title">
            Start your <br>
            journey <br>
            NOW <br>
          </h1>
          <p>
            Explore our platform, sign up, and start your crafting journey today! Discover talented sellers <a href="guest.php" class="get-find-button">click here</a>
          </p>
          <button class="ghost" id="register">
            Register
            <i class="fa-solid fa-arrow-right"></i>
          </button>
          <a href="regseller.php" class="get-post-button" id="registerseller">Become a Seller</a>
        </div>
      </div>
    </div>
  </div>
  <script src="js/design.js"></script>
</body>

</html>