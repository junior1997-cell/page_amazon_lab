function add_quit_clss_header(titulo) { 
    console.log(titulo);

    if (titulo == 'nosotros') {
        
    }
    if (titulo == 'servicios') {

        // quitar clase de nosotros y agregar a servicios
        // document.getElementById('nosotros').classList.remove('active');
        // document.getElementById('servicios').classList.add('active');
        $('.nosotros').removeClass("morado_active");
        $('.servicios').addClass("morado_active");
        console.log('servicios');
    }

 }