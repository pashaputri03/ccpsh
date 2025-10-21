<?php
ob_start(); 
session_start();
include 'connect.php';


if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = strip_tags($email);
   $pass = sha1($_POST['pass']);
   $pass = strip_tags($pass);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $_SESSION['user_id'] = $row['id'];
      header('location:index.php');
   }else{
      $message[] = 'username dan password salah!';
   }

}
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css?=<?php echo time(); ?>">

</head>
<body>
   
<?php include 'user_header.php'; ?>

<section class="form-container">

   <form action="" method="post">
      <h3>login sekarang</h3>
      <input type="email" name="email" required placeholder="masukkann email" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="masukkan password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="login sekarang" class="btn" name="submit">
      <p>tidak punya akun?</p>
      <a href="user_register.php" class="option-btn">buat akun</a>
   </form>

</section>













<?php include 'footer.php'; ?>

<script src="script.js"></script>

</body>
</html>