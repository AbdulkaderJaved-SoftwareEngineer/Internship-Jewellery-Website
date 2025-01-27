

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hert Jewellery Store</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./css/styles.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
   

    <script> 
$(document).ready(function(){
  $("#faq-title").click(function(){
    $("#faq-content").slideToggle("slow");
  });


});


function myFunction() {
  document.getElementById("#faq-arrow").style.rotate = "90deg";
}
</script>
</head>
<body>

<?php 

include "navbar.php"
?>

<!-- we start hero section from here .This is a heroa section  -->
<section id="main-banner">
    <div class="main-banner-box">
        <img src="assests/banner_2.webp" alt="">
        <div class="main-banner-text">
            <h1>Shop Imitation Jewellery</h1>
            <p>Designer Imitation Jewellery , Earings , Necklace , Bracelest</p>
           <br>
            <a href="#wwp">Explore </a>
        </div>
    </div>
</section>

<!--End hero section  -->







<!-- What we provide -->
<section class='what-we-provide' id="wwp">
        
    <div class="w-info-box">
    <div class="w-info-icon">
    <i class="fa-solid fa-plane"></i>

    </div>

    <div class="w-info-text">

    <strong>Hassle Free Shipping</strong>
    <p>We provide free shipping</p>
    </div>
        </div>




        <div class="w-info-box">
    <div class="w-info-icon">
    <i class="fa-solid fa-credit-card"></i>

    </div>

    <div class="w-info-text">

    <strong>100% Secure Payment</strong>
    <p>Your payment is secure with us.</p>
    </div>

    




    
        </div>
        <div class="w-info-box">
    <div class="w-info-icon">
    <i class="fa-solid fa-message"></i>

    </div>

    <div class="w-info-text">

    <strong>24/7 Contact Support</strong>
    <p>we do the support</p>
    </div>

    




    
        </div>
</section>

<div class="latest-arrivals">
    <span>Latest Arrivals</span>
</div>

<section class="product-grid">
    <div class="product-grid-half">

        <div class="product-grid-box">
            <img src="assests/box1.webp" alt="rings" srcset="">
            <div class="product-grid-text">
                <span>Beautiful</span>
                <strong>Wedding Ring</strong>
                <a href="products.php">Shop Now</a>
            </div>


        </div>






        <div class="product-grid-box">
            <img src="assests/box2.webp" alt="rings" srcset="">
            <div class="product-grid-text">
                <span>Elegant</span>
                <strong>Earings</strong>
                <a href="products.php">Shop Now</a>
            </div>


        </div>






        <div class="product-grid-box">
            <img src="assests/box3.webp" alt="rings" srcset="">
            <div class="product-grid-text">
                <span>Comfortable</span>
                <strong>Neclaces</strong>
                <a href="products.php">Shop Now</a>
            </div>
        </div>
            
            <div class="product-grid-box">
            <img src="assests/box2.webp" alt="rings" srcset="">
            <div class="product-grid-text">
                <span>Comfortable</span>
                <strong>Neclaces</strong>
                <a href="products.php">Shop Now</a>
            </div>
</div>

<div class="product-grid-box">
            <img src="assests/box1.webp" alt="rings" srcset="">
            <div class="product-grid-text">
                <span>Comfortable</span>
                <strong>Neclaces</strong>
                <a href="products.php">Shop Now</a>
            </div>
</div>


        </div>
    </div>




</section>






<!-- What are customer say  -->

