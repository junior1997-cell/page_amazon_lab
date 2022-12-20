<?php require 'head.php'; require 'header.php'; ?>

  <!-- ========== MAIN CONTENT ========== -->
  <main id="content" role="main">

    <!-- Hero Section -->
    <div class="position-relative bg-img-hero" id="idinicio">

      <div class="container space-top-3 space-top-lg-6 space-bottom-2 position-absolute">
          <h1 class="text-white text-center" style="font-size: 60px;">Encuentra.</h1>
          <h1 class="text-white text-center" style="font-size: 60px;">el mejor lugar para empezar a vivir.</h1>
      </div>

      <div class="slider">
        
        <ul class="slider__ul">
    
          <li class="slider__li"></li>
          <li class="slider__li"></li>
          <li class="slider__li"></li>
          <li class="slider__li"></li>
    
        </ul>
    
      </div>

    </div>
    <!-- End Hero Section -->

    <!-- nosotros Form Section background: linear-gradient(to top, #000000 0%, #000000bd 100%);  -->
    <div style="background-image: url(../assets/inmobiliaria/img/sobre_nosotros.jpg); background-repeat: no-repeat; position: relative; width: 85%; height: 610px; margin-left: auto; margin-right: auto;">
      <div class="container space-top-2 space-top-lg-6 space-bottom-2" id="idnosotros">
        <div class="row">
          <div class="col-lg-8 mb-9 mb-lg-0">
            <div class="mb-5">
              <h1 style="font-family: monospace; text-align: center;">Sobre Nosotros</h1>
              <div style="height: 200px; background-color: #fbfcff; border-radius: 20px; box-shadow: 0px 15px 23px 0px rgb(35 49 64 / 9%); z-index: -1;">
                <p style="font-family: monospace; font-size: 18px; text-align: justify; padding: 6px;">
                  Pertenecemos a una organización líder con 50 años de experiencia en el mercado inmobiliario en España, el Grupo Romero Mora, especializado en la inversión y gestión de activos inmobiliarios. Llegamos a Perú en el años 2012 con
                  el nombre de Urbalima bajo un sólido gobierno corporativo, desarrollando proyectos residenciales en donde nos apasiona innovar.
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6 containerr">
                <img src="../assets/inmobiliaria/img/vision2.png" alt="Avatar" class="image" style="width: 100%;" />
                <div class="middle">
                  <div class="text">Liderar el mercado inmobiliario de la región con estrategias innovadoras que nos mantengan a la vanguardia en cada servicio ofrecido.</div>
                </div>
              </div>

              <div class="col-lg-6 containerr">
                <img src="../assets/inmobiliaria/img/mision2.png" alt="Avatar" class="image" style="width: 100%;" />
                <div class="middle">
                  <div class="text">Ofrecer productos inmobiliarios de manera confiable y segura para cumplir con las expectativas y necesidades de nuestros clientes.</div>
                </div>
              </div>
            </div>

            <div class="mb-5">
              <div>Valores</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Contact Form Section -->

    <!-- nosostros Form Section -->
    <div style="background-color: rgb(8 7 7 / 1);" >
      <div class="container space-top-3 space-top-lg-6 space-bottom-2" id="idcontactanos" style="font-family: monospace;color: white; font-size: 25px;">
        <div class="row">
          <div class="col-lg-6 mb-9 mb-lg-0" style="border: 6px solid #df924a; border-radius: 20px;">
            <div class="mb-1">
              <h1 style="font-family: monospace;color: white; text-align:center">Ubícanos</h1>
            </div>
            <!-- Leaflet -->
            <div id="map" class="min-h-300rem mb-5"
                data-hs-leaflet-options='{
                  "map": {
                    "scrollWheelZoom": false,
                    "coords": [-6.487578584951772, -76.35602821271281]  
                  },
                  "marker": [
                    {
                      "coords": [-6.487578584951772, -76.35602821271281],
                      "icon": {
                        "iconUrl": "../assets/inmobiliaria/components/ubi.png",
                        "iconSize": [80, 75]
                      },
                      "popup": {
                        "text": "214,"
                      }
                    }
                  ]
                  }'></div>
            <!-- End Leaflet -->

            <div class="row">
              <div class="col-sm-6 col-lg-6">
                <div class="mb-3">
                  <span class="d-block h5 mb-1" style="font-size: 20px;color: #ffffff;">Teléfono:</span>
                  <span class="class_span">+51 944 411 328</span>
                </div>

                <div class="mb-3">
                  <span class="d-block h5 mb-1"  style="font-size: 20px;color: #ffffff;">Correo:</span>
                  <span class="class_span">estrategiadigital@gmail.com</span>
                </div>
              </div>

              <div class="col-sm-6 col-lg-6">
                <div class="mb-3">
                  <span class="d-block h5 mb-1"  style="font-size: 20px;color: #ffffff;">Dirección:</span>
                  <div class="class_span">Jr. Los Helechos 214 – Urb. Bernabe Guridi.</div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="ml-lg-5">
              <!-- Form -->
              <form class="js-validate card shadow-lg mb-4" style="border: 6px solid #df924a; border-radius: 30px;">
                <div class="card-header border-0 bg-light text-center py-4 px-4 px-md-6">
                  <h2 class="h4 mb-0" style="font-family: monospace; color: black; font-size: 25px;">¡Escríbenos y te contactaremos! </h2>
                </div>

                <div class="card-body p-4 p-md-6" >
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- Form Group -->
                      <div class="js-form-message form-group">
                        <label for="nombres" class="input-label">Nombres</label>
                        <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Nombres" aria-label="Nombres" required
                              data-msg="Please enter first your name"
                              onkeyup="form_whatsapp();">
                      </div>
                      <!-- End Form Group -->
                    </div>

                    <div class="col-sm-6">
                      <!-- Form Group -->
                      <div class="js-form-message form-group">
                        <label for="apellidos" class="input-label">Apellidos</label>
                        <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos" aria-label="Apellidos" required
                              data-msg="Please enter last your name"
                              onkeyup="form_whatsapp();">
                      </div>
                      <!-- End Form Group -->
                    </div>

                    <div class="col-sm-12">
                      <!-- Form Group -->
                      <div class="js-form-message form-group">
                        <label for="correo" class="input-label">Correo electronico</label>
                        <input type="email" class="form-control" name="correo" id="correo" placeholder="xxxxxx@gmail.com" aria-label="alex@pixeel.com" required
                              data-msg="Please enter a valid email address"
                              onkeyup="form_whatsapp();">
                      </div>
                      <!-- End Form Group -->
                    </div>

                    <div class="col-sm-12">
                      <!-- Form Group -->
                      <div class="js-form-message form-group">
                        <label for="descripcion" class="input-label">Descripción</label>
                        <div class="input-group">
                          <textarea class="form-control" rows="4" name="descripcion" id="descripcion" placeholder="Escriba su texto aqui!!!" aria-label="Hi there, I would like to ..." required
                                    data-msg="Please enter a reason."
                                    onkeyup="form_whatsapp();"></textarea>
                        </div>
                      </div>
                      <!-- End Form Group -->
                    </div>
                  </div>

                  <a type="submit" id="btn_enviarwhats" class="btn btn-block btn-warning transition-3d-hover" href="#" target="_blank" style="font-size: 25px;"></i>Enviar</a>
                </div>
              </form>
              <!-- End Form -->
            </div>
          </div>

        </div>
      </div>
    </div>
    <!-- End nosostros Form Section -->

    <!-- Features Section -->
    <div class="overflow-hidden" id="idservicios">
      <div class="container space-top-2 space-top-lg-3 space-bottom-3">
        <!-- Title -->
        <div class="w-md-80 w-lg-50 text-center mx-md-auto mb-5 mb-md-9">
          <h2>Features built for scale</h2>
          <p>Get insights to dig down into what's powering your growth the most.</p>
        </div>
        <!-- End Title -->

        <div class="row">
          <div class="col-lg-8 mb-7 mb-lg-0">
            <div class="row">
              <div class="col-sm-6 mb-3 mb-sm-7">
                <!-- Icon Blocks -->
                <div class="pr-lg-6">
                  <figure class="max-w-6rem w-100 mb-4">
                    <img class="img-fluid" src="../assets/svg/icons/icon-2.svg" alt="SVG">
                  </figure>
                  <h3 class="h4">Smart Dashboards</h3>
                  <p class="text-body">This is where we really begin to visualize your napkin sketches and make them into beautiful pixels.</p>
                </div>
                <!-- End Icon Blocks -->
              </div>

              <div class="col-sm-6 mb-3 mb-sm-7">
                <!-- Icon Blocks -->
                <div class="pr-lg-6">
                  <figure class="max-w-6rem w-100 mb-4">
                    <img class="img-fluid" src="../assets/svg/icons/icon-1.svg" alt="SVG">
                  </figure>
                  <h4>Control Center</h4>
                  <p class="text-body">Now that we've aligned the details, it's time to get things mapped out and organized.</p>
                </div>
                <!-- End Icon Blocks -->
              </div>

              <div class="col-sm-6 mb-3 mb-sm-0">
                <!-- Icon Blocks -->
                <div class="pr-lg-6">
                  <figure class="max-w-6rem w-100 mb-4">
                    <img class="img-fluid" src="../assets/svg/icons/icon-15.svg" alt="SVG">
                  </figure>
                  <h4>Email Reports</h4>
                  <p class="text-body">We strive to embrace and drive change in our industry which allows us to keep our clients relevant.</p>
                </div>
                <!-- End Icon Blocks -->
              </div>

              <div class="col-sm-6 mb-sm-0">
                <!-- Icon Blocks -->
                <div class="pr-lg-6">
                  <figure class="max-w-6rem w-100 mb-4">
                    <img class="img-fluid" src="../assets/svg/icons/icon-26.svg" alt="SVG">
                  </figure>
                  <h4>Forecasting</h4>
                  <p class="text-body">Staying focused allows us to turn every project we complete into something we love.</p>
                </div>
                <!-- End Icon Blocks -->
              </div>
            </div>
          </div>

          <div class="col-sm-8 col-md-6 col-lg-4">
            <!-- Article -->
            <article class="position-relative">
              <a class="card shadow-none bg-img-hero w-100 min-h-450rem transition-3d-hover" href="#" style="background-image: url(../assets/img/400x500/img26.jpg);">
                <div class="card-body">
                  <h4>Adobe Ai</h4>
                  <p class="text-body">Access to the Adobe Illustrator techniques</p>
                </div>
                <div class="card-footer border-0 bg-transparent pt-0">
                  <span class="font-weight-bold">Browse tools <i class="fas fa-angle-right fa-sm ml-1"></i></span>
                </div>
              </a>

              <!-- SVG Elements -->
              <figure class="max-w-19rem w-100 position-absolute bottom-0 right-0 z-index-n1">
                <div class="mb-n7 mr-n7">
                  <img class="img-fluid" src="../assets/svg/components/dots-2.svg" alt="Image Description">
                </div>
              </figure>
              <!-- End SVG Elements -->
            </article>
            <!-- End Article -->
          </div>
        </div>
      </div>
    </div>
    <!-- End Features Section -->

  </main>
  <!-- ========== END MAIN CONTENT ========== -->

