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

   

    

    
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact" style="padding-top: 20px">
      <div class="container">

        <div class="section-title" style="margin-bottom: -15px !important">
          <h2>Registration</h2>
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
  <!-- oninput function added on 05-04-2023 by saleem ali -->
          <div style=" margin:0 auto;width:900px;" >
            <form action="<?php echo base_url('register-customer')?>" id="loginForm" method="post"  class="php-email-form">
                <div class="row">
                   <div class="col-lg-4">
               <img src="<?php echo base_url()?>webassest/img/sapling.jpeg" alt="">
              </div>
                 <div class="col-lg-8" >
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="name">Your Name<span class="tx-danger">*</span></label>
                  <input type="text" class="form-control" oninput="this.value = this.value.replace(/[^A-z.]/g, '').replace(/(\..*)\./g, '$1');"  name="name" id="name" required>
                </div>

                  <div class="form-group col-md-6 ">
                <label for="name">Phone Number<span class="tx-danger">*</span></label>
                 <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" minlength="10" maxlength="10" class="form-control" name="phone" id="phone" required>
              </div>
              <div class="form-group col-md-6 mt-3">
                <label for="name">Aadhaar Number<span class="tx-danger">*</span></label>
                <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control" minlength="12" maxlength="12" name="adhaar" id="adhaar"  required>
                          <!-- <p id="adhaar_result"></p> -->
              </div>
                <div class="form-group col-md-6 mt-3">
                  <label for="name">Survey Number</label>
                  <input type="text" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="servey" id="servey"  >
                </div>
              <div class="form-group  col-md-6 mt-3">
                <label for="name">Water Source<span class="tx-danger">*</span></label>
                <!-- <input type="text" class="form-control" name="subject" id="subject" required> -->
                <select class="form-control" name="water" id="water">
                                <option selected="" disabled="">Select Source</option>
                                <option value="Drilled wells">Drilled wells</option>
                                <option value="Surface water">Surface water</option>
                                <option value="Drainage ponds">Drainage ponds</option>
                                <option value="Rain water">Rain water</option>
                                <option value="Municipal water">Municipal water</option>
                            </select>
              </div>
              <div class="form-group col-md-6 mt-3">
                <label for="name">Extent Of Land<span class="tx-danger">*</span></label>
                <input type="text" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  name="land" id="name"  required>
              </div>
            
              <div class="form-group col-md-6 mt-3">
                <label for="name">Village<span class="tx-danger">*</span></label>
                <input type="text" class="form-control" oninput="this.value = this.value.replace(/[^A-z.]/g, '').replace(/(\..*)\./g, '$1');" name="vilage" id="subject" required>
              </div>
              <div class="form-group col-md-6 mt-3">
                <label for="name">Taluka<span class="tx-danger">*</span></label>
                <input type="text" class="form-control" oninput="this.value = this.value.replace(/[^A-z.]/g, '').replace(/(\..*)\./g, '$1');" name="taluka" id="subject" required>
              </div>
              <div class="form-group col-md-6 mt-3">
                <label for="name">District<span class="tx-danger">*</span></label>
                <input type="text" class="form-control" oninput="this.value = this.value.replace(/[^A-z.]/g, '').replace(/(\..*)\./g, '$1');" name="district" id="subject" required>
              </div>
              <div class="form-group col-md-6 mt-3">
                <label for="name">State<span class="tx-danger">*</span></label>
                <input type="text" class="form-control" oninput="this.value = this.value.replace(/[^A-z.]/g, '').replace(/(\..*)\./g, '$1');" name="state" id="subject" required>
              </div>
              <div class="form-group col-md-6 mt-3">
                <label for="name">Geo Location<span class="tx-danger" style="color:red">*</span> </label>
                 <input type="checkbox" class="chkbox" id="location-button" />
                
              </div>
              </div>
               <input type="hidden" name="lat" id="lat" /><input type="hidden" name="lng" id="lng" />
             <br>
              <div class="text-center"><button type="submit">Submit</button></div>
            </form>
          </div>
 </div> </div>
        </div>
</div>
      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>
  <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHWdfIWxrGAdM3ITXi65NnG71R2Nu2l-g&callback=initMap&v=weekly"
      async
    ></script>
 <script>
      
      // [START maps_map_geolocation]
