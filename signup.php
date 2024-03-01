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
    }

    .message_feedback.success {
      background: #ccffd0;
    }

    .message_feedback.fail {
      background: #ffc8c8;
    }
  </style>

</head>
<body>
  <?php
    $db_connection = new mysqli("localhost", "root", "", "authentication_simple");

    if(isset($_POST['login_btn'])){
      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
      $email = $_POST['email'];

      $username = $_POST['username'];
      $password = $_POST['password'];

      // check whether a user of the same username exists in the users' table
      $slq_check = "SELECT * FROM users WHERE user_username='$username'";
      
      if(mysqli_num_rows($db_connection -> query($slq_check)) == true) {
        // if the user exists
        echo "
          <div class='message_feedback fail'>
            The username you entered is already being used by another user. Try another.
          </div>
        ";
      } else {
        // if the user does nto exist yet, register them
        $sql_register_user = "INSERT INTO users (
                              user_firstname,
                              user_lastname,
                              user_email,
                              user_username,
                              user_password
                            ) VALUES (
                              '$firstname',
                              '$lastname',
                              '$email',
                              '$username',
                              '$password'
                            )";

        if(($db_connection -> query($sql_register_user)) == true){
          echo "
            <div class='message_feedback success'>
              Your account has been created. You can now <a href='index.php'>Login here</a>
            </div>
          ";
        } else {
          echo "
            <div class='message_feedback fail'>
              Something went wrong. Please, try again.
            </div>  
          ";
        }
      }
    }
  ?>

  <h2>Signup</h2>

  <form method="post">
    <input type="text" name="firstname" id="" placeholder="Firstname" required>
    <br>
    <br>
    <input type="text" name="lastname" id="" placeholder="Lastname">
    <br>
    <br>
    <input type="email" name="email" id="" placeholder="Email" required>
    <br>
    <br>
    <input type="text" name="username" id="" placeholder="Username" required>
    <br>
    <br>
    <input type="password" name="password" id="" placeholder="Password" required>
    <br>
    <br>
    <input type="submit" name="login_btn" value="Create Account">
  </form>

  <br>

  Already have an account? <a href="index.php">Login instead</a>
</body>
</html>