<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['order_btn'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $address = mysqli_real_escape_string($conn, 'no. '. $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query gagal');
   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      }
   }

   $total_products = implode(', ',$cart_products);

   $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query gagal');

   if($cart_total == 0){
      $message[] = 'keranjang Anda kosong';
   }else{
      if(mysqli_num_rows($order_query) > 0){
         $message[] = 'pesanan sudah pernah dibuat!'; 
      }else{
         mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query gagal');
         $message[] = 'pesanan berhasil dibuat!';
         mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query gagal');
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
   <title>checkout</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>pembayaran</h3>
   <p> <a href="home.php">beranda</a> / pembayaran </p>
</div>

<section class="display-order">

   <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query gagal');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
   ?>
   <p> <?php echo $fetch_cart['name']; ?> <span>(<?php echo 'Rp'.$fetch_cart['price'].'/-'.' x '. $fetch_cart['quantity']; ?>)</span> </p>
   <?php
      }
   }else{
      echo '<p class="empty">keranjang Anda kosong</p>';
   }
   ?>
   <div class="grand-total"> total keseluruhan : <span>Rp<?php echo $grand_total; ?>/-</span> </div>

</section>

<section class="checkout">

   <form action="" method="post">
      <h3>buat pesanan Anda</h3>
      <div class="flex">
         <div class="inputBox">
            <span>nama Anda :</span>
            <input type="text" name="name" required placeholder="masukkan nama Anda">
         </div>
         <div class="inputBox">
            <span>nomor Anda :</span>
            <input type="number" name="number" required placeholder="masukkan nomor Anda">
         </div>
         <div class="inputBox">
            <span>email Anda :</span>
            <input type="email" name="email" required placeholder="masukkan email Anda">
         </div>
         <div class="inputBox">
            <span>metode pembayaran :</span>
            <select name="method">
               <option value="cash on delivery">cash on delivery</option>
               <option value="credit card">credit card</option>
               <option value="paypal">paypal</option>
               <option value="paytm">paytm</option>
            </select>
         </div>
         <div class="inputBox">
            <span>alamat baris 01 :</span>
            <input type="number" min="0" name="flat" required placeholder="cth: no. flat">
         </div>
         <div class="inputBox">
            <span>alamat baris 02 :</span>
            <input type="text" name="street" required placeholder="cth: nama jalan">
         </div>
         <div class="inputBox">
            <span>kota :</span>
            <input type="text" name="city" required placeholder="cth: jakarta">
         </div>
         <div class="inputBox">
            <span>provinsi :</span>
            <input type="text" name="state" required placeholder="cth: dki jakarta">
         </div>
         <div class="inputBox">
            <span>negara :</span>
            <input type="text" name="country" required placeholder="cth: indonesia">
         </div>
         <div class="inputBox">
            <span>kode pos :</span>
            <input type="number" min="0" name="pin_code" required placeholder="cth: 123456">
         </div>
      </div>
      <div align="center">
      <input type="submit" value="pesan sekarang" class="btn" name="order_btn">
      </div>
   </form>

</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