// Note: This example requires that you consent to location sharing when
// prompted by your browser. If you see the error "The Geolocation service
// failed.", it means you probably did not give permission for the browser to
// locate you.
let map, infoWindow;

function initMap() {

  // const mapOptions = {
  //   zoom: 8,
  //   center: { lat: -34.397, lng: 150.644 },
  // };

  //   map = new google.maps.Map(document.getElementById("map"), mapOptions);

  //  google.maps.event.addListener(marker, "click", () => {
  //   infowindow.open(map, marker);
  // });
  const locationButton = document.getElementById("location-button");
  locationButton.onclick = function(){
    // Try HTML5 geolocation.
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        (position) => {
          const pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude,
          };


          const marker = new google.maps.Marker({
    // The below line is equivalent to writing:
    // position: new google.maps.LatLng(-34.397, 150.644)
    position: { lat: position.coords.latitude, lng: position.coords.longitude },
    map: map,
  });

   const infowindow = new google.maps.InfoWindow({
    content: "<p>Marker Location:" + marker.getPosition() + "</p>",
  });

   $('#lat').val(pos.lat);
   $('#lng').val(pos.lng);
 // document.getElementById("lat").value = pos;
          console.log(pos);

        }
      );
    } else {
      // Browser doesn't support Geolocation
      handleLocationError(false, infoWindow, map.getCenter());
    }
  }
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(
    browserHasGeolocation
      ? "Error: The Geolocation service failed."
      : "Error: Your browser doesn't support geolocation."
  );
  infoWindow.open(map);
}
// [END maps_map_geolocation]



    </script>
    <script>
          $(document).ready(function(){
            $('#loginForm').bootstrapValidator({
              feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                name: {

                  validators: {
                    notEmpty: {
              message: 'The name number is required'
            },
                  stringLength: { //this lenght validation is done on 05-04-2023 by saleem ali //
                        min: 4,
                        max: 20,
                        message: 'The name must be more than 4 or less than 20 characters'
                    }
                   
              }
          },
          servey: {

              validators: {
                notEmpty: {
                  message: 'The servey number is required'
              }
          }
      },
       nursery: {

          validators: {
            notEmpty: {
              message: 'The nursery name is required'
            }
          }
        },
         water: {

          validators: {
            notEmpty: {
              message: 'The water source is required'
            }
          }
        },
      land: {

          validators: {
            notEmpty: {
              message: 'The extend of land is required'
            }
          }
        },
             phone: {

          validators: {
            notEmpty: {
              message: 'The phone number is required'
            },
            stringLength: {
                        min: 10,
                        max: 10,
                        message: 'Enter a valid mobile number'
                    },
          }
        },
        adhaar: {

          validators: {
            notEmpty: {
              message: 'The adhaar number is required'
            },
             stringLength: { //this lenght validation is done on 05-04-2023 by saleem ali //
                        min: 12,
                        max: 12,
                        message: 'Enter a valid adhaar number'
                    },
          }
        },
        vilage: {

          validators: {
               notEmpty: {
              message: 'The vilage is required'
            },
              
             stringLength: { //this lenght validation is done on 05-04-2023 by saleem ali //
                        min: 4,
                        max: 20,
                        message: 'The village must be more than 4 or less than 20 characters'
                    }
          }
        },
           taluka: {

          validators: {
               notEmpty: {
              message: 'The taluka is required'
            },
               
            stringLength: { //this lenght validation is done on 05-04-2023 by saleem ali //
                        min: 4,
                        max: 20,
                        message: 'The taluka must be more than 4 or less than 20 characters'
                    }
          }
        },
           district: {

          validators: {
               notEmpty: {
              message: 'The district is required'
            },
               
            stringLength: { //this lenght validation is done on 05-04-2023 by saleem ali //
                        min: 4,
                        max: 20,
                        message: 'The district must be more than 4 or less than 20 characters'
                    }

          }
        },
           state: {

          validators: {
               notEmpty: {
              message: 'The state is required'
            },
               
            stringLength: { //this lenght validation is done on 05-04-2023 by saleem ali //
                        min: 4,
                        max: 20,
                        message: 'The state must be more than 4 or less than 20 characters'
                    }

          }
        },
           address: {

          validators: {
            notEmpty: {
              message: 'The address is required'
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