<?php
session_start( );

include 'connect.php';


if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = strip_tags($name);
   $email = $_POST['email'];
   $email = strip_tags($email);
   $pass = sha1($_POST['pass']);
   $pass = strip_tags($pass);
   $cpass = sha1($_POST['cpass']);
   $cpass = strip_tags($cpass);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select_user->execute([$email,]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $message[] = 'email sudaah terdaftar!';
   }else{
      if($pass != $cpass){
         $message[] = 'konfirmasi password tidak sama!';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `users`(name, email, password) VALUES(?,?,?)");
         $insert_user->execute([$name, $email, $cpass]);
         $message[] = 'buat akun sukses, login sekarang!';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css?=<?php echo time(); ?>"">

</head>
<body>
   
<?php include 'user_header.php'; ?>

<section class="form-container">

   <form action="" method="post">
      <h3>buat akun</h3>
      <input type="text" name="name" required placeholder="masukkan username" maxlength="20"  class="box">
      <input type="email" name="email" required placeholder="masukkan email" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="mmasukkan password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" required placeholder="konfirmasi password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="register now" class="btn" name="submit">
      <p>sudah punya akun?</p>
      <a href="user_login.php" class="option-btn">login sekarang</a>
   </form>

</section>













<?php include 'footer.php'; ?>

<script src="script.js"></script>

</body>
</html>