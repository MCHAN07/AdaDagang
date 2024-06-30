<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>tentang kami</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>tentang kami</h3>
   <p> <a href="home.php">beranda</a> / tentang </p>
</div>

<section class="about">
<div class="flex">
<div class="content" align="center">
         <h3>Kenapa harus memilih Ada Dagang?</h3>
         <p>Visi AdaDagang adalah membangun sebuah ekosistem terintegrasi untuk mendukung transformasi digital rantai pasok bisnis Indonesia dengan misi memberdayakan pelaku bisnis melalui digitalisasi operasional bisnis dengan layanan teknologi digital yang aman dan terdepan. Layanan Ada Dagang mencakup Marketplace dan Ada Dagang Logistik.</p>
         <a href="contact.php" class="btn">hubungi kami</a>
      </div>
</div>
   <div class="flex">

      <div class="image">
         <img src="images/about-img.jpg" alt="About Image" align="left">
      </div>

   </div>

</section>

<section class="gallery">
   <h1 class="title">Galeri Kami</h1>
      <div class="box" align="left">
         <img src="images/pic1.jpg" alt="Galeri Image 1">
         <img src="images/pic3.jpg" alt="Galeri Image 2">
         <img src="images/pic0.jpg" alt="Galeri Image 2">
   </div>
</section>

<section class="authors">

   <h1 class="title">Team Leader</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/bos.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Chandra Aditya</h3>
      </div>

      <div class="box">
         <img src="images/bos.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>Rezza Fahlevi</h3>
      </div>

   </div>

</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
