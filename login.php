<?php
# Initialize session
session_start();

# Check if user is already logged in, If yes then redirect him to index page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == TRUE) {
  echo "<script>" . "window.location.href='./'" . "</script>";
  exit;
}

# Include connection
require_once "./config.php";

# Define variables and initialize with empty values
$user_login_err = $user_password_err = $login_err = "";
$user_login = $user_password = "";

# Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty(trim($_POST["user_login"]))) {
    $user_login_err = "Please enter your username or an email id.";
  } else {
    $user_login = trim($_POST["user_login"]);
  } 

  if (empty(trim($_POST["user_password"]))) {
    $user_password_err = "Please enter your password.";
  } else {
    $user_password = trim($_POST["user_password"]);
  }

  # Validate credentials 
  if (empty($user_login_err) && empty($user_password_err)) {
    # Prepare a select statement
    $sql = "SELECT id, username, password FROM users WHERE username = ? OR email = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
      # Bind variables to the statement as parameters
      mysqli_stmt_bind_param($stmt, "ss", $param_user_login, $param_user_login);

      # Set parameters
      $param_user_login = $user_login;

      # Execute the statement
      if (mysqli_stmt_execute($stmt)) {
        # Store result
        mysqli_stmt_store_result($stmt);

        # Check if user exists, If yes then verify password
        if (mysqli_stmt_num_rows($stmt) == 1) {
          # Bind values in result to variables
          mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);

          if (mysqli_stmt_fetch($stmt)) {
            # Check if password is correct
            if (password_verify($user_password, $hashed_password)) {

              # Store data in session variables
              $_SESSION["id"] = $id;
              $_SESSION["username"] = $username;
              $_SESSION["loggedin"] = TRUE;

              # Redirect user to index page
              echo "<script>" . "window.location.href='./'" . "</script>";
              exit;
            } else {
              # If password is incorrect show an error message
              $login_err = "The email or password you entered is incorrect.";
            }
          }
        } else {
          # If user doesn't exists show an error message
          $login_err = "Invalid username or password.";
        }
      } else {
        echo "<script>" . "alert('Oops! Something went wrong. Please try again later.');" . "</script>";
        echo "<script>" . "window.location.href='./login.php'" . "</script>";
        exit;
      }

      # Close statement
      mysqli_stmt_close($stmt);
    }
  }

  # Close connection
  mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User login system</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/main.css">
  <link rel="shortcut icon" href="./img/faviconn.png" type="image/x-icon">
  <script defer src="./js/script.js"></script>
  <style>
  body {
    background-image: url('img/bl.png');
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center;
    margin: 0;
    padding: 0;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.form-wrap {
  background: linear-gradient(65deg, rgba(110, 228, 255, 0.521),rgba(240, 252, 255, 0.899), rgba(101, 157, 255, 0.57));
  box-shadow: 0px 4px 10px  rgba(0, 0, 0, 0.079);
    padding: 20px;
    border-radius: 10%;
    width: 420px;
    max-width: 100%;
    transition: transform 0.3s ease-in-out;
}

.form-wrap:hover {
    transform: scale(1.05);
    box-shadow: 0px 6px 15px  rgba(165, 229, 255, 0.979);
}

.form-wrap h1 {
    color: #333;
    text-align: center;
    margin-bottom: 20px;
}

.form-wrap p {
    color: #777;
    text-align: center;
    margin-bottom: 20px;
}

.form-wrap input[type="text"],
.form-wrap input[type="password"]{
  background: none;
  border: 1px solid #353535;
  padding: 10px;
  font-size: 16px;
  border-radius: 15px;
  color: #0055ff;
  width: 100%;
  box-shadow: rgba(236, 251, 255, 0.893) 0px -23px 25px 0px inset,
            rgba(233, 251, 255, 0.804) 0px -36px 30px 0px inset,
            rgba(223, 254, 255, 0.795) 0px -79px 40px 0px inset,
            rgba(222, 243, 255, 0.942) 0px 2px 1px;
          /* This is a generic black color */

}

.form-wrap input[type="submit"] {
  position: relative;
  display: inline-block;
  padding: 15px 24px;
  text-align: center;
  letter-spacing: 1px;
  text-decoration: none;
  background: linear-gradient(45deg, rgb(16, 137, 211) 0%, rgb(18, 177, 209) 100%);  transition: ease-out 0.5s;
  border: 2px solid;
  border-radius: 10em;
  box-shadow: inset 0 0 0 0 blue;
  margin: 20px 0 10px 0;
  color: blue;
  font-size: 15px;
  font-weight: 500;
  height: 50px;
  width: 100%;
  cursor: pointer;
}
.form-wrap input[type="submit"]:hover{
  color: white;
  box-shadow: inset 0 -100px 0 0 royalblue;
}

.form-wrap input[type="checkbox"] {
    margin-right: 5px;
    cursor: pointer;
}

.form-wrap input[type="checkbox"]:hover {
    transform: scale(1.1);
}
.container {
    position: absolute;
    right: 0;
    top: 0;
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content:left;
    align-items: center;
    border-radius: 50px; /* Increase this value for more rounded corners */
    overflow: hidden; /* Ensure contents inside the container stay within rounded corners */
}
.row {
    margin-right: 0; /* Remove default margin */
}

.col-lg-5 {
    max-width: 420px; /* Adjust the max-width as needed */
    width: 100%;
}
  </style>
</head>

<body>
  <div class="container">
    <div class="row min-vh-100 justify-content-center align-items-center">
      <div class="col-lg-5">
        <?php
        if (!empty($login_err)) {
          echo "<div class='alert alert-danger'>" . $login_err . "</div>";
        }
        ?>
        <div class="form-wrap border rounded p-4">
          <h1>Log In</h1>
          <p>Please login to continue</p>
          <!-- form starts here -->
          <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>
            <div class="mb-3">
              <label for="user_login" class="form-label">Email or username</label>
              <input type="text" class="form-control" name="user_login" id="user_login" value="<?= $user_login; ?>">
              <small class="text-danger"><?= $user_login_err; ?></small>
            </div>
            <div class="mb-2">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" name="user_password" id="password">
              <small class="text-danger"><?= $user_password_err; ?></small>
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="togglePassword">
              <label for="togglePassword" class="form-check-label">Show Password</label>
            </div>
            <div class="mb-3">
              <input type="submit" class="btn btn-primary form-control" name="submit" value="Log In">
            </div>
            <p class="mb-0">Don't have an account ? <a href="./register.php">Sign Up</a></p>
          </form>
          <!-- form ends here -->
        </div>
      </div>
    </div>
  </div>
</body>

</html>