<?php include_once 'footer.php'; ?>

  <!-- Go to Top -->
  <a class="js-go-to go-to position-fixed" href="javascript:;" style="visibility: hidden;"
     data-hs-go-to-options='{
       "offsetTop": 700,
       "position": {
         "init": {
           "right": 15
         },
         "show": {
           "bottom": 15
         },
         "hide": {
           "bottom": -15
         }
       }
     }'>
    <i class="fas fa-angle-up"></i>
  </a>
  <!-- End Go to Top -->


  <!-- JS Implementing Plugins -->
  <script src="../assets/js/vendor.min.js"></script>
  <!-- <script src="./node_modules/@fancyapps/fancybox/dist/jquery.fancybox.min.js"></script> -->

  <!-- JS Front -->
  <script src="../assets/js/theme.min.js"></script>
  <!-- <script src="../assets/js/hs.fancybox.js"></script> -->

  <!-- JS Plugins Init. -->
  <script>
    $(document).on('ready', function () {
      // INITIALIZATION OF HEADER
      // =======================================================
      var header = new HSHeader($('#header')).init();


      // INITIALIZATION OF MEGA MENU
      // =======================================================
      var megaMenu = new HSMegaMenu($('.js-mega-menu'), {
        desktop: {
          position: 'left'
        }
      }).init();


      // INITIALIZATION OF UNFOLD
      // =======================================================
      var unfold = new HSUnfold('.js-hs-unfold-invoker').init();


      // INITIALIZATION OF FORM VALIDATION
      // =======================================================
      $('.js-validate').each(function () {
        var validation = $.HSCore.components.HSValidation.init($(this));
      });


      // INITIALIZATION OF SLICK CAROUSEL
      // =======================================================
      $('.js-slick-carousel').each(function() {
        var slickCarousel = $.HSCore.components.HSSlickCarousel.init($(this));
      });

      // INITIALIZATION OF FANCYBOX
      // =======================================================
      $('.js-fancybox').each(function () {
        var fancybox = $.HSCore.components.HSFancyBox.init($(this));
      });

      // INITIALIZATION OF TEXT ANIMATION (TYPING)
      // =======================================================
      var typed = $.HSCore.components.HSTyped.init(".js-text-animation");

      
      // INITIALIZATION OF LEAFLET
      // =======================================================
      $('#map').each(function () {
        var leaflet = $.HSCore.components.HSLeaflet.init($(this)[0]);

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
          id: 'mapbox/light-v9'
        }).addTo(leaflet);
      });

      // INITIALIZATION OF GO TO
      // =======================================================
      $('.js-go-to').each(function () {
        var goTo = new HSGoTo($(this)).init();
      });
    });
  </script>

  <!-- IE Support -->
  <script>
    if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write('<script src="../assets/vendor/babel-polyfill/dist/polyfill.js"><\/script>');
  </script>


</body>

<!-- Mirrored from htmlstream.com/front/landing-classic-software.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 19 May 2021 14:17:52 GMT -->
</html>