<?php
include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $user_type = $_POST['user_type'];

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('Query gagal');

   if(mysqli_num_rows($select_users) > 0){
      $message = 'Pengguna sudah ada!';
   } else {
      if($pass != $cpass){
         $message = 'Konfirmasi kata sandi tidak cocok!';
      } else {
         mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$pass', '$user_type')") or die('Query gagal');
         $message = 'Terdaftar berhasil!';
         header('location:login.php');
         exit();
      }
   }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Daftar</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <style>
      body { font-family: Arial, sans-serif; background: lightgray; margin: 0; display: flex; justify-content: center; align-items: center; height: 100vh; }
      .message { background: mistyrose; color: darkred; padding: 10px; margin: 10px 0; border: 1px solid darkred; border-radius: 5px; position: relative; text-align: center; }
      .message i { position: absolute; top: 10px; right: 10px; cursor: pointer; }
      .form-container { background: white; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border-radius: 8px; width: 100%; max-width: 400px; box-sizing: border-box; }
      .form-container h3 { margin-bottom: 20px; font-size: 24px; color: darkslategray; text-align: center; }
      .form-container input[type="text"], .form-container input[type="email"], .form-container input[type="password"], .form-container select, .form-container input[type="submit"] { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid lightgray; border-radius: 5px; box-sizing: border-box; }
      .form-container input[type="submit"] { background: dodgerblue; color: white; border: none; cursor: pointer; font-size: 16px; }
      .form-container p { text-align: center; color: dimgray; }
      .form-container a { color: dodgerblue; text-decoration: none; }
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
      <h3>Daftar Sekarang</h3>
      <input type="text" name="name" placeholder="Masukkan nama Anda" required>
      <input type="email" name="email" placeholder="Masukkan email Anda" required>
      <input type="password" name="password" placeholder="Masukkan kata sandi Anda" required>
      <input type="password" name="cpassword" placeholder="Konfirmasi kata sandi Anda" required>
      <select name="user_type">
         <option value="user">pengguna</option>
         <option value="admin">admin</option>
      </select>
      <input type="submit" name="submit" value="Daftar Sekarang">
      <p>Sudah punya akun? <a href="login.php">Masuk sekarang</a></p>
   </form>
</div>

</body>
</html>
