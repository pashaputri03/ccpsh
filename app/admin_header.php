<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<header class="header">

   <section class="flex">

      <a href="../admin/dashboard.php" class="logo">Admin<span>Meduro?</span></a>

      <nav class="navbar">
         <a href="dashboard.php">home</a>
         <a href="products.php">produk</a>
         <a href="placed_orders.php">pesanan</a>
         <a href="admin_accounts.php">admin</a>
         <a href="users_accounts.php">pengguna</a>
         <a href="messages.php">pesan</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="update_profile.php" class="btn">update profile</a>
         <div class="flex-btn">
            <a href="register_admin.php" class="option-btn">register</a>
            <a href="admin_login.php" class="option-btn">login</a>
         </div>
         <a href="admin_logout.php" class="delete-btn" onclick="return confirm('keluar dari halaman admin?');">logout</a> 
      </div>

   </section>

</header>