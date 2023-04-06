
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Customer | KBJNL</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo base_url()?>assets/images/newlogo.png" rel="icon">
  <link href="<?php echo base_url()?>assets/images/newlogo.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo base_url()?>webassest/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="<?php echo base_url()?>webassest/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url()?>webassest/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?php echo base_url()?>webassest/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url()?>webassest/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?php echo base_url()?>webassest/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo base_url()?>webassest/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/vendors/fontawesome/css/all.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style >
    .lockscreen{
        max-width: 800px !important;

    }
    .help-block{
      color:red;
  }
</style>
  <!-- =======================================================
  * Template Name: Green - v4.5.0
  * Template URL: https://bootstrapmade.com/green-free-one-page-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-flex align-items-center" style="background-color: #5cb874">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope-fill" style="color: #ffff"></i><a href="mailto:contact@example.com" style="color: #ffff">cedam_almatti@yahoo.com</a>
        <i class="bi bi-phone-fill phone-icon" style="color: #ffff"></i><a style="color: #ffff"> +91 9886351288</a>
      </div>
      <div class="social-links d-none d-md-block">
        <form method="post" action="<?php echo base_url();?>set-language">
                                 <input type="hidden" name="route" value="<?php echo $this->uri->segment(1);?>">
                                 <select style="cursor: pointer;" name="lan" class="customClass" onchange="this.form.submit();">
                                    <option <?php echo $this->session->userdata('lang') == 'EN' ? 'selected' : '' ?> value="EN">English</option>
                                    <option <?php echo $this->session->userdata('lang') == 'KA' ? 'selected' : '' ?> value="KA">Kannada</option>
                                 </select>
                              </form>
      </div>
    </div>
  </section>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="<?php echo base_url()?>"><img height="62px" src="<?php echo base_url()?>assets/images/newlogo.png"></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="<?php echo base_url()?>webassest/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <?php if($this->session->userdata('lang')=='EN') { ?>
          <li><a class="nav-link scrollto active" href="<?php echo base_url()?>#hero">Home</a></li>
           <?php } else {?>
            <li><a class="nav-link scrollto active" href="<?php echo base_url()?>#hero">ಮನೆ</a></li>
           <?php }?>
            <?php if($this->session->userdata('lang')=='EN') { ?>
          <li><a class="nav-link " href="<?php echo base_url()?>#about">About</a></li>
          <?php } else {?>
          <li><a class="nav-link" href="<?php echo base_url()?>#about">ಸುಮಾರು</a></li>
           <?php }?>
             <?php if($this->session->userdata('lang')=='EN') { ?>
          <li><a class="nav-link " href="<?php echo base_url()?>#contact">Contact</a></li>
          <?php } else {?>
          <li><a class="nav-link s" href="<?php echo base_url()?>#contact">ಸಂಪರ್ಕ</a></li>
           <?php }?>
         <?php if(!$this->session->userdata('cust_aadhaar')){ ?>
          <?php if($this->session->userdata('lang')=='EN') { ?>
          <li><a class="getstarted " href="<?php echo base_url('customer-reg')?>">Register</a></li>
           <?php } else {?>
<li><a class="getstarted " href="<?php echo base_url('customer-reg')?>">ನೋಂದಣಿ</a></li>
             <?php }?>
              <?php if($this->session->userdata('lang')=='EN') { ?>
           <li><a class="getstarted " href="<?php echo base_url('customer-login')?>">Login</a></li>
            <?php } else {?>
 <li><a class="getstarted " href="<?php echo base_url('customer-login')?>">ಲಾಗಿನ್</a></li>
              <?php }?>

            <?php } else {?>
<li><a class="getstarted " href="<?php echo base_url('loginWeb')?>">Logout</a></li>
            <?php }?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

 