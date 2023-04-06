 <style >
  select {
    font-size: 13px;
    height: 36px;
  }
   select option {
     font-size: 13px;
   }
   .tx-danger{
    color: red;
   }
 </style>
 <!-- ======= Hero Section ======= -->
  <!-- <section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

      <div class="carousel-inner" role="listbox">

      
        <div class="carousel-item active" style="background-image: url(<?php echo base_url()?>webassest/img/slide/slide-1.jpg)">
          <div class="carousel-container">
            <div class="container">
              <h2 class="animate__animated animate__fadeInDown">Welcome to <span>Green</span></h2>
              <p class="animate__animated animate__fadeInUp">Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
              <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
            </div>
          </div>
        </div>

       
        <div class="carousel-item" style="background-image: url(<?php echo base_url()?>webassest/img/slide/slide-2.jpg)">
          <div class="carousel-container">
            <div class="container">
              <h2 class="animate__animated animate__fadeInDown">Lorem Ipsum Dolor</h2>
              <p class="animate__animated animate__fadeInUp">Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
              <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
            </div>
          </div>
        </div>

    
        <div class="carousel-item" style="background-image: url(<?php echo base_url()?>webassest/img/slide/slide-3.jpg)">
          <div class="carousel-container">
            <div class="container">
              <h2 class="animate__animated animate__fadeInDown">Sequi ea ut et est quaerat</h2>
              <p class="animate__animated animate__fadeInUp">Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
              <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
            </div>
          </div>
        </div>

      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>

    </div>
  </section> -->

  <main id="main" style="background-color: #fbfbfb">

   

    
       <?php if($this->session->flashdata('Error')){?>
        <div class="alert alert-danger" role="alert">
            <?php echo $this->session->flashdata('Error');?>
        </div>
        <script>setTimeout(function () { $('.alert').hide(); }, 6000);</script>
        <?php }?>
    
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact" style="padding-top: 20px">
      <div class="container">

        <div class="section-title" style="margin-bottom: -15px !important">
          <h2>Login</h2>
          <!-- <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p> -->
        </div>

        <div class="row"  >

      <!--     <div class="col-lg-5 d-flex align-items-stretch">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Location:</h4>
                <p>A108 Adam Street, New York, NY 535022</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>info@example.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p>+1 5589 55488 55s</p>
              </div>

              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
            </div>

          </div> -->
<div class="row" >
      
          <div  style=" margin:0 auto;width:800px;" >
            
            <form action="<?php echo base_url('login-customer')?>" id="loginForm" method="post"  class="php-email-form">
              <div class="row">
              <div class="col-lg-4">
               <img src="<?php echo base_url()?>webassest/img/sapling.jpeg" alt="">
              </div>
               <div class="col-lg-7" >
                <div class="row" style="padding-top: 80px">
              
              <div class="form-group col-md-12 mt-3" align="center">
                <label for="name">Aadhaar Number<span class="tx-danger">*</span></label>
                <input type="text" class="form-control" class="form-control" minlength="12" maxlength="12" name="adhaar" id="adhaar" onkeypress="return onlyNumberKey(event)"  required>
                <!-- added number validation to adhaar input field on 03-04-2023  -->
                          <!-- <p id="adhaar_result"></p> -->
              </div>
              <br>
              <br>
              <br>
              <br>
              <div class="text-center"><button type="submit">Login</button></div>
              </div>
              </div>
            </div>
              <!-- <div class="row" >
              
              <div class="form-group col-md-12 mt-3" align="center">
                <label for="name">Aadhaar Number</label>
                <input type="text" class="form-control" minlength="12" maxlength="12" name="adhaar" id="adhaar"  required>
                        
              </div>
              
              </div>
              
             <br>
              <div class="text-center"><button type="submit">Login</button></div> -->
            </form>
          </div>

        </div>
</div>
      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

    <script>
          $(document).ready(function(){
            $('#loginForm').bootstrapValidator({
              feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
       
       
        adhaar: {

          validators: {
            notEmpty: {
              message: 'The adhaar number is required'
            },
            stringLength: { //this lenght validation is done on 05-04-2023 by saleem ali //
                        min: 12,
                        max: 12,
                        message: 'The adhaar number must be 12 digit '
                    }
          }
        },
       
         
  }
})
        });

    </script>
    <script>
        function onlyNumberKey(evt) {
              
            // Only ASCII character in that range allowed
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
                return false;
            return true;
        }
    </script>