<?php
ob_start();
session_start();

include 'connect.php';


if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css?=<?php echo time(); ?>">

</head>
<body>
   
<?php include 'user_header.php'; ?> 

<div class="home-bg">

<section class="home">

   <div class="swiper home-slider">
   
   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <div class="image">
            <img src="bimoli.png" alt="">
         </div>
         <div class="content">
            <span>spesial rego bolo dewe</span>
            <h3>minyak bimoli</h3>
            <a href="shop.php" class="btn" >langsung tumbas</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="beras.png" alt="">
         </div>
         <div class="content">
            <span>paling murah jon</span>
            <h3>beras premium sania </h3>
            <a href="shop.php" class="btn">langsung tumbas</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="gula.png" alt="">
         </div>
         <div class="content">
            <span>gula spesial</span>
            <h3>Gulaku</h3>
            <a href="shop.php" class="btn">langsung tumbas</a>
         </div>
      </div>

   </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

</div>

<section class="category">

   <h1 class="heading">kategori</h1>

   <div class="swiper category-slider">

   <div class="swiper-wrapper">

   <a href="category.php?category=1" class="swiper-slide slide">
      <img src="1.png" alt="">
      <h3>Sembako</h3>
   </a>

   <a href="category.php?category=2" class="swiper-slide slide">
      <img src="2.png" alt="">
      <h3>Peralatan Mandi</h3>
   </a>

   <a href="category.php?category=3" class="swiper-slide slide">
      <img src="3.png" alt="">
      <h3>Minuman</h3>
   </a>

   <a href="category.php?category=4" class="swiper-slide slide">
      <img src="4.png" alt="">
      <h3>Makanan</h3>
   </a>

   <a href="category.php?category=5" class="swiper-slide slide">
      <img src="5.png" alt="">
      <h3>Rokok</h3>
   </a>

   <a href="category.php?category=6" class="swiper-slide slide">
      <img src="6.png" alt="">
      <h3>Kesehatan</h3>
   </a>

   <a href="category.php?category=7" class="swiper-slide slide">
      <img src="7.png" alt="">
      <h3>LPG</h3>
   </a>

   <a href="category.php?category=8" class="swiper-slide slide">
      <img src="8.png" alt="">
      <h3>Peralatan Tulis</h3>
   </a>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>

<section class="home-products">

   <h1 class="heading">produk terbaru</h1>

   <div class="swiper products-slider">

   <div class="swiper-wrapper">

   <?php
     $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?> 
   <form action="" method="post" class="swiper-slide slide">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
      <div class="name"><?= $fetch_product['name']; ?></div>
      <div class="flex">
         <div class="price"><span>Rp.</span><?= $fetch_product['price']; ?><span>,00</span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="tambahkan ke keranjang" class="btn" name="add_to_cart">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?> 

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>









<?php include 'footer.php'; ?> 

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="script.js"></script>

<script>

var swiper = new Swiper(".home-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
    },
});

 var swiper = new Swiper(".category-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
         slidesPerView: 2,
       },
      650: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 4,
      },
      1024: {
        slidesPerView: 5,
      },
   },
});

var swiper = new Swiper(".products-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      550: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html> 

