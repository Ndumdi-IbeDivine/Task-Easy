<?php
  include("user/database.php")
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Task Easy Task-manager</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">

</head>
<body class="register">
  
  <div class="container">

    <!-- php code for registration -->
    <?php
        if (isset($_POST["submit"])) {
          $fullName = $_POST["fullname"];
          $email = $_POST["email"];
          $password = $_POST["password"];
          $passwordRepeat = $_POST["repeat_password"];
           
          $passwordHash = password_hash($password, PASSWORD_DEFAULT);

          $errors = array();
           
          if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
            array_push($errors,"All fields are required");
          }
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid");
          }
          if (strlen($password)<8) {
            array_push($errors,"Password must be at least 8 characters long");
          }
          if ($password!==$passwordRepeat) {
            array_push($errors,"Password does not match");
          }

          //  requiring the database information from database.php file
          require_once "user/database.php";

          // To check if user is already registered by checking if email exists
          $sql = "SELECT * FROM users WHERE email = '$email'";
          $result = mysqli_query($conn, $sql);
          $rowCount = mysqli_num_rows($result);
          if ($rowCount>0) {
            array_push($errors,"Email already exists!");
          }
          if (count($errors)>0) {
            foreach ($errors as  $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
          }else{
            
            // To insert user into the database
            $sql = "INSERT INTO users (full_name, email, password) VALUES ( ?, ?, ? )";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"sss",$fullName, $email, $passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>You are registered successfully.</div>";

                if (isset($_SESSION["add"])) {
                  header("location:".SITEURL."welcome-page.php");
                }
            }else{
                die("Something went wrong");
            }
          }

        }
        ?>
    <form action="register.php" method="POST">

    <div class="register-text">
      <h3>Register For TaskEasy</h3>
    </div>

    <div class="form-group">
      <input type="text" class="form-control" name="fullname" placeholder="Full Name:">
    </div><br>
    <div class="form-group">
      <input type="email" class="form-control" name="email" placeholder="Email:">
    </div><br>
    <div class="form-group">
      <input type="password" class="form-control" name="password" placeholder="Password:">
    </div><br>
    <div class="form-group">
      <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password:">
    </div><br>
    <div class="form-btn">
      <input type="submit" class="btn btn-primary" value="Register" name="submit">
    </div>

    </form>
  </div>

</body>
</html>