<section class="customer-reviews">
  <h2 class="section-title">What Our Customers Say</h2>
  <div class="reviews-grid">
    <div class="review-box">
      <p class="review-text">"Absolutely love the quality and designs! Highly recommend."</p>
      <div class="review-author">
      <i class="fa-solid fa-user"></i>
        <div>
          <strong>Iron man</strong>
          <span>Verified Buyer</span>
        </div>
      </div>
    </div>
    <div class="review-box">
      <p class="review-text">"Fast delivery and beautiful products. Will shop again!"</p>
      <div class="review-author">
      <i class="fa-solid fa-user"></i>
        <div>
          <strong>Hulk</strong>
          <span>Verified Buyer</span>
        </div>
      </div>
    </div>
    <div class="review-box">
      <p class="review-text">"Great customer service and unique jewelry pieces."</p>
      <div class="review-author">
      <i class="fa-solid fa-user"></i>
        <div>
          <strong>Spiderman</strong>
          <span>Verified Buyer</span>
        </div>
      </div>
    </div>



    <div class="review-box">
      <p class="review-text">"Great customer service and unique jewelry pieces."</p>
      <div class="review-author">
      <i class="fa-solid fa-user"></i>
        <div>
          <strong>Thor </strong>
          <span>Verified Buyer</span>
        </div>
      </div>
    </div>


  </div>
</section>




<section class="faq">
    <h2 style="font-size: 2.5rem; margin-left:40%;"><u>FAQ</u></h2>
    <div class="faq-panel">
        <h3 class="faq-title"><i class="fa-solid fa-arrow-right faq-arrow"></i>What we do?</h3>
        <p class="faq-content">
            Welcome to <strong>KJ Imitation Jewellery Store</strong>, your go-to destination for elegant and affordable designer jewelry. 
            Our mission is to bring you timeless pieces crafted with precision and care, perfect for every occasion.
        </p>
    </div>
</section>

<section class="faq">
    <div class="faq-panel">
        <h3 class="faq-title"><i class="fa-solid fa-arrow-right faq-arrow" ></i>How do I order?</h3>
        <p class="faq-content">
           Ordering is easy! Just browse our catalog, add items to your cart, and proceed to checkout.
        </p>
    </div>
</section>


<section class="faq">
    <div class="faq-panel">
        <h3 class="faq-title"><i class="fa-solid fa-arrow-right faq-arrow" ></i>How to contact the admin?</h3>
        <p class="faq-content">
          Its , easy our team will guide you.
        </p>
    </div>
</section>






<section class="about-us">
  <div class="about-content">
    <h2 class="section-title">About Us</h2>
    <p class="about-description">
      Welcome to <strong>KJ Imitation Jewellery Hub</strong>, your go-to destination for elegant and affordable designer jewelry. 
      Our mission is to bring you timeless pieces crafted with precision and care, perfect for every occasion.
    </p>
    <p class="about-mission">
      We believe in offering high-quality imitation jewelry that empowers individuals to express their unique style. 
      From weddings to everyday wear, our collections are curated to add a touch of sophistication to your life.
    </p>
    <a href="#shop" class="learn-more-btn">Learn More</a>
  </div>
  <div class="about-image">
    <img src="assests/about-us.jpg" alt="About Us Image">
  </div>
</section>









<footer class="footer" id="footer">
  <div class="footer-content">
    <div class="footer-about">
      <h3>Contact Us</h3>
      <p><strong>Address:</strong> Dongri</p>
      <p><strong>Phone:</strong> +123 456 7890</p>
      <p><strong>Email:</strong> contact@kjimitationjewellery.com</p>
      <p>Follow us on:</p>
      <div class="footer-socials">
        <a href="#"><img src="assets/icons/facebook.svg" alt="Facebook"></a>
        <a href="#"><img src="assets/icons/instagram.svg" alt="Instagram"></a>
        <a href="#"><img src="assets/icons/twitter.svg" alt="Twitter"></a>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <img src="assests/logo1.jpg" style="width:50px;height:59px;">
    <p>&copy; 2025 KJ Imitation Jewellery</p>
    <a href="./admin/admin-login.php" style="color:white">Visit Admin</a>
  </div>
</footer>


<script>
$(document).ready(function(){
    $(".faq-title").click(function(){
        $(this).next(".faq-content").slideToggle("slow");
        $(this).find(".faq-arrow").toggleClass("rotated");
    });
});




</script>
</body>

</html>