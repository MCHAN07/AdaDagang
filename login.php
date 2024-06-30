<?php
include 'config.php';
session_start();

if(isset($_POST['submit'])){
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('Query gagal');

   if(mysqli_num_rows($select_users) > 0){
      $row = mysqli_fetch_assoc($select_users);

      if($row['user_type'] == 'admin'){
         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');
      } elseif($row['user_type'] == 'user'){
         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');
      }
   } else {
      $message = 'Email atau kata sandi salah!';
   }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Masuk</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <style>
      body { font-family: Arial, sans-serif; background: lightgray; margin: 0; display: flex; justify-content: center; align-items: center; height: 100vh; }
      .message { background: mistyrose; color: darkred; padding: 10px; margin: 10px 0; border: 1px solid darkred; border-radius: 5px; position: relative; text-align: center; }
      .message i { position: absolute; top: 10px; right: 10px; cursor: pointer; }
      .form-container { background: white; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border-radius: 8px; width: 100%; max-width: 400px; box-sizing: border-box; }
      .form-container h3 { margin-bottom: 20px; font-size: 24px; color: darkslategray; text-align: center; }
      .form-container input[type="email"], .form-container input[type="password"], .form-container input[type="submit"] { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid lightgray; border-radius: 5px; box-sizing: border-box; }
      .form-container input[type="submit"] { background: #23D5CC; color: white; border: none; cursor: pointer; font-size: 16px; }
      .form-container input[type="submit"]:hover { background: #1EB2A9; }
      .form-container p { text-align: center; color: dimgray; }
      .form-container a { color: #23D5CC; text-decoration: none; }
   </style>
</head>
<body>

<?php if(isset($message)): ?>
   <div class="message">
      <span><?= $message ?></span>
      <i class="fas fa-times" onclick="this.parentElement.style.display='none';"></i>
   </div>
<?php endif; ?>

<div class="form-container">
   <form action="" method="post">
      <h3>Masuk Sekarang</h3>
      <input type="email" name="email" placeholder="Masukkan email Anda" required>
      <input type="password" name="password" placeholder="Masukkan kata sandi Anda" required>
      <input type="submit" name="submit" value="Masuk Sekarang">
      <p>Belum punya akun? <a href="register.php">Daftar sekarang</a></p>
   </form>
</div>

</body>
</html>

