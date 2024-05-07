
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login </title>
  <link rel="stylesheet" href="styles.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
  <div class="wrapper">
  
    <form method="post" action="">
      <h1>Login</h1>
      <div class="input-box">
        <input value="a@a.a" type="email" name="email" placeholder="Email" required>
        <i class='bx bxs-user'></i>
      </div>
      <div class="input-box">
        <input value="a" type="password" name="password" placeholder="password" required>
        <i class='bx bxs-lock-alt'></i>
      </div>
      
      <button type="submit" class="btn" name="login">Login</button>
    </form>
  </div>

<?php

session_start();

try {
    $pdo = new PDO("mysql:host=localhost;dbname=ged", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";


  if(isset($_POST['login'])){
      $email = $_POST['email'];
      $password = $_POST['password'];
      
      $login_query = "SELECT * FROM utilisateur WHERE user_email=:email AND password=:password";
      
      $login_stmt = $pdo->prepare($login_query);
      $login_stmt->bindParam(':email', $email);
      $login_stmt->bindParam(':password', $password);
      $login_stmt->execute();
      
      if($login_stmt->rowCount() == 1){
          $user = $login_stmt->fetch(PDO::FETCH_ASSOC);

          // echo "Welcome, ssss";

          $_SESSION['email'] = $email;
          $_SESSION['rolee'] = $user['rolee'];
          if($user['rolee'] == 'admin'){
              header("Location: ../admin/weblab/index.php");
              exit();
          } else {
              header("Location: ../user/HOME/index.php");
              exit();
          }
      } else {
          echo "Email ou mot de passe incorrect";
      }
    }

    } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

</body>
</html>