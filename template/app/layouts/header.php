<!DOCTYPE html>
<html lang="en">


<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  

  <!-- icofont-css-link -->
  <link rel="stylesheet" href="<?= asset('public/app/css/icofont.min.css') ?>">
  <!-- Owl-Carosal-Style-link -->
  <link rel="stylesheet" href="<?= asset('public/app/css/owl.carousel.min.css') ?>">
  <!-- Bootstrap-Style-link -->
  <link rel="stylesheet" href="<?= asset('public/app/css/bootstrap.min.css') ?>">
  <!-- Aos-Style-link -->
  <link rel="stylesheet" href="<?= asset('public/app/css/aos.css') ?>">
  <!-- Coustome-Style-link -->
  <link rel="stylesheet" href="<?= asset('public/app/css/style.css') ?>">
  <!-- Responsive-Style-link -->
  <link rel="stylesheet" href="<?= asset('public/app/css/responsive.css') ?>">
  <!-- Favicon -->
  <link rel="shortcut icon" href="<?= asset('public/app/images/favicon.png') ?>" type="image/x-icon">

</head>

<body>

  <!-- Page-wrapper-Start -->
  <div class="page_wrapper">

    <!-- Preloader -->
    <div id="preloader">
      <div id="loader"></div>
    </div>
  <!-- Header Start -->
    <header class="white_header">
      <!-- container start -->
      <div class="container">
        <!-- navigation bar -->
        <nav class="navbar navbar-expand-lg" style="width: 50px;;">
           <a class="navbar-brand">
            <img src="<?= asset('public/app/images/footer_logo.png') ?>" alt="image">
        
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
              <!-- <i class="icofont-navigation-menu ico_menu"></i> -->
              <div class="toggle-wrap">
                <span class="toggle-bar"></span>
              </div>
            </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto">
              <!-- secondery menu start -->
              <li class="nav-item has_dropdown">
                <a class="nav-link" href="<?= url('home') ?>">خانه</a>
              
               
              </li>
             

              <!-- secondery menu start -->
              <li class="nav-item has_dropdown">
                <a class="nav-link" href="#">صفحه‌ها</a>
                <span class="drp_btn"><i class="icofont-rounded-down"></i></span>
                <div class="sub_menu">
                  <ul>
                    <li><a href="<?= url('Reserv_list') ?>"> پنل کاربری</a></li>
                   
                  
                    <li><a href="<?= url('login') ?>">ورود</a></li>
                    <li><a href="<?= url('register') ?>">ثبت نام</a></li>
                  
                  </ul>
                </div>
              </li>
             

             
              
             
            </ul>
          </div>
        </nav>
        <!-- navigation end -->
      </div>
      <!-- container end -->
    </header>
    
    <!-- BredCrumb-Section -->
    <div class="bred_crumb">
      <div class="container">
        <!-- shape animation  -->
        <span class="banner_shape1"> <img src="<?= asset('public/app/images/banner-shape1.png') ?>" alt="image" > </span>
        <span class="banner_shape2"> <img src="<?= asset('public/app/images/banner-shape2.png') ?>" alt="image" > </span>
        <span class="banner_shape3"> <img src="<?= asset('public/app/images/banner-shape3.png') ?>" alt="image" > </span>
        
        
      </div>
    </div> 
