<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <style>
    body {
      text-align: center;
    }

    .message_feedback {
      overflow: auto;
      width: auto;
      padding: 10px 15px;
      background: #ffc8c8;
    }
  </style>

</head>
<body>
  <?php
    $db_connection = new mysqli("localhost", "root", "", "authentication_simple");

    if(isset($_POST['login_btn'])){
      $username = $_POST['username'];
      $password = $_POST['password'];

      // check whether use exists in the users' table
      $slq_check = "SELECT * FROM users WHERE user_username='$username' AND user_password='$password'";

      if(mysqli_num_rows($db_connection -> query($slq_check)) == true) {
        // if the user exists
        header("location: home.php");
      } else {
        // if the user does nto exist
        echo "
          <div class='message_feedback fail'>
            Wrong username or password. Try again.
          </div>
        ";
      }
    }
  ?>

  <h2>Login</h2>

  <form method="post">
    <input type="text" name="username" id="" placeholder="Username">
    <br>
    <br>
    <input type="password" name="password" id="" placeholder="Password">
    <br>
    <br>
    <input type="submit" name="login_btn" value="Login">
  </form>

  <br>

  Don't have an account? <a href="signup.php">Create Account</a>
</body>
</html>