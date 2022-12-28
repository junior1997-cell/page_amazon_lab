<?php require 'head.php'; require 'header.php'; ?>
<br></br>
  <!-- ========== MAIN ========== -->
  <main id="content" role="main" class="body">
    <!-- Contact Form Section -->
    <div class="container space-top-3 space-top-lg-6 space-bottom-0">
      <div class="row">
        <div class="col-lg-6 mb-9 mb-lg-0">
          <div class="mb-5">
            <h1 class="titulos" style="color: black;">Ubícanos</h1>
            <p class="contenido">Es momento de potenciar tu negocio.</p>
          </div>

          <!-- Leaflet -->
          <div id="map" class="min-h-300rem mb-5"
               data-hs-leaflet-options='{
                 "map": {
                   "scrollWheelZoom": true,
                   "coords": [-6.487578584951772, -76.35602821271281]  
                 },
                 "marker": [
                   {
                     "coords": [-6.487578584951772, -76.35602821271281],
                     "icon": {
                       "iconUrl": "../assets/estrategia_digital/components/ubi.png",
                       "iconSize": [50, 45]
                     },
                     "popup": {
                       "text": "214,"
                     }
                   }
                 ]
                }'></div>
          <!-- End Leaflet -->

          <div class="row titulos">
            <div class="col-sm-6">
              <div class="mb-3">
                <span class="d-block h5 mb-1" style="color: dart;">Teléfono:</span>
                <span class="d-block text-body font-size-1">944 411 328</span>
              </div>

              <div class="mb-3">
                <span class="d-block h5 mb-1" style="color: dart;">Correo:</span>
                <span class="d-block text-body font-size-1" style="color: white;">estrategiadigital@gmail.com</span>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="mb-1">
                <span class="d-block h5 mb-1" style="color: dart;">Dirección:</span>
                <span class="d-block text-body font-size-1">Jr. Los Helechos 214 – Urb. Bernabe Guridi.</span>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-6 titulos">
          <div class="ml-lg-5">
            <!-- Form -->
            <form class="js-validate card shadow-lg mb-4">
              <div class="card-header border-0 bg-light text-center py-4 px-4 px-md-6">
                <h2 class="h4 mb-0">Bríndanos tus datos </h2>
              </div>

              <div class="card-body p-4 p-md-6">
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

                <a type="submit" id="btn_enviarwhats" class="btn btn-block transition-3d-hover text-white titulos" style= "background-color: #1f0453;" onclick="limpia_formulario_whatsapp();" href="#" target="_blank"></i>Enviar</a>
              </div>
            </form>
            <!-- End Form -->
          </div>
        </div>
      </div>
    </div>
    <!-- End Contact Form Section -->
  </main>
  <!-- ========== END MAIN ========== -->

  <!-- ========== FOOTER ========== -->
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

  <!-- JS Front -->
  <script src="../assets/js/theme.min.js"></script>

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


      // INITIALIZATION OF SHOW ANIMATIONS
      // =======================================================
      $('.js-animation-link').each(function () {
        var showAnimation = new HSShowAnimation($(this)).init();
      });


      // INITIALIZATION OF FORM VALIDATION
      // =======================================================
      $('.js-validate').each(function() {
        $.HSCore.components.HSValidation.init($(this), {
          rules: {
            confirmPassword: {
              equalTo: '#signupPassword'
            }
          }
        });
      });


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

    function form_whatsapp(){
      var nombres=$('#nombres').val();
      var apeliidos=$('#apellidos').val();
      var correo=$('#correo').val();
      var descripcion=$('#descripcion').val();

       
       console.log(nombres, apeliidos, correo, descripcion);

       $('#btn_enviarwhats').attr('href',`https://api.whatsapp.com/send?phone=+51944411328&text=*Hola, Soy* ${nombres}, ${apeliidos}, *con correo:* ${correo}, *mi consulta es:* ${descripcion}!!`);
    }
    function limpia_formulario_whatsapp(){
      $('#nombres').val('');
      $('#apellidos').val('');
      $('#correo').val('');
      $('#descripcion').val('');
    }

  </script>

  <!-- IE Support -->
  <script>
    if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write('<script src="assets/vendor/babel-polyfill/dist/polyfill.js"><\/script>');
  </script>
  <script src="scripts/script_contactanos.js"></script>

</body>

<!-- Mirrored from htmlstream.com/front/page-contacts-start-up.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 19 May 2021 14:20:42 GMT -->
</html>